<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Jobs\SendNotificationJob;
use App\Models\Newsletter;

class NotificationController extends Controller
{
    /**
     * Exibe a página de notificações.
     */
    public function index()
    {
        $users = User::all();
        return view('notifications.index', compact('users'));
    }

    /**
     * Envia o comunicado por e-mail utilizando filas (queues).
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'recipients' => 'nullable|array',
            'send_to_newsletter' => 'nullable|boolean',
        ]);
    
        $emails = [];
    
        // Se o utilizador escolheu enviar para todos os inscritos na newsletter
        if ($request->has('send_to_newsletter') && $request->send_to_newsletter) {
            $newsletterSubscribers = Newsletter::pluck('email')->toArray();
            $emails = array_merge($emails, $newsletterSubscribers);
        }
    
        // Adiciona os destinatários selecionados manualmente
        if (!empty($data['recipients'])) {
            $emails = array_merge($emails, $data['recipients']);
        }
    
        // **Remover e-mails duplicados**
        $emails = array_unique($emails);
    
        // **Enviar e-mails de forma assíncrona, evitando envios repetidos**
        $delay = 0;
        foreach ($emails as $email) {
            SendNotificationJob::dispatch($email, $data['subject'], $data['message'])
                ->delay(now()->addSeconds($delay));
    
            $delay += 10; // Envia a cada 10 segundos
        }
    
        return redirect()->route('notifications.index')->with('success', 'Os e-mails estão sendo enviados em segundo plano!');
    }
    
}
