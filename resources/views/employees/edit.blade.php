<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Editar Funcionário') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-gray-800">
        <form action="{{ route('employees.update', $employee) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ $employee->name }}" 
                    required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ $employee->email }}" 
                    required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cargo</label>
                <input 
                    type="text" 
                    name="position" 
                    id="position" 
                    value="{{ $employee->position }}" 
                    required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salário</label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="salary" 
                    id="salary" 
                    value="{{ $employee->salary }}" 
                    required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <button 
                type="submit" 
                class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none 
                       dark:bg-blue-700 dark:hover:bg-blue-600 dark:focus:ring-blue-500">
                Atualizar
            </button>

            <a 
                href="{{ route('employees.index') }}" 
                class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none 
                       dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400">
                Cancelar
            </a>
            
        </form>
    </div>
</x-app-layout>
