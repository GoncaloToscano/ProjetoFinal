<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>
    <!-- Link para a página principal -->
    <x-sidebar.link title="Página Principal" href="{{ route('welcome') }}">
        <x-slot name="icon">
            <x-heroicon-o-logout class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @if(auth()->user()->isAdmin())
        <!-- Link para o Dashboard -->
        <x-sidebar.link
            title="Dashboard"
            href="{{ route('dashboard') }}"
            :isActive="request()->routeIs('dashboard')"
        >
            <x-slot name="icon">
                <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>

        <!-- Dropdown de botões -->
        <x-sidebar.dropdown
            title="Outros"
            :active="Str::startsWith(request()->route()->uri(), 'buttons')"
        >
            <x-slot name="icon">
                <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>

            <x-sidebar.link title="Tabelas" href="#" />

            <x-sidebar.link title="Notas" href="#" />

        </x-sidebar.dropdown>

        <!-- Links -->
        <div
            x-transition
            x-show="isSidebarOpen || isSidebarHovered"
            class="text-sm text-gray-500"
        >
            Links
        </div>

        <!-- Definição dos 6 links -->
        <x-sidebar.link title="Utilizadores" href="{{ route('users.index') }}">
            <x-slot name="icon">
                <i class="fas fa-users"></i>
            </x-slot>
        </x-sidebar.link>

        <x-sidebar.link title="Funcionários" href="{{ route('employees.index') }}">
            <x-slot name="icon">
                <i class="fas fa-user-tie"></i>
            </x-slot>
        </x-sidebar.link>

        <x-sidebar.link title="Carro" href="{{ route('cars.index') }}">
            <x-slot name="icon">
                <i class="fas fa-car"></i>
            </x-slot>
        </x-sidebar.link>

        <x-sidebar.link title="Test-Drives" href="{{ route('testdrives.index') }}">
            <x-slot name="icon">
                <i class="fas fa-clipboard-list"></i>
            </x-slot>
        </x-sidebar.link>

        <x-sidebar.link title="Serviços" href="{{ route('admin.services.index') }}">
            <x-slot name="icon">
                <i class="fas fa-cogs"></i>
            </x-slot>
        </x-sidebar.link>

        <x-sidebar.link title="Notificar" href="{{ route('notifications.index') }}">
            <x-slot name="icon">
                <i class="fas fa-bell"></i>
            </x-slot>
        </x-sidebar.link>
    @endif
</x-perfect-scrollbar>