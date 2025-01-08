<?php

namespace App\Http\Controllers;

use App\Models\TestDrive;
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
    
        // Ordenar os resultados
        $testDrives = $query->orderBy('preferred_date', 'asc')
                            ->orderBy('preferred_time', 'asc')
                            ->get();
        
        return view('test_drives.index', compact('testDrives'));
    }
    

    /**
     * Confirmar o agendamento de um Test Drive
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm($id)
    {
        // Encontra o Test Drive pelo ID
        $testDrive = TestDrive::findOrFail($id);
        $testDrive->confirmed = true; // Marca como confirmado
        $testDrive->save();
    
        // Retorna para a lista de agendamentos com a mensagem de sucesso
        return redirect()->route('testdrives.index')->with('success', 'Agendamento confirmado com sucesso!');
    }

    /**
     * Cancelar o agendamento de um Test Drive
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id)
    {
        // Encontra o Test Drive pelo ID
        $testDrive = TestDrive::findOrFail($id);
        $testDrive->confirmed = false; // Marca como não confirmado
        $testDrive->save();

        // Retorna para a lista de agendamentos com a mensagem de sucesso
        return redirect()->route('testdrives.index')->with('success', 'Agendamento cancelado com sucesso!');
    }

    public function store(Request $request)
{
    // Validação dos dados
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'preferred_date' => 'required|date',
        'preferred_time' => 'required|date_format:H:i',
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
        'terms_accepted' => $request->has('terms_accepted') ? 1 : 0, // Convertendo se aceitou os termos
        'confirmed' => false, // Inicializa como não confirmado
    ]);

    // Redireciona com uma mensagem de sucesso
    return redirect()->back()->with('success', 'Seu pedido de agendamento foi enviado com sucesso! Aguarde a confirmação.');
}

}
