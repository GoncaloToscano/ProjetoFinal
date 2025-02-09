<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'car_id' => 'required|integer',
            'car_name' => 'required|string|max:255',
            'car_brand' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);
    
        // Captura os dados do formulário
        $data = $request->only('car_id', 'car_name', 'car_brand', 'name', 'email', 'message');
    
        // Corpo do e-mail com o nome e marca do carro
        $emailBody = "
            Novo contato sobre o carro:
            Marca: {$data['car_brand']}
            Modelo: {$data['car_name']}
            
            Detalhes do contato:
            Nome: {$data['name']}
            Email: {$data['email']}
            
            Mensagem:
            {$data['message']}
        ";
    
        // Enviar o e-mail
        Mail::send('emails.contact', ['data' => $data], function ($message) {
            $message->to('projetolaraveltpsi1223@gmail.com') 
                    ->subject('Contato sobre carro');
        });
    
        // Redirecionar com mensagem de sucesso
        return back()->with('success', 'A sua mensagem foi enviada com sucesso!');
    }
    
}
