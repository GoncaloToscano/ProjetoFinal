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
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-dark" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Drive<span>&Ride</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
    
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>

                    <li class="nav-item">
                      <a href="{{ route('cars.public.cars') }}" class="nav-link">Carros</a>
                    </li>
    
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a href="{{ url('/login') }}" class="nav-link">Login</a>
                            </li>
                        @endguest
    
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!-- Link de Dashboard para administradores -->
                                    @if(Auth::user()->role == 'admin')  <!-- Verifica a role do usuário -->
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            {{ __('Dashboard') }}  <!-- Link visível apenas para administradores -->
                                        </a>
                                    @endif
    
                                    <!-- Link de Logout que aparece para todos os usuários -->
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-decoration-none">
                                            {{ __('Logout') }}
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
    
                </ul>
            </div>
        </div>
    </nav>
<br><br><br>

<!-- Carro Detalhes -->
<div class="container mt-5">
  <h1 class="mb-4" style="text-transform: uppercase;">
    <strong>{{ $car->brand }}  {{ $car->name }} </strong>
  </h1>

  <div class="row">
    <!-- imagens -->
    <div class="col-md-6">
      <div id="carousel-{{ $car->id }}" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" style="height: 400px; background-size: cover;">
          @foreach($car->images as $index => $image)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
              <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Car Image" style="height: 400px; width: 400px; object-fit: cover; margin: 0 auto;">
            </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel-{{ $car->id }}" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-{{ $car->id }}" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

    <!-- Descrição do Carro -->
    <div class="col-md-6">
      <div class="card">
        <li class="list-group-item" style="font-size: 1.2rem; font-weight: bold;">
          <span style="font-size: 1.5rem; color:rgb(0, 0, 0); font-weight: bold;">
            {{ number_format($car->price, 2, ',', '.') }}€
          </span>
        </li>
        <div class="card-header">
          <h5>Detalhes do Veículo</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item"><strong>Marca:</strong> {{ $car->brand }}</li>
            <li class="list-group-item"><strong>Modelo:</strong> {{ $car->name }}</li>
            <li class="list-group-item"><strong>Ano:</strong> {{ $car->year }}</li>
            <li class="list-group-item"><strong>Combustível:</strong> {{ $car->fuel }}</li>
            <li class="list-group-item"><strong>Kilometragem:</strong> {{ number_format($car->kms, 0, ',', '.') }} KM</li>
            <li class="list-group-item"><strong>Cor:</strong> {{ $car->color }}</li>
            <li class="list-group-item"><strong>Potência:</strong> {{ $car->power }} CV</li>
          </ul>

          <div class="mt-4">
            <a href="{{ route('cars.public.cars') }}" class="btn btn-secondary">Voltar</a>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#carModal-{{ $car->id }}">Contactar</a>

<!-- Modal -->
<div class="modal fade" id="carModal-{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="carModalLabel-{{ $car->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carModalLabel-{{ $car->id }}">{{ $car->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Marca:</strong> {{ $car->brand }}</p>
                <p><strong>Preço:</strong> {{ $car->price }}€</p>
                <p>Entre em contato sem compromisso para obter mais informações, marcar encontro ou esclarecer dúvidas sobre este veículo.</p>
                <!-- Formulário de Contato -->
                <form action="{{ route('contact.admin') }}" method="POST">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <input type="hidden" name="car_name" value="{{ $car->name }}">
                    <input type="hidden" name="car_brand" value="{{ $car->brand }}">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Seu nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Seu email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Mensagem</label>
                        <textarea class="form-control" name="message" id="message" rows="4" placeholder="Sua mensagem" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Test - Drive Início -->
@if(auth()->check()) <!-- Verifica se o usuário está autenticado -->
    <a href="#" class="btn btn-secondary ml-auto" data-toggle="modal" data-target="#testDriveModal"> Agendar Test Drive</a>
@else
    <!-- Aviso de login necessário -->
    <div class="alert alert-warning d-flex align-items-center mt-3" role="alert">
        <i class="fas fa-exclamation-triangle mr-2"></i> <!-- Ícone de aviso -->
        <div>
            <strong>Você precisa estar logado!</strong> Para agendar um Test Drive, por favor, <a href="{{ route('login') }}" class="alert-link">faça login aqui</a>.
        </div>
    </div>
@endif

<!-- Modal Test Drive -->
<div class="modal fade" id="testDriveModal" tabindex="-1" aria-labelledby="testDriveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testDriveModalLabel">Agendar Test Drive</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->has('preferred_time'))
                    <div class="alert alert-danger">
                        {{ $errors->first('preferred_time') }}
                    </div>
                @endif

                <!-- Formulário -->
                <form action="{{ route('testdrive.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="car_id" value="{{ $car->id }}">

                    <div class="form-group">
                        <label for="name">Seu Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Escreva seu nome" value="{{ old('name', auth()->user()->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Seu E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Escreva seu e-mail" value="{{ old('email', auth()->user()->email) }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Seu Telefone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Escreva seu número de telefone" value="{{ old('phone') }}">
                    </div>

                    <div class="form-group">
                        <label for="preferred_date">Data Preferencial</label>
                        <input type="date" class="form-control" id="preferred_date" name="preferred_date" required value="{{ old('preferred_date') }}">
                    </div>

                    <div class="form-group">
                        <label for="preferred_time">Hora Preferencial</label>
                        <input type="time" class="form-control" id="preferred_time" name="preferred_time" required min="08:00" max="19:00" step="900" value="{{ old('preferred_time') }}">
                    </div>

                    <div class="form-group">
                        <label for="observations">Observações</label>
                        <textarea class="form-control" id="observations" name="observations" rows="4" placeholder="Caso tenha alguma observação." value="{{ old('observations') }}"></textarea>
                    </div>

                    <!-- Nova Checkbox para aceitar ser contactado -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="contact_permission" name="contact_permission" {{ old('contact_permission') ? 'checked' : '' }}>
                        <label class="form-check-label" for="contact_permission">Aceito ser contactado pelo número de telefone.</label>
                    </div>

                    <!-- Termos e Condições -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms_accepted" required {{ old('terms_accepted') ? 'checked' : '' }}>
                        <label class="form-check-label" for="terms">
                            Eu aceito os <a href="{{ route('terms') }}" class="alert-link" target="_blank">termos e condições</a>.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar Pedido</button>
                </form>
            </div>
        </div>
    </div>
</div>

           <!-- Sucesso mensagem desaparece em 4 segundos-->
           @if(session('success'))
           <br><br>
           <div class="alert alert-success" id="success-alert">
               {{ session('success') }}
           </div>
           <script>
               // Após 4 segundos (4000 milissegundos), ocultar a mensagem
               setTimeout(function() {
                   $('#success-alert').fadeOut('slow');
               }, 4000);
           </script>
       @endif

<!-- Test - Drive Fim -->


<!-- Scripts -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.timepicker.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
