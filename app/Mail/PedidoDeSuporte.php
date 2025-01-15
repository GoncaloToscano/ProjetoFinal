<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PedidoDeSuporte extends Mailable
{
    use SerializesModels;

    public $nome;
    public $email;
    public $telefone;
    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $email, $telefone, $mensagem)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.suporte')
                    ->subject('Novo Pedido de Suporte')
                    ->with([
                        'nome' => $this->nome,
                        'email' => $this->email,
                        'telefone' => $this->telefone,
                        'mensagem' => $this->mensagem,
                    ]);
    }
}
