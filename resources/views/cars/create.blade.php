<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Adicionar Carro') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-gray-800">
        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Marca -->
            <div class="mb-4">
                <label for="brand" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marca</label>
                <input type="text" name="brand" id="brand" value="{{ old('brand') }}" 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
            </div>

            <!-- Nome -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Modelo</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
            </div>

            <!-- Ano -->
            <div class="mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ano</label>
                <input type="number" name="year" id="year" value="{{ old('year') }}" 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
            </div>

            <!-- Preço -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Preço</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
            </div>

            <!-- Combustível -->
            <div class="mb-4">
                <label for="fuel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Combustível</label>
                <select name="fuel" id="fuel" 
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
                    <option value="" disabled selected>Selecione o tipo de combustível</option>
                    <option value="gasolina">Gasolina</option>
                    <option value="diesel">Diesel</option>
                    <option value="eletrico">Elétrico</option>
                    <option value="hibrido">Híbrido</option>
                </select>
            </div>

            <!-- Quilometragem -->
            <div class="mb-4">
                <label for="kms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quilometragem (km)</label>
                <input type="number" name="kms" id="kms" value="{{ old('kms') }}" 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
            </div>

            <!-- Cor -->
            <div class="mb-4">
                <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cor</label>
                <input type="text" name="color" id="color" value="{{ old('color') }}" 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
            </div>

            <!-- Potência -->
            <div class="mb-4">
                <label for="power" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Potência (cv)</label>
                <input type="number" name="power" id="power" value="{{ old('power') }}" 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
            </div>

            <!-- Cilindrada -->
            <div class="mb-4">
                <label for="engine_capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cilindrada (cm³)</label>
                <input type="number" name="engine_capacity" id="engine_capacity" value="{{ old('engine_capacity') }}" 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
            </div>

            <!-- Câmbio/Transmissão -->
            <div class="mb-4">
                <label for="gearbox" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Câmbio/Transmissão</label>
                <select name="gearbox" id="gearbox" 
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
                    <option value="" disabled selected>Selecione o tipo de câmbio</option>
                    <option value="manual">Manual</option>
                    <option value="automatica">Automática</option>
                </select>
            </div>

            <!-- Campo para múltiplas imagens -->
            <div class="mb-4">
                <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagens do Carro</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700">
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Escolha uma ou mais imagens para o carro (JPG, JPEG, PNG)</p>
            </div>

            <button type="submit" 
                    class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-400">
                Salvar
            </button>

            <a href="{{ route('cars.index') }}" 
               class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:ring-2 focus:ring-gray-300">
                Cancelar
            </a>
        </form>
    </div>
</x-app-layout>
