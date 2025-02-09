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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <style>
     /* Estilo das imagens e do layout de serviços */
.services-section .service-item {
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* Garante que a imagem se ajusta dentro do container */
    transition: transform 0.3s ease-in-out;
}

.services-section .service-item:hover {
    transform: translateY(-10px); /* Efeito de elevação ao passar o mouse */
}

.service-image {
    height: 200px; /* Define uma altura fixa para todas as imagens */
    overflow: hidden;
    border-radius: 10px;
    margin-bottom: 20px;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Assegura que a imagem preenche todo o container sem distorcer */
}

.services-section h2 {
    font-size: 2.5rem;
    color: #333;
    font-weight: bold;
}

.services-section p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 40px;
}

.services-section .btn {
    font-size: 1rem;
    padding: 10px 20px;
    text-transform: uppercase;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.services-section .btn:hover {
    background-color: #0056b3;
}

    /* Estilo para os formulários */
    .agendamento-form {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #f9f9f9;
      margin-bottom: 30px;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
    }

    .agendamento-form h3 {
      font-size: 1.6rem;
      margin-bottom: 20px;
      width: 100%;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group button {
      margin-top: 10px;
    }

    .form-content {
      flex: 1;
    }

    /* Estilo para os botões */
    .btn-primary, .btn-secondary {
      margin-right: 10px;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }

    .btn-primary:hover, .btn-secondary:hover {
      opacity: 0.9;
    }

    /* Responsividade */
    @media (max-width: 768px) {
      .agendamento-form {
        flex-direction: column;
        align-items: center;
      }

      .form-image {
        padding-left: 0;
        flex: 0 0 100%; /* A imagem fica abaixo do formulário em telas pequenas */
        margin-top: 20px;
      }
    }
  </style>
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
                <li class="nav-item"><a href="{{ url('/#aboutus') }}" class="nav-link">Sobre</a></li>
                <li class="nav-item"><a href="{{ route('service.index') }}" class="nav-link">Serviços</a></li>

                <li class="nav-item">
                  <a href="{{ route('cars.public.cars') }}" class="nav-link">Carros</a>
                </li>

              <li class="nav-item"><a href="{{ url('/#concessionarias') }}" class="nav-link">Concessionárias</a></li>
                <li class="nav-item"><a href="{{ url('/#contactos') }}" class="nav-link">Contactos</a></li>

                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a href="{{ url('/login') }}" class="nav-link">Login</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-inline mr-2">{{ Auth::user()->name }}</span>
                                <i class="fas fa-user-circle fa-lg text-primary"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow-lg border-0 rounded-lg p-2 animate__animated animate__fadeIn" aria-labelledby="navbarDropdown">
                                <!-- Link de Dashboard para administradores -->
                                @if(Auth::user()->role == 'admin')  
                                    <a class="dropdown-item d-flex align-items-center text-dark font-weight-bold" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt mr-2"></i> {{ __('Dashboard') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                @endif

                                <!-- Link para editar o perfil -->
                                <a class="dropdown-item d-flex align-items-center text-dark" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-edit mr-2"></i> {{ __('Perfil') }}
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- Link de Logout -->
                                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center text-danger w-100 border-0 bg-transparent focus-none">
                                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Sair') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
                <style>
                .focus-none:focus {
                    outline: none !important;
                    box-shadow: none !important;
                }
                </style>
            </ul>

            </ul>
        </div>
    </div>
</nav>


  <!-- Hero Section -->
  <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/images/bg_porshe.jpg');" data-stellar-background-ratio="0.5">
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
    background-color: #4CAF50;
    color: white;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    font-size: 16px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.5s ease, transform 0.5s ease, visibility 0.5s ease;
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Exibir a notificação */
.toast.show {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%) translateY(0);
}

    .toast.success {
        background-color: #4CAF50; /* Verde */
    }

    .toast.error {
        background-color: #FF5733; /* Vermelho */
    }

    .toast-body {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .toast i {
        margin-right: 15px;
        font-size: 24px;
    }

    .toast span {
        font-weight: 600;
        font-size: 16px;
    }

    .toast i.icon-check {
        color: #fff;
    }

    .toast i.icon-error {
        color: #fff;
        font-size: 22px;
    }

    .toast .close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        margin-left: 15px;
    }

    /* Animação de desaparecimento */
    @keyframes slideDown {
        0% {
            transform: translateY(-100px);
        }
        100% {
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-100px);
        }
    }

/* Ocultar com animação */
.toast.hide {
    opacity: 0;
    visibility: hidden;
    transform: translateX(-50%) translateY(-20px); /* Desce um pouco antes de desaparecer */
}


    .service-item {
  background: #f9fafb; /* Fundo pastel */
  border: 1px solid #e5e7eb; /* Borda discreta */
  border-radius: 0.5rem; /* Bordas arredondadas */
  transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sombra inicial */
}

.service-item:hover {
  transform: translateY(-10px); /* Elevação maior no hover */
  box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3); /* Sombra mais intensa */
  background: #ede9fe; /* Fundo com destaque maior (tom lavanda) */
}

.service-image img {
  border-radius: 0.25rem;
  transition: transform 0.3s ease;
}

.service-image img:hover {
  transform: scale(1.05); /* Ampliação sutil da imagem no hover */
}


</style>

  <!-- Script para notificação -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        var toast = document.getElementById("toast");

        if (toast) {
            // Exibe a notificação
            toast.classList.add("show");

            // Aguarda 3 segundos e inicia a remoção
            setTimeout(function () {
                toast.classList.add("hide"); // Aplica animação de saída
                
                // Após 0.5s (tempo da animação), remove do DOM
                setTimeout(function () {
                    toast.remove();
                }, 500);
            }, 3000); // Exibe por 3 segundos antes de ocultar
        }
    });
</script>



<!-- Seção de Serviços -->
<section id="servicos" class="services-section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <h2 class="mb-4">Nossos Serviços</h2>
        <p>Oferecemos uma ampla gama de serviços para o seu carro. Escolha o que você precisa e agende online.</p>
      </div>
    </div>

    <!-- Carrossel -->
    <div id="servicesCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <!-- Primeira linha de serviços -->
        <div class="carousel-item active">
          <div class="row">
            <!-- Serviço 1 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/troca_pneus.jpg" alt="Troca de Pneus" class="img-fluid">
                </div>
                <h3 class="mb-3">Troca de Pneus</h3>
                <p>Garanta a segurança do seu carro com a troca de pneus de alta qualidade.</p>
               <a href="#form1"><button class="btn btn-secondary" onclick="showForm('form1')">Agendar</button></a> 
              </div>
            </div>
            <!-- Serviço 2 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/troca_oleo.jpg" alt="Troca de Óleo" class="img-fluid">
                </div>
                <h3 class="mb-3">Troca de Óleo</h3>
                <p>Mantenha seu motor em perfeitas condições com uma troca de óleo profissional.</p>
                <a href="#form2"><button class="btn btn-secondary" onclick="showForm('form2')">Agendar</button></a>
              </div>
            </div>
            <!-- Serviço 3 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/revisao_carro.jpg" alt="Revisão Completa" class="img-fluid">
                </div>
                <h3 class="mb-3">Revisão Completa</h3>
                <p>Revise todos os sistemas do seu carro para garantir o máximo de desempenho.</p>
                <a href="#form3"><button class="btn btn-secondary" onclick="showForm('form3')">Agendar</button></a>
              </div>
            </div>
          </div>
        </div>
        <!-- Segunda linha de serviços -->
        <div class="carousel-item">
          <div class="row">
            <!-- Serviço 4 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/lavagem_carros.jpg" alt="Lavagem Detalhada" class="img-fluid">
                </div>
                <h3 class="mb-3">Lavagem Detalhada</h3>
                <p>Deixe seu carro limpo e impecável com nossa lavagem detalhada, cuidando de cada detalhe.</p>
                <a href="#form4"><button class="btn btn-secondary" onclick="showForm('form4')">Agendar</button></a>
              </div>
            </div>
            <!-- Serviço 5 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/polimento_carro.jpg" alt="Polimento" class="img-fluid">
                </div>
                <h3 class="mb-3">Polimento</h3>
                <p>Renove a pintura do seu carro com nosso polimento, deixando-a brilhante e sem riscos.</p>
                <a href="#form5"><button class="btn btn-secondary" onclick="showForm('form5')">Agendar</button></a>
              </div>
            </div>
            <!-- Serviço 6 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/pintura_carro.jpg" alt="Pintura" class="img-fluid">
                </div>
                <h3 class="mb-3">Pintura</h3>
                <p>Obtenha uma nova pintura no seu carro ou recupere a aparência do seu carro com nosso retoque de pintura.</p>
                <a href="#form6"><button class="btn btn-secondary" onclick="showForm('form6')">Agendar</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Controles do Carrossel -->
      <a class="carousel-control-prev" href="#servicesCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#servicesCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</section>


<div id="formularios" class="container mt-5">
  <!-- Formulário 1 - Troca de Pneus -->
  <div id="form1" class="agendamento-form" style="display:none;">
    <div class="form-content">
      <!-- Aviso de erro se o usuário não estiver logado -->
      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <h3>Agendar Troca de Pneus</h3>
      <form action="{{ route('service.store') }}" method="POST">
        @csrf
        @if(!Auth::check())
        <div class="alert alert-warning">
          Para solicitar um serviço, precisas estar logado. <a href="{{ route('login') }}">Clique aqui para fazer login.</a>
        </div>
        @endif

        <div class="form-group">
          <label for="car_model1">Modelo do Carro</label>
          <input type="text" class="form-control" id="car_model1" name="car_model" placeholder="Informe o modelo do seu carro" required>
        </div>
        <div class="form-group">
          <label for="car_year1">Ano do Modelo</label>
          <select class="form-control form-control-sm" id="car_year1" name="car_year" required>
            @for ($year = 1990; $year <= 2025; $year++)
              <option value="{{ $year }}">{{ $year }}</option>
            @endfor
          </select>
        </div>
        <div class="form-group">
          <label for="delivery_date1">Data de Entrega do Veículo</label>
          <input type="date" class="form-control" id="delivery_date1" name="delivery_date" required onchange="calculatePickupDate('delivery_date1', 'pickup_date1')">
        </div>
        <div class="form-group">
          <label for="pickup_date1">Data de Retirada do Veículo</label>
          <input type="date" class="form-control" id="pickup_date1" name="pickup_date" readonly>
        </div>
        <div class="form-group">
          <label for="dealership1">Concessionária</label>
          <select class="form-control" id="dealership1" name="dealership" required>
            <option value="setubal">Setúbal</option>
            <option value="porto">Porto</option>
          </select>
        </div>
        <div class="form-group">
          <input type="hidden" name="service" value="troca_de_pneus">
          <button type="submit" class="btn btn-secondary">Enviar Solicitação de Serviço</button>
          <a href="#servicos"><button type="button" class="btn btn-secondary" onclick="hideForm('form1')">Recolher Formulário</button></a>
        </div>
      </form>
    </div>
  </div>

  <!-- Formulário 2 - Troca de Óleo -->
  <div id="form2" class="agendamento-form" style="display:none;">
    <div class="form-content">
      <!-- Aviso de erro se o usuário não estiver logado -->
      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <h3>Agendar Troca de Óleo</h3>
      <form action="{{ route('service.store') }}" method="POST">
        @csrf
        @if(!Auth::check())
        <div class="alert alert-warning">
          Para solicitar um serviço, precisas estar logado. <a href="{{ route('login') }}">Clique aqui para fazer login.</a>
        </div>
        @endif

        <div class="form-group">
          <label for="car_model2">Modelo do Carro</label>
          <input type="text" class="form-control" id="car_model2" name="car_model" placeholder="Informe o modelo do seu carro" required>
        </div>
        <div class="form-group">
          <label for="car_year2">Ano do Modelo</label>
          <select class="form-control form-control-sm" id="car_year2" name="car_year" required>
            @for ($year = 1990; $year <= 2025; $year++)
              <option value="{{ $year }}">{{ $year }}</option>
            @endfor
          </select>
        </div>
        <div class="form-group">
          <label for="delivery_date2">Data de Entrega do Veículo</label>
          <input type="date" class="form-control" id="delivery_date2" name="delivery_date" required onchange="calculatePickupDate('delivery_date2', 'pickup_date2')">
        </div>
        <div class="form-group">
          <label for="pickup_date2">Data de Retirada do Veículo</label>
          <input type="date" class="form-control" id="pickup_date2" name="pickup_date" readonly>
        </div>
        <div class="form-group">
          <label for="dealership2">Concessionária</label>
          <select class="form-control" id="dealership2" name="dealership" required>
            <option value="setubal">Setúbal</option>
            <option value="porto">Porto</option>
          </select>
        </div>
        <div class="form-group">
          <input type="hidden" name="service" value="troca_de_oleo">
          <button type="submit" class="btn btn-secondary">Enviar Solicitação de Serviço</button>
          <a href="#servicos"><button type="button" class="btn btn-secondary" onclick="hideForm('form2')">Recolher Formulário</button></a>
        </div>
      </form>
    </div>
  </div>

  <!-- Formulário 3 - Revisão Completa -->
  <div id="form3" class="agendamento-form" style="display:none;">
    <div class="form-content">
      <!-- Aviso de erro se o usuário não estiver logado -->
      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <h3>Agendar Revisão Completa</h3>
      <form action="{{ route('service.store') }}" method="POST">
        @csrf
        @if(!Auth::check())
        <div class="alert alert-warning">
          Para solicitar um serviço, precisas estar logado. <a href="{{ route('login') }}">Clique aqui para fazer login.</a>
        </div>
        @endif

        <div class="form-group">
          <label for="car_model3">Modelo do Carro</label>
          <input type="text" class="form-control" id="car_model3" name="car_model" placeholder="Informe o modelo do seu carro" required>
        </div>
        <div class="form-group">
          <label for="car_year3">Ano do Modelo</label>
          <select class="form-control form-control-sm" id="car_year3" name="car_year" required>
            @for ($year = 1990; $year <= 2025; $year++)
              <option value="{{ $year }}">{{ $year }}</option>
            @endfor
          </select>
        </div>
        <div class="form-group">
          <label for="delivery_date3">Data de Entrega do Veículo</label>
          <input type="date" class="form-control" id="delivery_date3" name="delivery_date" required onchange="calculatePickupDate('delivery_date3', 'pickup_date3')">
        </div>
        <div class="form-group">
          <label for="pickup_date3">Data de Retirada do Veículo</label>
          <input type="date" class="form-control" id="pickup_date3" name="pickup_date" readonly>
        </div>
        <div class="form-group">
          <label for="dealership3">Concessionária</label>
          <select class="form-control" id="dealership3" name="dealership" required>
            <option value="setubal">Setúbal</option>
            <option value="porto">Porto</option>
          </select>
        </div>
        <div class="form-group">
          <input type="hidden" name="service" value="revisao_completa">
          <button type="submit" class="btn btn-secondary">Enviar Solicitação de Serviço</button>
          <a href="#servicos"><button type="button" class="btn btn-secondary" onclick="hideForm('form3')">Recolher Formulário</button></a>
        </div>
      </form>
    </div>
  </div>

  <!-- Formulário 4 - Lavagem Detalhada -->
<div id="form4" class="agendamento-form" style="display:none;">
  <div class="form-content">
    <!-- Aviso de erro se o usuário não estiver logado -->
    @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <h3>Agendar Lavagem Detalhada</h3>
    <form action="{{ route('service.store') }}" method="POST">
      @csrf
      @if(!Auth::check())
      <div class="alert alert-warning">
        Para solicitar um serviço, precisas estar logado. <a href="{{ route('login') }}">Clique aqui para fazer login.</a>
      </div>
      @endif

      <div class="form-group">
        <label for="car_model4">Modelo do Carro</label>
        <input type="text" class="form-control" id="car_model4" name="car_model" placeholder="Informe o modelo do seu carro" required>
      </div>
      <div class="form-group">
        <label for="car_year4">Ano do Modelo</label>
        <select class="form-control form-control-sm" id="car_year4" name="car_year" required>
          @for ($year = 1990; $year <= 2025; $year++)
            <option value="{{ $year }}">{{ $year }}</option>
          @endfor
        </select>
      </div>
      <div class="form-group">
        <label for="delivery_date4">Data de Entrega do Veículo</label>
        <input type="date" class="form-control" id="delivery_date4" name="delivery_date" required onchange="calculatePickupDate('delivery_date4', 'pickup_date4')">
      </div>
      <div class="form-group">
        <label for="pickup_date4">Data de Retirada do Veículo</label>
        <input type="date" class="form-control" id="pickup_date4" name="pickup_date" readonly>
      </div>
      <div class="form-group">
        <label for="dealership4">Concessionária</label>
        <select class="form-control" id="dealership4" name="dealership" required>
          <option value="setubal">Setúbal</option>
          <option value="porto">Porto</option>
        </select>
      </div>
      <div class="form-group">
        <input type="hidden" name="service" value="lavagem_detalhada">
        <button type="submit" class="btn btn-secondary">Enviar Solicitação de Serviço</button>
        <a href="#servicos"><button type="button" class="btn btn-secondary" onclick="hideForm('form4')">Recolher Formulário</button></a>
      </div>
    </form>
  </div>
</div>

<!-- Formulário 5 - Polimento -->
<div id="form5" class="agendamento-form" style="display:none;">
  <div class="form-content">
    <!-- Aviso de erro se o usuário não estiver logado -->
    @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <h3>Agendar Polimento</h3>
    <form action="{{ route('service.store') }}" method="POST">
      @csrf
      @if(!Auth::check())
      <div class="alert alert-warning">
        Para solicitar um serviço, precisas estar logado. <a href="{{ route('login') }}">Clique aqui para fazer login.</a>
      </div>
      @endif

      <div class="form-group">
        <label for="car_model5">Modelo do Carro</label>
        <input type="text" class="form-control" id="car_model5" name="car_model" placeholder="Informe o modelo do seu carro" required>
      </div>
      <div class="form-group">
        <label for="car_year5">Ano do Modelo</label>
        <select class="form-control form-control-sm" id="car_year5" name="car_year" required>
          @for ($year = 1990; $year <= 2025; $year++)
            <option value="{{ $year }}">{{ $year }}</option>
          @endfor
        </select>
      </div>
      <div class="form-group">
        <label for="delivery_date5">Data de Entrega do Veículo</label>
        <input type="date" class="form-control" id="delivery_date5" name="delivery_date" required onchange="calculatePickupDate('delivery_date5', 'pickup_date5')">
      </div>
      <div class="form-group">
        <label for="pickup_date5">Data de Retirada do Veículo</label>
        <input type="date" class="form-control" id="pickup_date5" name="pickup_date" readonly>
      </div>
      <div class="form-group">
        <label for="dealership5">Concessionária</label>
        <select class="form-control" id="dealership5" name="dealership" required>
          <option value="setubal">Setúbal</option>
          <option value="porto">Porto</option>
        </select>
      </div>
      <div class="form-group">
        <input type="hidden" name="service" value="polimento">
        <button type="submit" class="btn btn-secondary">Enviar Solicitação de Serviço</button>
        <a href="#servicos"><button type="button" class="btn btn-secondary" onclick="hideForm('form5')">Recolher Formulário</button></a>
      </div>
    </form>
  </div>
</div>

<!-- Formulário 6 - Pintura -->
<div id="form6" class="agendamento-form" style="display:none;">
  <div class="form-content">
    <!-- Aviso de erro se o usuário não estiver logado -->
    @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <h3>Agendar Pintura</h3>
    <form action="{{ route('service.store') }}" method="POST">
      @csrf
      @if(!Auth::check())
      <div class="alert alert-warning">
        Para solicitar um serviço, precisas estar logado. <a href="{{ route('login') }}">Clique aqui para fazer login.</a>
      </div>
      @endif

      <div class="form-group">
        <label for="car_model6">Modelo do Carro</label>
        <input type="text" class="form-control" id="car_model6" name="car_model" placeholder="Informe o modelo do seu carro" required>
      </div>
      <div class="form-group">
        <label for="car_year6">Ano do Modelo</label>
        <select class="form-control form-control-sm" id="car_year6" name="car_year" required>
          @for ($year = 1990; $year <= 2025; $year++)
            <option value="{{ $year }}">{{ $year }}</option>
          @endfor
        </select>
      </div>
      <div class="form-group">
        <label for="delivery_date6">Data de Entrega do Veículo</label>
        <input type="date" class="form-control" id="delivery_date6" name="delivery_date" required onchange="calculatePickupDate('delivery_date6', 'pickup_date6')">
      </div>
      <div class="form-group">
        <label for="pickup_date6">Data de Retirada do Veículo</label>
        <input type="date" class="form-control" id="pickup_date6" name="pickup_date" readonly>
      </div>
      <div class="form-group">
        <label for="dealership6">Concessionária</label>
        <select class="form-control" id="dealership6" name="dealership" required>
          <option value="setubal">Setúbal</option>
          <option value="porto">Porto</option>
        </select>
      </div>
      <div class="form-group">
        <input type="hidden" name="service" value="pintura">
        <button type="submit" class="btn btn-secondary">Enviar Solicitação de Serviço</button>
        <a href="#servicos"><button type="button" class="btn btn-secondary" onclick="hideForm('form6')">Recolher Formulário</button></a>
      </div>
    </form>
  </div>
</div>
</div>

<!-- Seção de Preçário -->
<section class="pricing-section py-5">
  <div class="container">
    <div class="row justify-content-center text-center mb-4">
      <div class="col-md-8">
        <h2 class="mb-4">Preços dos Nossos Serviços</h2>
        <p class="lead">Confira os preços dos nossos serviços, divididos por tipo de veículo e requisitos adicionais. Garantimos a melhor qualidade e preço justo.</p>
      </div>
    </div>

    <!-- Tabela de Preços -->
    <div class="row">
      <!-- Serviço 1: Troca de Pneus -->
      <div class="col-md-4 mb-4">
        <div class="pricing-card shadow-sm rounded p-4">
          <div class="icon mb-3">
          <i class="fas fa-circle-notch fa-3x text-primary"></i>
          </div>
          <h3 class="mb-3">Troca de Pneus</h3>
          <p>A troca de pneus inclui a instalação e balanceamento de pneus novos. Preço baseado no tipo de pneu e modelo do carro.</p>
          <ul class="list-unstyled">
            <li><strong>Pneus convencionais:</strong> € 30,00</li>
            <li><strong>Pneus esportivos:</strong> € 50,00</li>
            <li><strong>Modelos de luxo:</strong> € 70,00</li>
            <li><strong>Deslocamento adicional:</strong> € 10,00</li>
          </ul>
          <a href="#formularios"><button class="btn btn-secondary w-100" onclick="showForm('form1')">Agendar</button></a>
        </div>
      </div>

      <!-- Serviço 2: Troca de Óleo -->
      <div class="col-md-4 mb-4">
        <div class="pricing-card shadow-sm rounded p-4">
          <div class="icon mb-3">
            <i class="fas fa-oil-can fa-3x text-primary"></i>
          </div>
          <h3 class="mb-3">Troca de Óleo</h3>
          <p>Inclui a remoção do óleo antigo e substituição por óleo de alta qualidade. O preço varia conforme o tipo de óleo e o modelo do veículo.</p>
          <ul class="list-unstyled">
            <li><strong>Óleo convencional:</strong> € 20,00</li>
            <li><strong>Óleo sintético:</strong> € 35,00</li>
            <li><strong>Óleo para carros esportivos:</strong> € 50,00</li>
          </ul>
          <a href="#formularios"><button class="btn btn-secondary w-100" onclick="showForm('form2')">Agendar</button></a>
        </div>
      </div>

      <!-- Serviço 3: Revisão Completa -->
      <div class="col-md-4 mb-4">
        <div class="pricing-card shadow-sm rounded p-4">
          <div class="icon mb-3">
            <i class="fas fa-cogs fa-3x text-primary"></i>
          </div>
          <h3 class="mb-3">Revisão Completa</h3>
          <p>Inspeção detalhada de todos os sistemas do carro, garantindo o máximo desempenho. O preço depende do ano e modelo do carro.</p>
          <ul class="list-unstyled">
            <li><strong>Carros de até 5 anos:</strong> € 60,00</li>
            <li><strong>Carros de 6 a 10 anos:</strong> € 80,00</li>
            <li><strong>Carros acima de 10 anos:</strong> € 100,00</li>
            <li><strong>Carros de luxo ou importados:</strong> € 120,00</li>
          </ul>
          <a href="#formularios"><button class="btn btn-secondary w-100" onclick="showForm('form3')">Agendar</button></a>
        </div>
      </div>
    </div>

    <!-- Segunda linha de preços -->
    <div class="row">
      <!-- Serviço 4: Lavagem Detalhada -->
      <div class="col-md-4 mb-4">
        <div class="pricing-card shadow-sm rounded p-4">
          <div class="icon mb-3">
          <i class="fas fa-tint fa-2x text-primary" style="color: purple;"></i>

          </div>
          <h3 class="mb-3">Lavagem Detalhada</h3>
          <p>Limpeza completa do carro, com foco em todos os detalhes, tanto no exterior quanto no interior.</p>
          <ul class="list-unstyled">
            <li><strong>Lavagem simples:</strong> € 15,00</li>
            <li><strong>Lavagem com polimento:</strong> € 30,00</li>
            <li><strong>Lavagem de veículos grandes:</strong> € 40,00</li>
          </ul>
          <a href="#formularios"><button class="btn btn-secondary w-100" onclick="showForm('form4')">Agendar</button></a>
        </div>
      </div>

      <!-- Serviço 5: Polimento -->
      <div class="col-md-4 mb-4">
        <div class="pricing-card shadow-sm rounded p-4">
          <div class="icon mb-3">
            <i class="fas fa-spray-can fa-3x text-primary"></i>
          </div>
          <h3 class="mb-3">Polimento</h3>
          <p>Renove a pintura do seu carro, eliminando riscos e dando brilho à superfície.</p>
          <ul class="list-unstyled">
            <li><strong>Polimento simples:</strong> € 25,00</li>
            <li><strong>Polimento com cera:</strong> € 40,00</li>
            <li><strong>Polimento profundo:</strong> € 55,00</li>
          </ul>
          <a href="#formularios"><button class="btn btn-secondary w-100" onclick="showForm('form5')">Agendar</button></a>
        </div>
      </div>

      <!-- Serviço 6: Pintura -->
      <div class="col-md-4 mb-4">
        <div class="pricing-card shadow-sm rounded p-4">
          <div class="icon mb-3">
            <i class="fas fa-paint-roller fa-3x text-primary"></i>
          </div>
          <h3 class="mb-3">Pintura</h3>
          <p>Obtenha uma nova pintura ou retoque para restaurar a aparência do seu carro.</p>
          <ul class="list-unstyled">
            <li><strong>Retoque de pintura:</strong> € 50,00</li>
            <li><strong>Pintura completa:</strong> € 180,00</li>
            <li><strong>Pintura para carros de luxo:</strong> € 400,00</li>
          </ul>
          <a href="#formularios"><button class="btn btn-secondary w-100" onclick="showForm('form6')">Agendar</button></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Estilos Customizados -->
<style>
  .pricing-section {
    background-color: #f8f9fa;
  }
  .pricing-card {
    background-color: white;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%; /* Garante que todos os cartões tenham a mesma altura */
  }
  .pricing-card:hover {
    transform: translateY(-10px);
  }
  .pricing-card h3 {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 10px;
  }
  .pricing-card p {
    font-size: 1rem;
    color: #555;
    flex-grow: 1; /* Faz o texto ocupar o espaço necessário */
  }
  .icon {
    color: #007bff;
    margin-bottom: 10px;
  }
  .pricing-card ul {
    margin-top: 10px;
    padding-left: 0;
    list-style-type: none;
  }
  .pricing-card ul li {
    font-size: 1rem;
    color: #333;
    margin-bottom: 5px;
  }
  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    margin-top: auto; /* Garante que o botão fique na parte inferior */
  }
  .pricing-card button {
    margin-top: 20px;
  }
  .row > .col-md-4 {
    display: flex;
  }
</style>


<script>
  // Função para calcular a data de retirada (7 dias após a data de entrega)
  function calculatePickupDate(deliveryDateId, pickupDateId) {
    var deliveryDate = document.getElementById(deliveryDateId).value;
    
    if (deliveryDate) {
      var delivery = new Date(deliveryDate);
      delivery.setDate(delivery.getDate() + 7); // Adiciona 7 dias à data de entrega
      
      // Formata a data para o formato YYYY-MM-DD
      var day = ("0" + delivery.getDate()).slice(-2);
      var month = ("0" + (delivery.getMonth() + 1)).slice(-2);
      var year = delivery.getFullYear();
      var pickupDate = year + "-" + month + "-" + day;
      
      document.getElementById(pickupDateId).value = pickupDate;
    }
  }
</script>

<script>
  // JavaScript para concatenar 'car_model' e 'car_year' antes de enviar
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
      var carModel = form.querySelector('[name="car_model"]').value;
      var carYear = form.querySelector('[name="car_year"]').value;
      var fullCarModel = carModel + ' (' + carYear + ')';

      form.querySelector('[name="car_model"]').value = fullCarModel;
    });
  });
</script>

<script>
  // Função para mostrar o formulário de agendamento
  function showForm(formId) {
    var forms = document.querySelectorAll('.agendamento-form');
    forms.forEach(function(form) {
      form.style.display = 'none'; // Esconde todos os formulários
    });
    var form = document.getElementById(formId);
    form.style.display = 'block'; // Mostra o formulário específico
  }

  // Função para esconder o formulário de agendamento
  function hideForm(formId) {
    var form = document.getElementById(formId);
    form.style.display = 'none'; // Esconde o formulário
  }
</script>

<script>
  // Smooth scrolling para âncoras, com exceção dos botões Previous e Next do carrossel
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      // Verifica se o elemento clicado pertence ao carrossel
      const isCarouselControl = this.classList.contains('carousel-control-prev') || this.classList.contains('carousel-control-next');

      if (!isCarouselControl) {
        e.preventDefault(); // Previne o comportamento padrão para âncoras normais

        const targetID = this.getAttribute('href'); // Obtém o ID do destino
        const targetElement = document.querySelector(targetID);

        if (targetElement) {
          // Realiza o scroll suave até o elemento
          window.scrollTo({
            top: targetElement.offsetTop,
            behavior: 'smooth'
          });
        }
      }
    });
  });
</script>


  <!-- Footer -->
  <footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2"><a href="#" class="logo">Drive&<span>Ride</span></a></h2>
            <p>Com concessionárias no Porto e em Setúbal, estamos aqui para oferecer soluções práticas e personalizadas para quem procura experiências automóveis únicos.
            </p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4 ml-md-5">
            <h2 class="ftco-heading-2">Informações</h2>
            <ul class="list-unstyled">
              <li><a href="#aboutus" class="py-2 d-block">Sobre nós</a></li>
              <li><a href="{{ route('service.index') }}" class="py-2 d-block">Serviços</a></li>
              <li><a href="{{ route('terms') }}" class="py-2 d-block">Termos e Condições</a></li>
              <li><a href="#" class="py-2 d-block">Privacidade  &amp; Política de Cookies</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
           <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Customer Support</h2>
            <ul class="list-unstyled">
              <li><a href="#contactos" class="py-2 d-block">Dúvidas?</a></li>
              <li><a href="{{ route('cars.public.cars') }}" class="py-2 d-block">Compra um Carro</a></li>
              <li><a href="#concessionarias" class="py-2 d-block">Visita-nos</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">N 10, Km16 Coina, 2840-074, Paio Pires</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+351913588321</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">driveride@gmail.com</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p><!-- Copyright-->
Copyright &copy;<script>document.write(new Date().getFullYear());</script>
          </p>
        </div>
      </div>
    </div>
  </footer>
<!-- Font Awesome for Icons -->

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
