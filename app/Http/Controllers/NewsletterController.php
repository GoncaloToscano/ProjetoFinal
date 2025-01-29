<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Mail\NewsletterWelcomeMail;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $email = $request->input('email');

        // Cadastra o email
        $newsletter = new Newsletter();
        $newsletter->email = $email;
        $newsletter->save();

        // Envia o e-mail de boas-vindas
        Mail::to($email)->send(new NewsletterWelcomeMail($email));

        return redirect()->back()->with('success', 'Subscreveste à nossa newsletter com sucesso! Verifica o teu e-mail.');
    }
}
