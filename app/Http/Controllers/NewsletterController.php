<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function enviar(Request $request)
    {
        $email = $request->input('email');

        // Verifique se o email já está cadastrado
        $newsletter = Newsletter::where('email', $email)->first();
        if ($newsletter) {
            return redirect()->back()->with('error', 'Esse e-mail já está registrado na nossa newsletter!');
        }

        // Cadastra o email
        $newsletter = new Newsletter();
        $newsletter->email = $email;
        $newsletter->save();

        return redirect()->back()->with('success', 'Subscreveste à nossa newsletter com sucesso!');
    }
}