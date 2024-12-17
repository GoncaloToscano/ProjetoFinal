<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Gestão de Carros') }}
            </h2>
            <a href="{{ route('cars.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md">Adicionar Carro</a>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">Nome</th>
                    <th class="border p-2">Marca</th>
                    <th class="border p-2">Ano</th>
                    <th class="border p-2">Preço</th>
                    <th class="border p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                <tr>
                    <td class="border p-2">{{ $car->name }}</td>
                    <td class="border p-2">{{ $car->brand }}</td>
                    <td class="border p-2">{{ $car->year }}</td>
                    <td class="border p-2">{{ $car->price }}</td>
                    <td class="border p-2">
                        <a href="{{ route('cars.edit', $car) }}" class="px-2 py-1 text-white bg-green-500 rounded-md">Editar</a>
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" style="display:inline" id="deleteForm-{{ $car->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="px-2 py-1 text-white bg-red-500 rounded-md" onclick="confirmDelete({{ $car->id }})">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(carId) {
            // Use SweetAlert2 to confirm delete
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
                    // If confirmed, submit the form
                    document.getElementById('deleteForm-' + carId).submit();
                }
            });
        }
    </script>
</x-app-layout>
