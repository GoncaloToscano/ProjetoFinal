<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Editar Carro') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Define o método como PUT -->

            <!-- Campo Nome -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $car->name) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm" 
                    required>
            </div>

            <!-- Campo Marca -->
            <div class="mb-4">
                <label for="brand" class="block text-sm font-medium text-gray-700">Marca</label>
                <input 
                    type="text" 
                    name="brand" 
                    id="brand" 
                    value="{{ old('brand', $car->brand) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm" 
                    required>
            </div>

            <!-- Campo Ano -->
            <div class="mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700">Ano</label>
                <input 
                    type="number" 
                    name="year" 
                    id="year" 
                    value="{{ old('year', $car->year) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm" 
                    required>
            </div>

            <!-- Campo Preço -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Preço</label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="price" 
                    id="price" 
                    value="{{ old('price', $car->price) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm" 
                    required>
            </div>

            <!-- Botões -->
            <div class="flex items-center gap-4">
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">Atualizar</button>
                <a href="{{ route('cars.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded-md">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
