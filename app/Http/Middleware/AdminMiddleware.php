<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado e tem a role 'admin'
        if (auth()->check() && auth()->user()->role == 'admin') {
            return $next($request);
        }

        // Se não for admin, redireciona para a página inicial ou outra página
        return redirect('/');
    }
}
