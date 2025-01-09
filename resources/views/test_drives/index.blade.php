<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Test Drives Agendados') }}
            </h2>
            
            <!-- Formulário de Pesquisa -->
            <form action="{{ route('testdrives.index') }}" method="GET" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request()->query('search') }}" placeholder="Pesquisar por nome ou email..." class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                
                <!-- Botão de Pesquisa -->
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 transition">Pesquisar</button>

                <!-- Botão de Limpar Pesquisa (aparece se houver um termo de pesquisa) -->
                @if(request()->query('search'))
                    <a href="{{ route('testdrives.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-600 transition">Limpar Pesquisa</a>
                @endif
            </form>

            <!-- Filtro de Confirmados -->
            <form action="{{ route('testdrives.index') }}" method="GET" class="flex items-center gap-2">
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    <option value="">Todos</option>
                    <option value="confirmed" {{ request()->query('status') === 'confirmed' ? 'selected' : '' }}>Confirmados</option>
                    <option value="pending" {{ request()->query('status') === 'pending' ? 'selected' : '' }}>Por Confirmar</option>
                </select>
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 transition">Filtrar</button>
            </form>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">Nome</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Data</th>
                    <th class="border p-2">Hora</th>
                    <th class="border p-2">Carro</th>
                    <th class="border p-2">Confirmado</th>
                    <th class="border p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testDrives as $testDrive)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                        <td class="border p-2">{{ $testDrive->name }}</td>
                        <td class="border p-2">{{ $testDrive->email }}</td>
                        <td class="border p-2">{{ $testDrive->preferred_date }}</td>
                        <td class="border p-2">{{ $testDrive->preferred_time }}</td>
                        <td class="border p-2">
                            <span class="font-semibold">{{ $testDrive->car->name }}</span><br>
                            <span class="text-sm text-gray-600">{{ $testDrive->car->brand }} - {{ $testDrive->car->color }}</span>
                        </td>
                        <td class="border p-2">
                            @if ($testDrive->confirmed)
                                <span class="text-green-500 dark:text-green-300">Confirmado</span>
                            @else
                                <span class="text-red-500 dark:text-red-300">Não Confirmado</span>
                            @endif
                        </td>
                        <td class="border p-2">
                            <!-- Confirmar agendamento -->
                            @if (!$testDrive->confirmed)
                                <form action="{{ route('testdrives.confirm', $testDrive->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-600 transition">
                                        Confirmar
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500 dark:text-gray-400">Confirmado</span>
                            @endif
                            
                            <!-- Cancelar agendamento -->
                            @if ($testDrive->confirmed)
                                <form action="{{ route('testdrives.cancel', $testDrive->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-600 transition">
                                        Cancelar
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('testdrives.destroy', $testDrive->id) }}" method="POST" style="display:inline;" id="deleteForm-{{ $testDrive->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="px-4 py-2 text-white bg-red-700 rounded-md hover:bg-red-800 dark:bg-red-800 dark:hover:bg-red-900 transition" onclick="confirmDelete({{ $testDrive->id }})">
                                    Remover
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   
<script>
    function confirmDelete(testDriveId) {
        Swal.fire({
            title: 'Tens a certeza?',
            text: 'Esta ação não pode ser revertida!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, remover!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Envia o formulário de exclusão
                document.getElementById('deleteForm-' + testDriveId).submit();
            }
        });
    }
</script>
</x-app-layout>
