<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica o usuário com as credenciais fornecidas
        $request->authenticate();

        // Regenera a sessão para evitar fixação de sessão
        $request->session()->regenerate();

        // Redireciona para a página inicial (welcome) após o login
        return redirect()->route('welcome');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Faz logout do usuário
        Auth::guard('web')->logout();

        // Invalida a sessão do usuário
        $request->session()->invalidate();

        // Regenera o token da sessão para segurança
        $request->session()->regenerateToken();

        // Redireciona para a página inicial após o logout
        return redirect('/');
    }
}
