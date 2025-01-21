<?php

namespace App\Http\Controllers;

use App\Models\TestDrive;
use App\Models\Car; 
use Illuminate\Http\Request;
use App\Events\TestDriveScheduled; //notificacao
use App\Notifications\TestDriveScheduledNotification;
use App\Notifications\TestDriveConfirmed;
use App\Notifications\TestDriveCancelled;

class TestDriveController extends Controller
{
    /**
     * Exibir todos os agendamentos de Test Drives com a opção de pesquisa.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = TestDrive::query();

        // Filtro por pesquisa (nome ou email)
        if ($request->has('search') && $request->query('search') !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->query('search') . '%')
                  ->orWhere('email', 'like', '%' . $request->query('search') . '%');
            });
        }

        // Filtro por status (confirmados ou por confirmar)
        if ($request->has('status')) {
            if ($request->query('status') === 'confirmed') {
                $query->where('confirmed', true);
            } elseif ($request->query('status') === 'pending') {
                $query->where('confirmed', false);
            }
        }

        // Ordenação por critério selecionado
        if ($request->has('order')) {
            if ($request->query('order') === 'preferred_date_time') {
                $query->orderBy('preferred_date', 'asc')->orderBy('preferred_time', 'asc');
            } else {
                $query->orderBy('created_at', 'desc'); // Ordenação padrão por data de inserção
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Eager loading para carregar o carro associado ao test drive
        $testDrives = $query->with('car')->paginate(10); // Paginação para melhorar o desempenho em grandes listas

        // Carregar todos os carros disponíveis (para formulários ou outras funcionalidades)
        $cars = Car::all();

        // Retornar a view com os test drives e carros
        return view('test_drives.index', compact('testDrives', 'cars'));
    }

    /**
     * Confirmar o agendamento de Test Drive.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function confirm($id)
    {
        $testDrive = TestDrive::findOrFail($id);

        if (!$testDrive->confirmed) {
            $testDrive->confirmed = true;
            $testDrive->save();

            // Enviar notificação
            $testDrive->notify(new TestDriveConfirmed($testDrive));

            return redirect()->route('testdrives.index')->with('success', 'Agendamento confirmado e notificação enviada!');
        }

        return redirect()->route('testdrives.index')->with('info', 'Este agendamento já estava confirmado.');
    }


    /**
     * Cancelar o agendamento de Test Drive.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

public function cancel($id)
{
    $testDrive = TestDrive::findOrFail($id);

    if ($testDrive->confirmed) {
        $testDrive->confirmed = false;
        $testDrive->save();

        // Enviar notificação de cancelamento
        $testDrive->notify(new TestDriveCancelled($testDrive));

        return redirect()->route('testdrives.index')->with('success', 'Agendamento cancelado e notificação enviada!');
    }

    return redirect()->route('testdrives.index')->with('info', 'Este agendamento já estava cancelado.');
}


    /**
     * Armazenar um novo agendamento de Test Drive.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */


     public function store(Request $request)
{
    // Verifica se o usuário está autenticado
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Você precisa estar logado para agendar um test drive.');
    }

    // Validação dos dados
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'preferred_date' => 'required|date',
        'preferred_time' => 'required|string',
        'terms_accepted' => 'accepted',
        'car_id' => 'required|exists:cars,id', // Garantir que o car_id exista na tabela cars
    ]);

    // Verifica se o horário já está reservado para o mesmo carro e data
    $isTimeReserved = TestDrive::where('car_id', $request->car_id)
        ->where('preferred_date', $request->preferred_date)
        ->where('preferred_time', $request->preferred_time)
        ->exists();

    if ($isTimeReserved) {
        // Loga a tentativa de agendamento em horário reservado
        \Log::info('Tentativa de agendamento em horário já reservado.', $request->all());

        // Retorna erro para o campo horário
        return back()->withErrors([
            'preferred_time' => 'Este horário já está reservado para este carro. Escolha outro horário.',
        ])->withInput();
    }

    try {
        // Obtendo o ID do usuário autenticado
        $userId = auth()->user()->id;

        // Cria o agendamento do test drive no banco de dados
        $testDrive = TestDrive::create([
            'car_id' => $request->car_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'observations' => $request->observations,
            'user_id' => $userId,
        ]);

        // Loga o sucesso do agendamento
        \Log::info('Agendamento criado com sucesso.', ['id' => $testDrive->id]);

        // Dispara o evento para notificar o agendamento
        event(new TestDriveScheduled($testDrive));

        // Redireciona de volta com uma mensagem de sucesso
        return back()->with('success', 'O teu pedido de agendamento foi enviado com sucesso! Irás receber um email assim que confirmado!');
    } catch (\Exception $e) {
        // Loga o erro em caso de falha
        \Log::error('Erro ao criar agendamento: ' . $e->getMessage());

        // Retorna ao usuário uma mensagem genérica de erro
        return back()->with('error', 'Erro interno ao tentar criar o agendamento. Tente novamente mais tarde.')->withInput();
    }
}

     
     

    public function getAvailableTimes(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'date' => 'required|date',
        ]);

        $carId = $request->input('car_id');
        $date = $request->input('date');

        // Horários disponíveis no intervalo 08:00 - 19:00 a cada 15 minutos
        $allTimes = [];
        for ($hour = 8; $hour < 19; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 15) {
                $allTimes[] = sprintf('%02d:%02d', $hour, $minute);
            }
        }

        // Buscar horários já reservados
        $reservedTimes = TestDrive::where('car_id', $carId)
            ->where('preferred_date', $date)
            ->pluck('preferred_time')
            ->toArray();

        // Filtrar horários disponíveis
        $availableTimes = array_diff($allTimes, $reservedTimes);

        return response()->json($availableTimes);
    }

     
    

    public function destroy($id)
    {
        // Encontrar o TestDrive pelo ID
        $testDrive = TestDrive::findOrFail($id);
    
        // Remover o agendamento da base de dados
        $testDrive->delete();
    
        // Retornar à página anterior com uma mensagem de sucesso
        return back()->with('success', 'Test Drive removido com sucesso!');
    }
    

}
