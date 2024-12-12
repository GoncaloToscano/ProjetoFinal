<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>
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

    <!-- Link para a página principal -->
    <x-sidebar.link title="Página Principal" href="{{ route('welcome') }}">
        <x-slot name="icon">
            <x-heroicon-o-logout class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
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
    <x-sidebar.link title="Clientes" href="#" />
    <x-sidebar.link title="Funcionários" href="#" />
    <x-sidebar.link title="Carros" href="{{ route('cars.index') }}" />
    <x-sidebar.link title="Test-Drives" href="#" />
    <x-sidebar.link title="Serviços" href="#" />
    <x-sidebar.link title="Descontos" href="#" />
    <x-sidebar.link title="Concessionárias" href="#" />

</x-perfect-scrollbar>
