<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TestDriveScheduledNotification extends Notification
{
    use Queueable;

    protected $testDrive;

    public function __construct($testDrive)
    {
        $this->testDrive = $testDrive;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pedido de agendamento de Test Drive realizado com sucesso!')
            ->greeting('Olá ' . $notifiable->name . ',')
            ->line('Você solicitou um test drive para o veículo ' . $this->testDrive->car->name . '.')
            ->line('Detalhes do test drive:')
            ->line('Data: ' . $this->testDrive->preferred_date)
            ->line('Hora: ' . $this->testDrive->preferred_time)
            ->line('Observações: ' . $this->testDrive->observations)
            ->action('Voltar', url('/'))
            ->line('Obrigado por escolher a Drive&Ride!')
            ->salutation('Atenciosamente, Drive&Ride');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
