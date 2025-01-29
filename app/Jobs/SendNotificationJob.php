<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $subject;
    public $message;

    /**
     * Cria uma nova instância do Job.
     */
    public function __construct($email, $subject, $message)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Executa o Job (envia o e-mail).
     */
    public function handle()
    {
        Mail::send('emails.notification', ['messageContent' => $this->message, 'subject' => $this->subject], function ($message) {
            $message->to($this->email)
                    ->subject($this->subject);
        });
    }
}
