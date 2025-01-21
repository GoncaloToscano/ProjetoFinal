<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Gestão de Carros') }}
            </h2>
            <a href="{{ route('cars.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 transition">Adicionar Carro</a>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="border p-2 text-left">Nome</th>
                        <th class="border p-2 text-left">Marca</th>
                        <th class="border p-2 text-left">Ano</th>
                        <th class="border p-2 text-left">Preço</th>
                        <th class="border p-2 text-left">Kms</th>
                        <th class="border p-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                        <td class="border p-2">{{ $car->name }}</td>
                        <td class="border p-2">{{ $car->brand }}</td>
                        <td class="border p-2">{{ $car->year }}</td>
                        <td class="border p-2">{{ number_format($car->price, 2, ',', '.') }} €</td>
                        <td class="border p-2">{{ $car->kms }} km</td>
                        <td class="border p-2">
                            <div class="flex flex-col sm:flex-row gap-2">
                                <!-- Botão de Editar -->
                                <a href="{{ route('cars.edit', $car->id) }}" class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600 transition w-full sm:w-auto text-left">
                                    Editar
                                </a>
                                <!-- Formulário de Remover -->
                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline" id="deleteForm-{{ $car->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600 transition w-full sm:w-auto text-left" onclick="confirmDelete({{ $car->id }})">Remover</button>
                                </form>
                                <!-- Botão "Ver Mais" -->
                                <button class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 transition w-full sm:w-auto text-left" onclick="openModal({{ $car->id }})">Ver Mais</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal de Detalhes -->
                    <div id="modal-{{ $car->id }}" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-11/12 md:w-2/3 lg:w-1/2">
                            <h2 class="text-3xl font-semibold mb-4 text-gray-800 dark:text-white">{{ $car->name }}</h2>
                            <div class="space-y-2 mb-4">
                                <p class="text-gray-700 dark:text-gray-300"><strong>Marca:</strong> {{ $car->brand }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Ano:</strong> {{ $car->year }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Preço:</strong> {{ number_format($car->price, 2, ',', '.') }} €</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Quilometragem:</strong> {{ $car->kms }} km</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Combustível:</strong> {{ $car->fuel }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Cor:</strong> {{ $car->color }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Potência:</strong> {{ $car->power }} CV</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Cilindrada:</strong> {{ $car->engine_capacity }} cm³</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Caixa:</strong> {{ $car->gearbox }}</p>
                            </div>
                            <div class="space-y-4">
                                <h3 class="font-semibold text-gray-800 dark:text-white">Imagens:</h3>
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach ($car->images as $image)
                                        <img src="{{ asset('storage/'.$image->path) }}" alt="Car Image" class="w-full h-48 object-cover rounded-lg shadow-md">
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <button onclick="closeModal({{ $car->id }})" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Fechar</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Função para abrir o modal
        function openModal(carId) {
            document.getElementById('modal-' + carId).classList.remove('hidden');
        }

        // Função para fechar o modal
        function closeModal(carId) {
            document.getElementById('modal-' + carId).classList.add('hidden');
        }

        // Função para confirmar a remoção do carro
        function confirmDelete(carId) {
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
                    document.getElementById('deleteForm-' + carId).submit();
                }
            });
        }
    </script>
</x-app-layout>
