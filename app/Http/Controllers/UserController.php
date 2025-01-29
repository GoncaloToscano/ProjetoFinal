<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $loggedUserId = Auth::id(); // Obtém o ID do usuário logado

        // Filtra os usuários conforme a busca no nome, email e role
        $users = User::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
        })
        ->orderByRaw("id = {$loggedUserId} DESC") // Coloca o usuário logado no topo
        ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados enviados pelo formulário
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Confirmação de senha
            'role' => 'required|string|in:admin,user',
        ]);

        // Criação de um novo usuário com os dados validados
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        // Verifica se o usuário logado está tentando editar a sua própria conta
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Você não pode editar sua própria conta!');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Verifica se o usuário logado está tentando editar a sua própria conta
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Você não pode editar sua própria conta!');
        }

        // Validação dos dados enviados pelo formulário
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // Confirmação de senha
            'role' => 'required|string|in:admin,user',
        ]);

        // Atualizando o usuário com os dados validados
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
            'role' => $validated['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        // Verifica se o usuário logado está tentando excluir a sua própria conta
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Você não pode excluir sua própria conta!');
        }

        // Exclui o usuário
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilizador removido com sucesso!');
    }


    public function editProfile()
    {
        $user = Auth::user();
        return view('profilepublic.edit', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        // Validação dos dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // A senha é opcional
        ]);
    
        // Atualizando os dados do usuário
        $user->name = $validated['name'];
        $user->email = $validated['email'];
    
        // Se o usuário inseriu uma nova senha, criptografá-la antes de salvar
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
    
        $user->save();
    
        return redirect()->route('profile.edit')->with('success', 'Perfil atualizado com sucesso.');
    }
    
}
