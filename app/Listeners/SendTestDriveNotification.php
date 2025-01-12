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
        // Envia a notificação para o usuário, por exemplo, para o administrador
        // Aqui podemos enviar o e-mail para o administrador ou para o próprio usuário
        // Supondo que você quer enviar o e-mail para o administrador

        // Envia a notificação para o e-mail
        $admin = \App\Models\User::where('role', 'admin')->first();
        $admin->notify(new TestDriveScheduledNotification($event->testDrive));
    }
}
