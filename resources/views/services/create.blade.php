<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Adicionar Serviço') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-gray-800">
        <form action="{{ route('services.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="mb-4">
                <label for="service" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Serviço</label>
                <input 
                    type="text" 
                    name="service" 
                    id="service" 
                    required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="car_model" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Modelo do Carro</label>
                <input 
                    type="text" 
                    name="car_model" 
                    id="car_model" 
                    required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="dealership" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Concessionária</label>
                <input 
                    type="text" 
                    name="dealership" 
                    id="dealership" 
                    required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="delivery_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data de Entrega</label>
                <input 
                    type="date" 
                    name="delivery_date" 
                    id="delivery_date" 
                    required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="pickup_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data de Recolha</label>
                <input 
                    type="date" 
                    name="pickup_date" 
                    id="pickup_date" 
                    required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <button 
                type="submit" 
                class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none 
                       dark:bg-blue-700 dark:hover:bg-blue-600 dark:focus:ring-blue-500">
                Salvar
            </button>

            <a 
                href="{{ route('services.index') }}" 
                class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none 
                       dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400">
                Cancelar
            </a>
        </form>
    </div>
</x-app-layout>
