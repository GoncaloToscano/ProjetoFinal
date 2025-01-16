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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
  
  <!-- Navbar Drive&Ride -->
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Drive<span>&Ride</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
    
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                      <a href="{{ route('cars.public.cars') }}" class="nav-link">Carros</a>
                    </li>
                    
                    <li class="nav-item"><a href="{{ url('/#contactos') }}" class="nav-link">Contactos</a></li>

    
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
                                    @if(Auth::user()->role == 'admin')  
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            {{ __('Dashboard') }} 
                                        </a>
                                    @endif
    
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


  <!-- Hero Section -->
  <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
          <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Serviços <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Serviços</h1>
        </div>
      </div>
    </div>
  </section>

 
  <!-- Notificação -->
    <div class="container">
      @if(session('success'))
          <div id="toast" class="toast show">
              <div class="toast-body">
                  <i class="icon-check"></i>
                  <span>{{ session('success') }}</span>
              </div>
          </div>
      @endif
    </div>
  </section>

  <!-- Estilos da notificação -->
  <style>
    .toast {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #28a745; /* Cor verde */
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        font-size: 16px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease, transform 0.5s ease, visibility 0.5s ease;
        z-index: 1050;
    }

    .toast.show {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    .toast-body {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .toast i {
        margin-right: 10px;
        font-size: 20px;
    }

    .toast span {
        font-weight: bold;
    }

    .toast i.icon-check {
        color: #fff;
        font-size: 22px;
        font-weight: 600;
    }

    .toast.success {
        background-color: #28a745;
    }

    .toast.error {
        background-color: #dc3545;
    }
  </style>

  <!-- Script para notificação -->
  <script>
    $(document).ready(function() {
        @if(session('success'))
            // Exibe a notificação com animação
            $('#toast').fadeIn(500); // Exibe com animação suave

            // Oculta a notificação após 5 segundos
            setTimeout(function() {
                $('#toast').fadeOut(500); // Oculta com animação suave
            }, 5000);  // 5000 milissegundos = 5 segundos
        @endif
    });
  </script>

  <!-- Services Section -->
  <section class="services-section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
          <h2 class="mb-4">Nossos Serviços</h2>
          <p>Oferecemos uma ampla gama de serviços para o seu carro. Escolha o que você precisa e agende online.</p>
        </div>
      </div>
      <div class="row">
        <!-- Serviço 1 -->
        <div class="col-md-4 mb-4">
          <div class="service-item bg-light p-4 text-center">
            <h3 class="mb-3">Troca de Pneus</h3>
            <p>Garanta a segurança do seu carro com a troca de pneus de alta qualidade.</p>
            <a href="{{ route('service.store') }}" class="btn btn-primary">Agendar</a>
          </div>
        </div>
        <!-- Serviço 2 -->
        <div class="col-md-4 mb-4">
          <div class="service-item bg-light p-4 text-center">
            <h3 class="mb-3">Troca de Óleo</h3>
            <p>Mantenha seu motor em perfeitas condições com uma troca de óleo profissional.</p>
            <a href="{{ route('service.store') }}" class="btn btn-primary">Agendar</a>
          </div>
        </div>
        <!-- Serviço 3 -->
        <div class="col-md-4 mb-4">
          <div class="service-item bg-light p-4 text-center">
            <h3 class="mb-3">Revisão Completa</h3>
            <p>Revise todos os sistemas do seu carro para garantir o máximo de desempenho.</p>
            <a href="{{ route('service.store') }}" class="btn btn-primary">Agendar</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Agendamento de Serviço -->
  <section class="schedule-section py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Agendar Serviço</h2>
      <form action="{{ route('service.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="service">Escolha o Serviço</label>
          <select name="service" id="service" class="form-control" required>
            <option value="pneus">Troca de Pneus</option>
            <option value="oleo">Troca de Óleo</option>
            <option value="revisao">Revisão Completa</option>
          </select>
        </div>
        <div class="form-group">
          <label for="car_model">Modelo do Carro</label>
          <input type="text" class="form-control" id="car_model" name="car_model" placeholder="Informe o modelo do seu carro" required>
        </div>
        <div class="form-group">
          <label for="dealership">Concessionária</label>
          <select name="dealership" id="dealership" class="form-control" required>
            <option value="setubal">Setúbal</option>
            <option value="porto">Porto</option>
          </select>
        </div>
        <div class="form-group">
          <label for="delivery_date">Data de Entrega</label>
          <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
        </div>
        <div class="form-group">
          <label for="pickup_date">Data de Recolha</label>
          <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Confirmar Agendamento</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
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
        <div class="col-md">
          <div class="ftco-footer-widget mb-4 ml-md-5">
            <h2 class="ftco-heading-2">Information</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">About</a></li>
              <li><a href="#" class="py-2 d-block">Services</a></li>
              <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
              <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
              <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Drive&Ride</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('assets/js/aos.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/scrollax.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>
