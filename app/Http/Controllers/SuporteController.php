<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Mail\PedidoDeSuporte;

class SuporteController extends Controller
{
    public function enviar(Request $request)
    {
        // Validação do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'mensagem' => 'required|string',
        ]);
    
        // Enviar o e-mail usando o Mailable
        Mail::to('arely.schmeler73@ethereal.email')->send(new PedidoDeSuporte(
            $request->nome, 
            $request->email, 
            $request->telefone, 
            $request->mensagem
        ));
    
        // Redireciona de volta com sucesso
        return redirect()->back()->with('success', 'Pedido de suporte enviado com sucesso!');
    }
    
}
