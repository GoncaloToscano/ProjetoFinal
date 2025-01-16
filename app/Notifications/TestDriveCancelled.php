<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestDriveCancelled extends Notification
{
    use Queueable;

    private $testDrive;

    /**
     * Cria uma nova instância de notificação.
     *
     * @param  \App\Models\TestDrive  $testDrive
     */
    public function __construct($testDrive)
    {
        $this->testDrive = $testDrive;
    }

    /**
     * Define os canais de entrega da notificação.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Cria a mensagem de e-mail da notificação.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Agendamento Cancelado')
            ->greeting('Olá, ' . $this->testDrive->name)
            ->line('Lamentamos informar que o seu agendamento para o test drive foi cancelado.')
            ->line('Detalhes do agendamento:')
            ->line('Data: ' . $this->testDrive->preferred_date)
            ->line('Hora: ' . $this->testDrive->preferred_time)
            ->line('Carro: ' . $this->testDrive->car->name)
            ->action('Voltar', url('/'))
            ->line('Sinta-se à vontade para reagendar em um dia e horário mais conveniente.')
            ->line('Obrigado pela sua compreensão!');
    }

    /**
     * Representação do objeto de notificação em array.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'test_drive_id' => $this->testDrive->id,
            'name' => $this->testDrive->name,
            'email' => $this->testDrive->email,
        ];
    }
}
