<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Editar Carro') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-gray-800">
        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Campo Nome -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $car->name) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
            </div>

            <!-- Campo Marca -->
            <div class="mb-4">
                <label for="brand" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marca</label>
                <input 
                    type="text" 
                    name="brand" 
                    id="brand" 
                    value="{{ old('brand', $car->brand) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
            </div>

            <!-- Campo Ano -->
            <div class="mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ano</label>
                <input 
                    type="number" 
                    name="year" 
                    id="year" 
                    value="{{ old('year', $car->year) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
            </div>

            <!-- Campo Preço -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Preço</label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="price" 
                    id="price" 
                    value="{{ old('price', $car->price) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
            </div>

            <!-- Campo para imagem -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagem do Carro</label>
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    accept="image/*" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Escolha uma imagem para o carro (JPG, JPEG, PNG)</p>
            </div>

            <!-- Botões -->
            <div class="flex items-center gap-4">
                <button 
                    type="submit" 
                    class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none 
                           dark:bg-blue-700 dark:hover:bg-blue-600 dark:focus:ring-blue-500">
                    Atualizar
                </button>
                <a 
                    href="{{ route('cars.index') }}" 
                    class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none 
                           dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
