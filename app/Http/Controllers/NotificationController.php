<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Exibe a página de notificações.
     */
    public function index()
    {
        $users = User::all(); // Busca todos os usuários registrados
        return view('notifications.index', compact('users'));
    }

    /**
     * Envia o comunicado por e-mail.
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'recipients' => 'required|array',
        ]);
    
        foreach ($data['recipients'] as $email) {
            Mail::send('emails.notification', ['messageContent' => $data['message'], 'subject' => $data['subject']], function ($message) use ($email, $data) {
                $message->to($email)
                        ->subject($data['subject']);
            });
            
        }
    
        return redirect()->route('notifications.index')->with('success', 'Comunicado enviado com sucesso!');
    }
}
