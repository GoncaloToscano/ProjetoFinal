<?php

namespace App\Listeners;

use App\Events\TestDriveScheduled;
use App\Notifications\TestDriveScheduledNotification;

class SendTestDriveScheduledNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\TestDriveScheduled  $event
     * @return void
     */
    public function handle(TestDriveScheduled $event)
    {
        // Recupera o usuário associado ao test drive
        $user = $event->testDrive->user;

        // Verifica se o usuário existe antes de tentar enviar a notificação
        if ($user) {
            // Envia a notificação para o usuário
            $user->notify(new TestDriveScheduledNotification($event->testDrive));
        } else {
            // Se o usuário não existir, podemos registrar um erro ou realizar uma ação alternativa
            \Log::error('Usuário não encontrado para o test drive ID: ' . $event->testDrive->id);
        }
    }
}
