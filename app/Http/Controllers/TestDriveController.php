<?php

namespace App\Http\Controllers;

use App\Models\TestDrive;
use App\Models\Car;  // Adicionando o uso do modelo Car
use Illuminate\Http\Request;

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
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
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

        // Eager loading para carregar o carro associado ao test drive
        $testDrives = $query->with('car') // Relacionamento com a tabela 'car'
                            ->orderBy('preferred_date', 'asc')
                            ->orderBy('preferred_time', 'asc')
                            ->get();
        
        // Carregar todos os carros disponíveis para exibir no formulário de agendamento
        $cars = Car::all();  // Garantindo que a variável $cars seja carregada corretamente

        // Retornar a view com os test drives e carros
        return view('test_drives.index', compact('testDrives', 'cars')); // Passando os carros para a view
    }

    /**
     * Confirmar o agendamento de Test Drive.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm($id)
    {
        // Buscar o TestDrive pelo ID
        $testDrive = TestDrive::findOrFail($id);

        // Atualizar o status para confirmado
        $testDrive->confirmed = true;
        $testDrive->save();

        // Retornar à página anterior com uma mensagem de sucesso
        return back()->with('success', 'Test Drive confirmado com sucesso!');
    }

    /**
     * Cancelar o agendamento de Test Drive.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id)
    {
        // Buscar o TestDrive pelo ID
        $testDrive = TestDrive::findOrFail($id);

        // Cancelar o agendamento (definir como não confirmado)
        $testDrive->confirmed = false;
        $testDrive->save();

        // Retornar à página anterior com uma mensagem de sucesso
        return back()->with('success', 'Test Drive cancelado com sucesso!');
    }

    /**
     * Armazenar um novo agendamento de Test Drive.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required|date_format:H:i',
            'car_id' => 'required|exists:cars,id',
            'terms_accepted' => 'required|accepted',
        ]);
        
        // Verifica se já existe um agendamento na mesma data e hora
        $existingTestDrive = TestDrive::where('preferred_date', $validated['preferred_date'])
                                       ->where('preferred_time', $validated['preferred_time'])
                                       ->first();
        
        if ($existingTestDrive) {
            // Se já existe um agendamento, retorna um erro com uma mensagem personalizada
            return back()->withErrors([
                'preferred_time' => 'Infelizmente, já existe um agendamento para o horário e data selecionados. Por favor, escolha outro horário ou data.'
            ]);
        }
        
        // Criação do agendamento de test drive
        TestDrive::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'preferred_date' => $validated['preferred_date'],
            'preferred_time' => $validated['preferred_time'],
            'car_id' => $validated['car_id'],
            'terms_accepted' => $request->has('terms_accepted') ? 1 : 0,
            'confirmed' => false,
        ]);
        
        // Não redireciona, apenas passa uma mensagem de sucesso para a view
        return back()->with('success', 'Seu pedido de agendamento foi enviado com sucesso! Aguarde a confirmação.');
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
