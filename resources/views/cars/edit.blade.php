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
                @error('name')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
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
                @error('brand')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
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
                @error('year')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
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
                @error('price')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo Quilometragem -->
            <div class="mb-4">
                <label for="kms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quilometragem</label>
                <input 
                    type="number" 
                    name="kms" 
                    id="kms" 
                    value="{{ old('kms', $car->kms) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('kms')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo Cor -->
            <div class="mb-4">
                <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cor</label>
                <input 
                    type="text" 
                    name="color" 
                    id="color" 
                    value="{{ old('color', $car->color) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('color')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo Potência -->
            <div class="mb-4">
                <label for="power" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Potência (cv)</label>
                <input 
                    type="number" 
                    name="power" 
                    id="power" 
                    value="{{ old('power', $car->power) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('power')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo Cilindrada -->
            <div class="mb-4">
                <label for="engine_capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cilindrada (cm³)</label>
                <input 
                    type="number" 
                    name="engine_capacity" 
                    id="engine_capacity" 
                    value="{{ old('engine_capacity', $car->engine_capacity) }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('engine_capacity')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo Câmbio -->
            <div class="mb-4">
                <label for="gearbox" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Câmbio/Transmissão</label>
                <select 
                    name="gearbox" 
                    id="gearbox" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="manual" {{ old('gearbox', $car->gearbox) == 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="automatica" {{ old('gearbox', $car->gearbox) == 'automatica' ? 'selected' : '' }}>Automática</option>
                </select>
                @error('gearbox')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para imagens (permitir múltiplas imagens) -->
            <div class="mb-4">
                <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagens do Carro</label>
                <input 
                    type="file" 
                    name="images[]" 
                    id="images" 
                    accept="image/*" 
                    multiple
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Você pode adicionar várias imagens (JPG, JPEG, PNG)</p>
                @error('images')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Exibir imagens atuais -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagens Atuais</label>
                <div class="grid grid-cols-3 gap-4">
                    @foreach($car->images as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Imagem do carro" class="rounded-md shadow-md">
                            <!-- Botão de exclusão -->
                            <a href="#" 
                                class="absolute top-0 right-0 text-red-500 bg-white rounded-full p-1"
                                onclick="deleteImage(event, {{ $image->id }})">
                                &times;
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function deleteImage(event, imageId) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Tens a certeza?',
                        text: "Esta ação é irreversível!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sim, apagar!',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/images/${imageId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Deletado!', 'A imagem foi excluída.', 'success');
                                    event.target.closest('div.relative').remove();
                                } else {
                                    Swal.fire('Erro!', 'Não foi possível excluir a imagem.', 'error');
                                }
                            })
                            .catch(() => {
                                Swal.fire('Erro!', 'Algo deu errado.', 'error');
                            });
                        }
                    });
                }
            </script>

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
