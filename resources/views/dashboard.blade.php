<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-gray-800 dark:text-white">
        {{ __("Login feito com sucesso, bem-vindo!") }}
        
        <!-- Contadores de Usuários, Funcionários, Carros e Test-Drives -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4 mt-6">
            <!-- Card de Usuários -->
            <div class="bg-blue-100 dark:bg-blue-600 p-4 rounded-lg shadow-md flex items-center gap-4">
                <i class="fas fa-user-circle text-4xl text-blue-600 dark:text-blue-200"></i>
                <div>
                    <h5 class="text-xl font-semibold">Total de Utilizadores</h5>
                    <p class="text-3xl font-bold">{{ $usersCount }}</p>
                </div>
            </div>

            <!-- Card de Funcionários -->
            <div class="bg-purple-100 dark:bg-purple-600 p-4 rounded-lg shadow-md flex items-center gap-4">
                <i class="fas fa-users text-4xl text-purple-600 dark:text-purple-200"></i>
                <div>
                    <h5 class="text-xl font-semibold">Total de Funcionários</h5>
                    <p class="text-3xl font-bold">{{ $employeesCount }}</p>
                </div>
            </div>

            <!-- Card de Carros -->
            <div class="bg-yellow-100 dark:bg-yellow-600 p-4 rounded-lg shadow-md flex items-center gap-4">
                <i class="fas fa-car text-4xl text-yellow-600 dark:text-yellow-200"></i>
                <div>
                    <h5 class="text-xl font-semibold">Total de Carros</h5>
                    <p class="text-3xl font-bold">{{ $carsCount }}</p>
                </div>
            </div>

            <!-- Card de Test-Drives com ícone de Calendário -->
            <div class="bg-red-100 dark:bg-red-600 p-4 rounded-lg shadow-md flex items-center gap-4">
                <i class="fas fa-calendar text-4xl text-red-600 dark:text-red-200"></i>
                <div>
                    <h5 class="text-xl font-semibold">Total de Test-Drives</h5>
                    <p class="text-3xl font-bold">{{ $testDrivesCount }}</p>
                </div>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Gráfico de Rosca -->
            <div class="flex justify-center">
                <canvas id="dashboardChart"></canvas>
            </div>

            <!-- Gráfico de Área -->
            <div class="flex justify-center">
                <canvas id="areaChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Incluir o Chart.js e Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        // Gráfico Doughnut (rosca)
        var ctx = document.getElementById('dashboardChart').getContext('2d');
        var dashboardChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Usuários', 'Funcionários', 'Carros', 'Test-Drives'],
                datasets: [{
                    label: 'Contagem',
                    data: [{{ $usersCount }}, {{ $employeesCount }}, {{ $carsCount }}, {{ $testDrivesCount }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',   // Azul para Usuários
                        'rgba(153, 102, 255, 1)',   // Roxo para Funcionários
                        'rgba(255, 159, 64, 0.8)',   // Laranja para Carros
                        'rgba(255, 99, 132, 0.8)'    // Vermelho para Test-Drives
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cutoutPercentage: 70,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Área
        var areaCtx = document.getElementById('areaChart').getContext('2d');
        var areaChart = new Chart(areaCtx, {
            type: 'line', // Utilizamos o tipo 'line' para o gráfico de área
            data: {
                labels: ['Usuários', 'Funcionários', 'Carros', 'Test-Drives'],
                datasets: [{
                    label: 'Contagem',
                    data: [{{ $usersCount }}, {{ $employeesCount }}, {{ $carsCount }}, {{ $testDrivesCount }}],
                    borderColor: 'rgba(153, 102, 255, 1)', // Cor da linha
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // Cor do preenchimento
                    fill: true, // Preenche a área abaixo da linha
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <style>
        /* Ajuste do tamanho dos gráficos */
        #dashboardChart, #areaChart {
            width: 400px !important;
            height: 400px !important;
        }
    </style>
</x-app-layout>
