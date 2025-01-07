<?php

namespace App\Http\Controllers;

use App\Models\TestDrive;
use Illuminate\Http\Request;

class TestDriveController extends Controller
{
    /**
     * Exibir o formulário de agendamento de Test Drive
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('testdrive.create');
    }

    /**
     * Armazenar os dados do Test Drive no banco de dados
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

    // Converte o valor 'on' para 1 (se aceito) ou 0 (se não aceito)
    $termsAccepted = $request->has('terms_accepted') ? 1 : 0;

    // Criação do agendamento de test drive
    TestDrive::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'preferred_date' => $validated['preferred_date'],
        'preferred_time' => $validated['preferred_time'],
        'terms_accepted' => $termsAccepted,
    ]);

    // Redireciona com uma mensagem de sucesso
    return redirect()->back()->with('success', 'Seu pedido de agendamento foi enviado com sucesso! Aguarde a confirmação.');
}

    
    
    /**
     * Exibir todos os agendamentos de Test Drives
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $testDrives = TestDrive::all();
        return view('testdrive.index', compact('testDrives'));
    }
}
