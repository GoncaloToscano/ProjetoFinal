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
        transform: translateX(-50%) translateY(-100px); /* Inicia acima da tela */
        background-color: #4CAF50; /* Cor verde */
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

    .toast.show {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0); /* Desce para a posição final */
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

    .toast.hide {
        animation: slideUp 0.5s ease forwards;
    }

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

<!-- Seção de Serviços -->
<section class="services-section py-5">
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
              <div class="service-item bg-light p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/troca_pneus.jpg" alt="Troca de Pneus" class="img-fluid">
                </div>
                <h3 class="mb-3">Troca de Pneus</h3>
                <p>Garanta a segurança do seu carro com a troca de pneus de alta qualidade.</p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">Agendar</button>
              </div>
            </div>
            <!-- Serviço 2 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item bg-light p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/troca_oleo.jpg" alt="Troca de Óleo" class="img-fluid">
                </div>
                <h3 class="mb-3">Troca de Óleo</h3>
                <p>Mantenha seu motor em perfeitas condições com uma troca de óleo profissional.</p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">Agendar</button>
              </div>
            </div>
            <!-- Serviço 3 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item bg-light p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/revisao_carro.jpg" alt="Revisão Completa" class="img-fluid">
                </div>
                <h3 class="mb-3">Revisão Completa</h3>
                <p>Revise todos os sistemas do seu carro para garantir o máximo de desempenho.</p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">Agendar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Segunda linha de serviços -->
        <div class="carousel-item">
          <div class="row">
            <!-- Serviço 1 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item bg-light p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/lavagem_carros.jpg" alt="Lavagem Detalhada" class="img-fluid">
                </div>
                <h3 class="mb-3">Lavagem Detalhada</h3>
                <p>Deixe seu carro limpo e impecável com nossa lavagem detalhada, cuidando de cada detalhe.</p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">Agendar</button>
              </div>
            </div>
            <!-- Serviço 2 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item bg-light p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/polimento_carro.jpg" alt="Polimento" class="img-fluid">
                </div>
                <h3 class="mb-3">Polimento</h3>
                <p>Renove a pintura do seu carro com nosso polimento, deixando-a brilhante e sem riscos.</p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">Agendar</button>
              </div>
            </div>
            <!-- Serviço 3 -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="service-item bg-light p-4 text-center d-flex flex-column">
                <div class="service-image">
                  <img src="assets/images/pintura_carro.jpg" alt="Pintura" class="img-fluid">
                </div>
                <h3 class="mb-3">Pintura</h3>
                <p>Obtenha uma nova pintura no seu carro ou recupere a aparência do seu carro com nosso retoque de pintura.</p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">Agendar</button>
              </div>
            </div>
          </div>
        </div>   
        
<!-- Terceira linha de serviços -->
<div class="carousel-item">
  <div class="row">
    <!-- Serviço 1 -->
    <div class="col-md-4 mb-4 d-flex">
      <div class="service-item bg-light p-4 text-center d-flex flex-column">
        <div class="service-image">
          <img src="assets/images/lavagem_carros.jpg" alt="Substituição de Bateria" class="img-fluid">
        </div>
        <h3 class="mb-3">Substituição de Bateria</h3>
        <p>Troque sua bateria rapidamente e garanta o funcionamento do seu carro.</p>
        <button class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">Agendar</button>
      </div>
    </div>
    <!-- Serviço 2 -->
    <div class="col-md-4 mb-4 d-flex">
      <div class="service-item bg-light p-4 text-center d-flex flex-column">
        <div class="service-image">
          <img src="assets/images/polimento_carro.jpg" alt="Diagnóstico de Motor" class="img-fluid">
        </div>
        <h3 class="mb-3">Diagnóstico de Motor</h3>
        <p>Verifique a saúde do motor do seu carro com nosso diagnóstico completo.</p>
        <button class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">Agendar</button>
      </div>
    </div>
    <!-- Serviço 3 -->
    <div class="col-md-4 mb-4 d-flex">
      <div class="service-item bg-light p-4 text-center d-flex flex-column">
        <div class="service-image">
          <img src="assets/images/pintura_carro.jpg" alt="Manutenção de Ar Condicionado" class="img-fluid">
        </div>
        <h3 class="mb-3">Manutenção A/C</h3>
        <p>Deixe o ar condicionado do seu carro funcionando perfeitamente.</p>
        <button class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">Agendar</button>
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


<!-- Seção de Solicitação de Outro Serviço -->
<section class="request-service-section py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <h2 class="mb-4">Solicite Outro Serviço</h2>
        <p>Se o serviço que você precisa não está listado acima, preencha o formulário abaixo e nós entraremos em contato com você para agendar o atendimento.</p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="#" method="POST" id="requestServiceForm">
          <div class="form-group">
            <label for="serviceType">Tipo de Serviço</label>
            <input type="text" class="form-control" id="serviceType" name="serviceType" placeholder="Descreva o serviço desejado" required>
          </div>
          <div class="form-group">
            <label for="customerName">Nome</label>
            <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Seu nome completo" required>
          </div>
          <div class="form-group">
            <label for="customerEmail">E-mail</label>
            <input type="email" class="form-control" id="customerEmail" name="customerEmail" placeholder="Seu e-mail" required>
          </div>
          <div class="form-group">
            <label for="customerPhone">Telefone</label>
            <input type="tel" class="form-control" id="customerPhone" name="customerPhone" placeholder="Seu telefone" required>
          </div>
          <button type="submit" class="btn btn-primary">Solicitar Serviço</button>
        </form>
      </div>
    </div>
  </div>
</section>


<!-- Modal para Agendamento de Serviço -->
<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scheduleModalLabel">Agendar Serviço</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
            <label for="delivery_date">Data de Entrega do Veículo</label>
            <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
          </div>
          <div class="form-group">
            <label for="pickup_date">Data Prevista de Recolha</label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" readonly required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar Solicitação de Serviço</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Função para calcular e preencher automaticamente a data de recolha
  document.getElementById('delivery_date').addEventListener('change', function() {
    var deliveryDate = new Date(this.value);  // Obtém a data de entrega selecionada
    if (!isNaN(deliveryDate.getTime())) {  // Verifica se a data de entrega é válida
      deliveryDate.setDate(deliveryDate.getDate() + 7);  // Adiciona 7 dias à data de entrega
      var pickupDate = deliveryDate.toISOString().split('T')[0];  // Formata a data de recolha no formato yyyy-mm-dd
      document.getElementById('pickup_date').value = pickupDate;  // Preenche o campo de data de recolha
    }
  });
</script>



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
