<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Jobs\SendNotificationJob;

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

        // Se o usuário escolheu enviar para todos os inscritos na newsletter
        if ($request->has('send_to_newsletter') && $request->send_to_newsletter) {
            $newsletterSubscribers = User::where('newsletter', true)->pluck('email')->toArray();
            $emails = array_merge($emails, $newsletterSubscribers);
        }

        // Adiciona os destinatários selecionados manualmente
        if (!empty($data['recipients'])) {
            $emails = array_merge($emails, $data['recipients']);
        }

        // Remove duplicatas para evitar e-mails duplicados
        $emails = array_unique($emails);

        // Envia os e-mails de forma assíncrona, com delay entre cada envio
        foreach ($emails as $index => $email) {
            SendNotificationJob::dispatch($email, $data['subject'], $data['message'])
                ->delay(now()->addSeconds($index * 10)); // Envio a cada 10 segundos
        }

        return redirect()->route('notifications.index')->with('success', 'Os e-mails estão sendo enviados em segundo plano!');
    }
}
