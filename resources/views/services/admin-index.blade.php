<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Gestão de Serviços') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.services.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md">
                    Adicionar Serviço
                </a>
                <!-- Botão de Remover Serviços Expirados -->
                <button 
                    type="button" 
                    class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600 focus:ring-2 focus:ring-red-400"
                    onclick="confirmDeleteExpired()">
                    Remover Serviços Expirados
                </button>
                <form id="deleteExpiredForm" action="{{ route('admin.services.deleteExpired') }}" method="POST" style="display:none">
                    @csrf
                </form>
            </div>
        </div>
    </x-slot>

    <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
        <!-- Formulário de Pesquisa -->
        <form method="GET" action="{{ route('admin.services.index') }}" class="mb-4 flex flex-col sm:flex-row sm:space-x-4 sm:justify-between">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Pesquisar por modelo, concessionária, serviço..." 
                class="w-full sm:w-1/2 lg:w-1/3 p-2 mb-2 sm:mb-0 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2">
                <!-- Botão para limpar a pesquisa -->
                <a href="{{ route('admin.services.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400">
                    Limpar Pesquisa
                </a>

                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">Pesquisar</button>
            </div>
        </form>

        <!-- Tabela de Serviços -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse table-auto">
                <thead>
                    <tr>
                        <th class="border p-2 text-left text-gray-800 dark:text-gray-100">Modelo do Carro</th>
                        <th class="border p-2 text-left text-gray-800 dark:text-gray-100">Concessionária</th>
                        <th class="border p-2 text-left text-gray-800 dark:text-gray-100">Data de Entrega</th>
                        <th class="border p-2 text-left text-gray-800 dark:text-gray-100">Data de Retirada</th>
                        <th class="border p-2 text-left text-gray-800 dark:text-gray-100">Serviço</th>
                        <th class="border p-2 text-left text-gray-800 dark:text-gray-100">Nome do Utilizador</th> 
                        <th class="border p-2 text-left text-gray-800 dark:text-gray-100">Email do Utilizador</th> 
                        <th class="border p-2 text-left text-gray-800 dark:text-gray-100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                        <td class="border p-2 text-gray-800 dark:text-gray-100">{{ $service->car_model }}</td>
                        <td class="border p-2 text-gray-800 dark:text-gray-100">{{ $service->dealership }}</td>
                        <td class="border p-2 text-gray-800 dark:text-gray-100">{{ $service->delivery_date }}</td>
                        <td class="border p-2 text-gray-800 dark:text-gray-100">{{ $service->pickup_date }}</td>
                        <td class="border p-2 text-gray-800 dark:text-gray-100">{{ $service->service }}</td>
                        <td class="border p-2 text-gray-800 dark:text-gray-100">{{ $service->user_name ?? 'Utilizador não encontrado' }}</td>
                        <td class="border p-2 text-gray-800 dark:text-gray-100">{{ $service->user_email ?? 'Email não disponível' }}</td>
                        <td class="border p-2 text-left text-gray-800 dark:text-gray-100 flex gap-2 flex-wrap justify-start">
                            <a href="{{ route('admin.services.edit', $service) }}" class="px-4 py-2 text-white bg-green-500 rounded-md mb-2 sm:mb-0 text-center">
                                Editar
                            </a>
                            <form id="deleteForm-{{ $service->id }}" action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="px-4 py-2 text-white bg-red-500 rounded-md text-center"
                                    onclick="confirmDelete({{ $service->id }})">
                                    Remover
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $services->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(serviceId) {
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
                    document.getElementById('deleteForm-' + serviceId).submit();
                }
            });
        }

        function confirmDeleteExpired() {
            Swal.fire({
                title: 'Tens a certeza?',
                text: 'Isto irá remover todos os serviços expirados!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, apagar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteExpiredForm').submit();
                }
            });
        }
    </script>
</x-app-layout>
