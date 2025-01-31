<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Gestão de Carros') }}
            </h2>
            <a href="{{ route('cars.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 transition">Adicionar Carro</a>
        </div>
    </x-slot>

    <!-- Swiper.js CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        
        <!-- Formulário de Pesquisa -->
        <form method="GET" action="{{ route('cars.index') }}" class="mb-4 flex flex-col sm:flex-row gap-2">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Pesquisar por nome, marca..." 
                class="w-full sm:w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
            <div class="flex items-center space-x-2">
                <!-- Botão para limpar a pesquisa -->
                <a href="{{ route('cars.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400">
                    Limpar Pesquisa
                </a>
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">Pesquisar</button>
            </div>
        </form>

        <!-- Opções de ordenação -->
        <div class="flex flex-col md:flex-row md:justify-between mb-4">
            <div>
                <form method="GET" action="{{ route('cars.index') }}" class="flex flex-col sm:flex-row gap-2">
                    <!-- Mantém os filtros aplicados -->
                    @foreach(request()->except('sort', '_token') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <div class="relative">
                        <select name="sort" class="appearance-none w-full sm:w-auto border border-gray-300 rounded-md p-2 pl-10 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mais Recentes</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Mais Antigo</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Preço: Menor para Maior</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Preço: Maior para Menor</option>
                            <option value="year_asc" {{ request('sort') == 'year_asc' ? 'selected' : '' }}>Ano: Menor para Maior</option>
                            <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>Ano: Maior para Menor</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nome: A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nome: Z-A</option>
                        </select>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <i class="fas fa-sort-amount-down-alt"></i>
                        </div>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                        Ordenar
                    </button>
                    
                </form>
            </div>
        </div>

        <!-- Tabela de Carros -->
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
                                <a href="{{ route('cars.edit', $car->id) }}" class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600 transition">
                                    Editar
                                </a>
                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" id="deleteForm-{{ $car->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600 transition" onclick="confirmDelete({{ $car->id }})">Remover</button>
                                </form>

                                <button class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 transition" onclick="openModal({{ $car->id }})">Ver Mais</button>

                            </div>
                        </td>
                    </tr>
                    <!-- Modal de Detalhes -->
                        <div id="modal-{{ $car->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 transition-opacity">
                            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-xl w-11/12 md:w-2/3 lg:w-1/2 max-h-screen overflow-hidden transform transition-all scale-95">
                                
                                <!-- Modal Header -->
                                <div class="flex justify-between items-center border-b pb-4">
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $car->name }}</h2>
                                    <button onclick="closeModal({{ $car->id }})" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Modal Body -->
                                <div class="overflow-y-auto max-h-[80vh] p-4">
                                    <!-- Car Info -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Informações do Carro</h3>
                                            <p><strong>Marca:</strong> {{ $car->brand }}</p>
                                            <p><strong>Ano:</strong> {{ $car->year }}</p>
                                            <p><strong>Preço:</strong> <span class="text-green-600 font-semibold">{{ number_format($car->price, 2, ',', '.') }} €</span></p>
                                            <p><strong>Quilometragem:</strong> {{ number_format($car->kms, 0, ',', '.') }} km</p>
                                        </div>
                                        <div class="space-y-2">
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Especificações Técnicas</h3>
                                            <p><strong>Combustível:</strong> {{ $car->fuel }}</p>
                                            <p><strong>Cor:</strong> {{ $car->color }}</p>
                                            <p><strong>Potência:</strong> {{ $car->power }} CV</p>
                                            <p><strong>Cilindrada:</strong> {{ number_format($car->engine_capacity, 0, ',', '.') }} cm³</p>
                                            <p><strong>Caixa:</strong> {{ $car->gearbox }}</p>
                                        </div>
                                    </div>

                                    <!-- Car Images - Display lado a lado -->
                                    <div class="mt-6">
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Galeria de Imagens</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach ($car->images as $image)
                                                <div class="flex justify-center">
                                                    <img src="{{ asset('storage/'.$image->path) }}" alt="Car Image" class="w-full h-48 object-cover rounded-lg shadow-md">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
               <!-- Paginação -->
                <div class="mt-4">
                     {{ $cars->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>  

     

    <script>

        function openModal(carId) {
            document.getElementById('modal-' + carId).classList.remove('hidden');
            
        }

        function closeModal(id) {
        document.getElementById("modal-" + id).classList.add("hidden");
    }

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

