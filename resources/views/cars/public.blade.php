<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carros Disponíveis</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Inclua estilos necessários -->
</head>
<body>
    <div class="container">
        <h1>Carros Disponíveis</h1>
        <div class="row">
            @foreach ($cars as $car)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->make }} {{ $car->model }}</h5>
                        <p class="card-text">Ano: {{ $car->year }}</p>
                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
