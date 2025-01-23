<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Notificar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Enviar Comunicado</h3>

                <!-- Campo para visualizar destinatários selecionados -->
                <div class="mb-6">
                    <label for="selected-recipients" class="block text-gray-700 dark:text-gray-300 font-medium">Destinatários Selecionados</label>
                    <div 
                        id="selected-recipients" 
                        class="w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm p-3 min-h-[3rem] overflow-y-auto">
                        <span class="text-gray-500 dark:text-gray-400">Nenhum destinatário selecionado</span>
                    </div>
                    <!-- Botões para selecionar todos os destinatários e limpar seleções -->
                    <div class="mt-2 flex space-x-2">
                        <button 
                            type="button" 
                            id="select-all" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Selecionar Todos
                        </button>
                        <button 
                            type="button" 
                            id="clear-selections" 
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Limpar Seleções
                        </button>
                    </div>
                </div>

                <form action="{{ route('notifications.send') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="subject" class="block text-gray-700 dark:text-gray-300 font-medium">Assunto</label>
                        <input 
                            type="text" 
                            name="subject" 
                            id="subject" 
                            class="w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" 
                            placeholder="Escreva o assunto do comunicado" 
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 dark:text-gray-300 font-medium">Mensagem</label>
                        <textarea 
                            name="message" 
                            id="message" 
                            rows="6" 
                            class="w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" 
                            placeholder="Escreva sua mensagem aqui" 
                            required
                        ></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="recipients" class="block text-gray-700 dark:text-gray-300 font-medium">Destinatários</label>
                        <input 
                            type="text" 
                            id="search-recipients" 
                            class="w-full mb-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" 
                            placeholder="Pesquise por email"
                        >
                        <select 
                            name="recipients[]" 
                            id="recipients" 
                            class="w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" 
                            multiple
                        >
                            @foreach ($users as $user)
                                <option value="{{ $user->email }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <small class="text-gray-500 dark:text-gray-400">Segure Ctrl (ou Cmd no Mac) para selecionar vários destinatários.</small>
                    </div>

                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const recipientsSelect = document.getElementById('recipients');
            const selectedRecipientsDiv = document.getElementById('selected-recipients');
            const searchInput = document.getElementById('search-recipients');
            const selectAllButton = document.getElementById('select-all');
            const clearSelectionsButton = document.getElementById('clear-selections');

            // Função para atualizar os destinatários selecionados
            function updateSelectedRecipients() {
                const selectedOptions = Array.from(recipientsSelect.selectedOptions);
                selectedRecipientsDiv.innerHTML = selectedOptions.length > 0
                    ? selectedOptions.map(option => 
                        `<span class='flex justify-between'>
                            <span>${option.textContent}</span>
                            <button type='button' class='text-red-500' data-email='${option.value}'>Remover</button>
                        </span>`
                    ).join('')
                    : '<span class="text-gray-500 dark:text-gray-400">Nenhum destinatário selecionado</span>';
                
                // Adicionar evento de remoção aos botões de "Remover"
                document.querySelectorAll('[data-email]').forEach(button => {
                    button.addEventListener('click', () => {
                        const emailToRemove = button.getAttribute('data-email');
                        const optionToRemove = Array.from(recipientsSelect.options)
                            .find(option => option.value === emailToRemove);
                        optionToRemove.selected = false;
                        updateSelectedRecipients();
                    });
                });
            }

            // Atualiza a lista sempre que a seleção de destinatários mudar
            recipientsSelect.addEventListener('change', updateSelectedRecipients);

            // Filtro de pesquisa de emails
            searchInput.addEventListener('input', () => {
                const filter = searchInput.value.toLowerCase();
                Array.from(recipientsSelect.options).forEach(option => {
                    const text = option.textContent.toLowerCase();
                    option.style.display = text.includes(filter) ? '' : 'none';
                });
            });

            // Selecionar todos os destinatários
            selectAllButton.addEventListener('click', () => {
                Array.from(recipientsSelect.options).forEach(option => option.selected = true);
                updateSelectedRecipients();
            });

            // Limpar todas as seleções
            clearSelectionsButton.addEventListener('click', () => {
                Array.from(recipientsSelect.options).forEach(option => option.selected = false);
                updateSelectedRecipients();
            });
        });
    </script>
</x-app-layout>
