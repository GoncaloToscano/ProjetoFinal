<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Gestão de Funcionários') }}
            </h2>
            <a href="{{ route('employees.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md">
                Adicionar Funcionário
            </a>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <!-- Formulário de Pesquisa -->
        <form method="GET" action="{{ route('employees.index') }}" class="mb-4 flex justify-between">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Pesquisar por nome, email ou cargo..." 
                class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
            <div class="flex items-center space-x-2">

                <!-- Botão para limpar a pesquisa -->
                <a href="{{ route('employees.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400">
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
                    <th class="border p-2">Salário Base</th>
                    <th class="border p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td class="border p-2">{{ $employee->name }}</td>
                    <td class="border p-2">{{ $employee->email }}</td>
                    <td class="border p-2">{{ $employee->position }}</td>
                    <td class="border p-2">{{ $employee->salary }} €</td>
                    <td class="border p-2">
                        <a href="{{ route('employees.edit', $employee) }}" class="px-2 py-1 text-white bg-green-500 rounded-md">Editar</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 text-white bg-red-500 rounded-md" onclick="return confirm('Tem a certeza que deseja remover?')">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $employees->appends(['search' => request('search')])->links() }}
        </div>

    </div>
</x-app-layout>
