<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Editar Serviço') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white rounded-md shadow-md">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="car_model" class="block text-sm font-medium text-gray-700">Modelo do Carro</label>
                <input type="text" name="car_model" id="car_model" value="{{ $service->car_model }}" required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="dealership" class="block text-sm font-medium text-gray-700">Concessionária</label>
                <input type="text" name="dealership" id="dealership" value="{{ $service->dealership }}" required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="delivery_date" class="block text-sm font-medium text-gray-700">Data de Entrega</label>
                <input type="date" name="delivery_date" id="delivery_date" value="{{ $service->delivery_date }}" required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="pickup_date" class="block text-sm font-medium text-gray-700">Data de Retirada</label>
                <input type="date" name="pickup_date" id="pickup_date" value="{{ $service->pickup_date }}" required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="service" class="block text-sm font-medium text-gray-700">Serviço</label>
                <textarea name="service" id="service" rows="3" required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $service->service }}</textarea>
            </div>

            <div class="flex gap-2">
                <div class="flex gap-2">
                    <button type="submit"
                        class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-400">
                        Atualizar
                    </button>
                
                    <a href="{{ route('admin.services.index') }}"
                        class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:ring-2 focus:ring-gray-300">
                        Cancelar
                    </a>
                </div>
                
            </div>
            
        </form>
    </div>
</x-app-layout>
