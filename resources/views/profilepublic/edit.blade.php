<x-auth-card>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
        {{ __('Editar Perfil') }}
    </h2>

    @if(session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    <form method="POST" action="{{ route('profilepublic.update') }}">
        @csrf

        <!-- Exibe erros de validação -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Nome -->
        <div>
            <x-label for="name" :value="__('Nome')" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                     value="{{ old('name', $user->name) }}" required />
        </div>

        <!-- E-mail -->
        <div class="mt-4">
            <x-label for="email" :value="__('E-mail')" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                     value="{{ old('email', $user->email) }}" required />
        </div>

        <!-- Nova Senha -->
        <div class="mt-4">
            <x-label for="password" :value="__('Nova Palavra-Passe (opcional)')" />
            <x-input id="password" class="block mt-1 w-full" type="password" name="password" />
        </div>

        <!-- Confirmar Senha -->
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirmar Palavra-Passe')" />
            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
        </div>

        <!-- Botão de envio -->
        <div class="mt-4">
            <x-button class="ml-4">
                {{ __('Salvar Alterações') }}
            </x-button>
        </div>
    </form>
</x-auth-card>
