<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SuporteController extends Controller
{
// SuporteController.php
public function enviar(Request $request)
{
    // Validação do formulário
    $request->validate([
        'nome' => 'required|string|max:255',
        'mensagem' => 'required|string',
    ]);

    // Envio do e-mail
    Mail::raw("Pedido de Suporte de: " . $request->nome . "\n\nMensagem:\n" . $request->mensagem, function ($message) {
        $message->to('arely.schmeler73@ethereal.email') // E-mail de destino
                ->subject('Novo Pedido de Suporte');
    });

    // Redireciona de volta com sucesso
    return redirect()->back()->with('success', 'Pedido de suporte enviado com sucesso!');
}

}
