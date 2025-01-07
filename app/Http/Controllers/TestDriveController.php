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
        // Validação
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required|date_format:H:i',
            'terms_accepted' => 'accepted',  // Valida se o checkbox foi marcado
        ]);
    
        // Convertendo 'terms_accepted' para 1 (aceito) ou 0 (não aceito)
        $termsAccepted = $request->has('terms_accepted') ? 1 : 0;
    
        // Criando um novo agendamento de Test Drive
        TestDrive::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'preferred_date' => $request->input('preferred_date'),
            'preferred_time' => $request->input('preferred_time'),
            'observations' => $request->input('observations'),
            'terms_accepted' => $termsAccepted,
        ]);
    
        return redirect()->back()->with('success', 'Seu pedido de Test Drive foi enviado com sucesso!');
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
