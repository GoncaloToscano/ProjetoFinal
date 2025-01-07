<!DOCTYPE html>
<html lang="en">
<head>
  <title>Drive&Ride</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="{{ asset('assets/css/font.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <style>
    /* Ajustes no Carrossel de Imagens */
    .carousel-inner img {
      height: 400px;
      object-fit: cover;
    }
  </style>
</head>
<body>
<!-- Navbar Drive&Ride -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand text-white" href="{{ url('/') }}" style="font-size: 24px; font-weight: 700;">
      Drive<span style="color: #007bff;">&</span>Ride
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('cars.public.cars') }}" style="font-size: 18px;">Carros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#" style="font-size: 18px;">Test Drive</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="contactos.html" style="font-size: 18px;">Contactos</a>
        </li>

        <!-- Navbar links for guests -->
        @guest
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ url('/login') }}" style="font-size: 18px;">Login</a>
          </li>
        @endguest

        <!-- Navbar links for authenticated users -->
        @auth
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <!-- Admin link -->
              @if(Auth::user()->role == 'admin')
                <a class="dropdown-item" href="{{ route('dashboard') }}">
                  {{ __('Dashboard') }}
                </a>
              @endif

              <!-- Logout link -->
              <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none text-dark">
                  {{ __('Logout') }}
                </button>
              </form>
            </div>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
<br><br><br>

  <!-- Carro Detalhes -->
  <div class="container mt-5">
    <h1 class="mb-4">
      <span class="text-muted">{{ $car->brand }}  </span>{{ $car->name }}
    </h1>

    <div class="row">

    <!-- imagens -->
            <!-- Carrossel de Imagens -->
            <div class="col-md-6">
                <!-- Carrossel de imagens -->
                <div id="carousel-{{ $car->id }}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" style="height: 400px; background-size: cover;">
                    @foreach($car->images as $index => $image)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Car Image" style="height: 400px; width: 400px; object-fit: cover; margin: 0 auto;">
                    </div>
                    @endforeach
                </div>

                <!-- Controles do carrossel -->
                <a class="carousel-control-prev" href="#carousel-{{ $car->id }}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-{{ $car->id }}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>
                <!-- Fim do carrossel -->

            </div>

      <!-- Descrição do Carro -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Detalhes do Veículo</h4>
          </div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item"><strong>Nome:</strong> {{ $car->name }}</li>
              <li class="list-group-item"><strong>Marca:</strong> {{ $car->brand }}</li>
              <li class="list-group-item"><strong>Ano:</strong> {{ $car->year }}</li>
              <li class="list-group-item"><strong>Preço:</strong> {{ number_format($car->price, 2, ',', '.') }}€</li>
              <li class="list-group-item"><strong>Combustível:</strong> {{ $car->fuel }}</li>
              <li class="list-group-item"><strong>Kilometragem:</strong> {{ number_format($car->kms, 0, ',', '.') }} KM</li>
              <li class="list-group-item"><strong>Cor:</strong> {{ $car->color }}</li>
              <li class="list-group-item"><strong>Potência:</strong> {{ $car->power }} CV</li>
            </ul>
            <div class="mt-4">
              <a href="{{ route('cars.public.cars') }}" class="btn btn-secondary">Voltar para a lista</a>
              <a href="#" class="btn btn-primary">Entrar em contacto</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Rodapé -->
  <footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2"><a href="#" class="logo">Drive&<span>Ride</span></a></h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
