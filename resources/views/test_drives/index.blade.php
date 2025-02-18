<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Test Drives Agendados') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 dark:text-gray-300">
        <!-- Filtros e Pesquisa -->
        <div class="flex flex-wrap gap-4 mb-6">
            <form action="{{ route('testdrives.index') }}" method="GET" class="flex items-center gap-4 w-full md:w-auto">
                <input type="text" name="search" value="{{ request()->query('search') }}" 
                    placeholder="Pesquisar por nome ou email..." 
                    class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 w-full sm:w-auto">
                <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                    Pesquisar
                </button>
                @if(request()->query('search'))
                    <a href="{{ route('testdrives.index') }}" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 transition">
                        Limpar Pesquisa
                    </a>
                @endif
            </form>

            <form action="{{ route('testdrives.index') }}" method="GET" class="flex items-center gap-4 w-full md:w-auto">
                <select name="status" 
                    class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 w-full sm:w-auto">
                    <option value="">Todos</option>
                    <option value="confirmed" {{ request()->query('status') === 'confirmed' ? 'selected' : '' }}>Confirmados</option>
                    <option value="pending" {{ request()->query('status') === 'pending' ? 'selected' : '' }}>Por Confirmar</option>
                </select>
                <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                    Filtrar
                </button>
            </form>

            <form action="{{ route('testdrives.index') }}" method="GET" class="flex items-center gap-4 w-full md:w-auto">
                <select name="order" 
                    class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 w-full sm:w-auto">
                    <option value="preferred_date_time" {{ request()->query('order') === 'preferred_date_time' ? 'selected' : '' }}>Data e Hora</option>
                    <option value="created_at" {{ request()->query('order') === 'created_at' ? 'selected' : '' }}>Data de Inserção</option>
                </select>
                <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                    Ordenar
                </button>
            </form>

            <!-- Botão para remover test drives expirados -->
            <form action="{{ route('testdrives.deleteExpired') }}" method="POST" id="deleteExpiredForm">
                @csrf
                <button type="button" onclick="confirmDeleteExpired()" 
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 transition">
                    Remover Test Drives Expirados
                </button>
            </form>
        </div>

        <!-- Tabela -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="border p-4 text-left dark:text-gray-200">Nome</th>
                        <th class="border p-4 text-left dark:text-gray-200">Email</th>
                        <th class="border p-4 text-left dark:text-gray-200">Telefone</th>
                        <th class="border p-4 text-left dark:text-gray-200">Data</th>
                        <th class="border p-4 text-left dark:text-gray-200">Hora</th>
                        <th class="border p-4 text-left dark:text-gray-200">Carro</th>
                        <th class="border p-4 text-left dark:text-gray-200">Observações</th>
                        <th class="border p-4 text-left dark:text-gray-200">Confirmado</th>
                        <th class="border p-4 text-center dark:text-gray-200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testDrives as $testDrive)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="border p-4">{{ $testDrive->name }}</td>
                            <td class="border p-4">{{ $testDrive->email }}</td>
                            <td class="border p-4">{{ $testDrive->phone }}</td>
                            <td class="border p-4">{{ $testDrive->preferred_date }}</td>
                            <td class="border p-4">{{ $testDrive->preferred_time }}</td>
                            <td class="border p-4">
                                <div>
                                    <strong>{{ $testDrive->car->name }}</strong><br>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $testDrive->car->brand }} - {{ $testDrive->car->color }}</span>
                                </div>
                            </td>
                            <td class="border p-4">
                                @if ($testDrive->observations)
                                    {{ $testDrive->observations }}
                                @else
                                    <span class="text-gray-500 dark:text-gray-400">Sem observações</span>
                                @endif
                            </td>
                            <td class="border p-4">
                                @if ($testDrive->confirmed)
                                    <span class="text-green-500 dark:text-green-400">Confirmado</span>
                                @else
                                    <span class="text-red-500 dark:text-red-400">Não Confirmado</span>
                                @endif
                            </td>
                            <td class="border p-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    @if (!$testDrive->confirmed)
                                        <form action="{{ route('testdrives.confirm', $testDrive->id) }}" method="POST" id="confirmForm-{{ $testDrive->id }}">
                                            @csrf
                                            <button type="button" onclick="confirmAction({{ $testDrive->id }}, 'confirm')" 
                                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                                                Confirmar
                                            </button>
                                        </form>
                                    @endif

                                    @if ($testDrive->confirmed)
                                        <form action="{{ route('testdrives.cancel', $testDrive->id) }}" method="POST" id="cancelForm-{{ $testDrive->id }}">
                                            @csrf
                                            <button type="button" onclick="confirmAction({{ $testDrive->id }}, 'cancel')" 
                                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">
                                                Cancelar
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('testdrives.destroy', $testDrive->id) }}" method="POST" id="deleteForm-{{ $testDrive->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmAction({{ $testDrive->id }}, 'delete')" 
                                            class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 dark:bg-red-700 dark:hover:bg-red-800">
                                            Remover
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-6">
            {{ $testDrives->links() }}
        </div>
    </div>

    <script>
        function confirmAction(testDriveId, action) {
            let title, text, confirmButtonText, formId;

            if (action === 'confirm') {
                title = 'Confirmar Agendamento?';
                text = 'O cliente será notificado que o test drive está confirmado.';
                confirmButtonText = 'Sim, confirmar!';
                formId = 'confirmForm-' + testDriveId;
            } else if (action === 'cancel') {
                title = 'Cancelar Agendamento?';
                text = 'O cliente será notificado que o agendamento foi cancelado.';
                confirmButtonText = 'Sim, cancelar!';
                formId = 'cancelForm-' + testDriveId;
            } else if (action === 'delete') {
                title = 'Remover Agendamento?';
                text = 'Esta ação não pode ser desfeita!';
                confirmButtonText = 'Sim, remover!';
                formId = 'deleteForm-' + testDriveId;
            }

            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            }); 
        }

        function confirmDeleteExpired() {
            Swal.fire({
                title: 'Remover Test Drives Expirados?',
                text: 'Todos os test drives que já passaram da data e hora serão permanentemente removidos!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, remover!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteExpiredForm').submit();
                }
            });
        }
    </script>
</x-app-layout>
