<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Gestão de Utilizadores') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <!-- Mensagem de erro -->
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-500 text-white rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Mensagem de sucesso -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulário de Pesquisa -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex justify-between">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Pesquisar por nome, email ou cargo..." 
                class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
            <div class="flex items-center space-x-2">
                <!-- Botão para limpar a pesquisa -->
                <a href="{{ route('users.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400">
                    Limpar Pesquisa
                </a>
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">Pesquisar</button>
            </div>
        </form>

        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">Nome</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Cargo</th>
                    <th class="border p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">{{ $user->role }}</td>
                        <td class="border p-2">
                            <!-- Não permite editar ou excluir o próprio utilizador -->
                            @if (Auth::id() !== $user->id)
                                <div class="flex gap-2">
                                    <a href="{{ route('users.edit', $user) }}" class="px-4 py-2 text-white bg-green-500 rounded-md text-center w-32">
                                        Editar
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="delete-form" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-md text-center w-32">
                                            Remover
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="px-2 py-1 text-gray-400">Para editares a tua conta acessa o teu perfil</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <!-- Adicionando o script SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Confirmar exclusão com SweetAlert
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Impede o envio do formulário imediatamente
                const form = this;
                
                Swal.fire({
                    title: 'Tens a certeza?',
                    text: 'Não podes reverter esta ação!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, apagar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Envia o formulário após confirmação
                    }
                });
            });
        });
    </script>
</x-app-layout>
