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

                                <!-- Link para editar o perfil -->
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    {{ __('Perfil') }}
                                </a>

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


    
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/images/bg_rs62.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start">
            <div class="col-md-12 text-center ftco-animate">
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a>
                    </span>
                    <span>Cars <i class="ion-ios-arrow-forward"></i></span>
                </p>
                <h1 class="mb-3 bread text-white">Escolha o Seu Carro</h1>
                
                <!-- Filtro sobre a imagem -->
                <form action="{{ route('cars.public.cars') }}" method="GET" class="row justify-content-center mt-4">
                    <!-- Campo Marca -->
                    <div class="col-md-2 mb-3">
                        <select name="brand" id="brand" class="form-control">
                            <option value="">Marca</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->brand }}" {{ request('brand') == $brand->brand ? 'selected' : '' }}>
                                    {{ $brand->brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>
  
                    <!-- Campo Modelo -->
                    <div class="col-md-2 mb-3">
                        <select name="name" id="model" class="form-control">
                            <option value="">Modelo</option>
                            <!-- Os modelos serão carregados dinamicamente via AJAX -->
                        </select>
                    </div>
  
                    <!-- Campo Preço Mínimo -->
                    <div class="col-md-2 mb-3">
                        <input type="number" name="min_price" class="form-control" placeholder="Preço Mín." value="{{ request('min_price') }}">
                    </div>
  
                    <!-- Campo Preço Máximo -->
                    <div class="col-md-2 mb-3">
                        <input type="number" name="max_price" class="form-control" placeholder="Preço Máx." value="{{ request('max_price') }}">
                    </div>
  
                    <!-- Campo Tipo de Combustível -->
                    <div class="col-md-2 mb-3">
                        <select name="fuel_type" class="form-control">
                            <option value="">Combustível</option>
                            <option value="Gasolina" {{ request('fuel_type') == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                            <option value="Diesel" {{ request('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Elétrico" {{ request('fuel_type') == 'Elétrico' ? 'selected' : '' }}>Elétrico</option>
                            <option value="Híbrido" {{ request('fuel_type') == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                        </select>
                    </div>
  
                    <!-- Botões de Pesquisa e Reset -->
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary filter-btn px-4">Pesquisar</button>
                        <a href="{{ route('cars.public.cars') }}" class="btn btn-secondary filter-btn px-4">Limpar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </section>

  
  <!-- JavaScript para carregar modelos dinamicamente -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      $(document).ready(function () {
          $('#brand').on('change', function () {
              let brand = $(this).val(); // Obtém a marca selecionada
  
              // Limpa os modelos anteriores
              $('#model').html('<option value="">Modelo</option>');
  
              // Faz a requisição AJAX para obter os modelos
              if (brand) {
                  $.ajax({
                      url: "{{ route('cars.models.byBrand') }}", // Rota que aponta para o método getModelsByBrand
                      type: "GET",
                      data: { brand: brand }, // Envia a marca selecionada
                      success: function (response) {
                          // Preenche os modelos no campo de seleção
                          response.forEach(function (model) {
                              $('#model').append(`<option value="${model.name}">${model.name}</option>`);
                          });
                      },
                      error: function () {
                          alert('Erro ao carregar os modelos. Tente novamente.');
                      }
                  });
              }
          });
      });
  </script>
  
  
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousels = document.querySelectorAll('.carousel');
        
        // Função para sincronizar todos os carrosséis
        function syncCarousels(activeIndex) {
            carousels.forEach(carousel => {
                $(carousel).carousel(activeIndex); // Força o carrossel a ir para o índice especificado
            });
        }

        // Função para reiniciar o intervalo de troca automática
        function restartAutoScroll() {
            carousels.forEach(carousel => {
                // Resetando o intervalo de auto-scroll a cada 5 segundos
                $(carousel).carousel('cycle');
            });
        }

        // Adiciona o evento 'slid.bs.carousel' para cada carrossel
        carousels.forEach(carousel => {
            $(carousel).on('slid.bs.carousel', function (event) {
                const activeIndex = $(event.relatedTarget).index(); // Obtém o índice do slide ativo
                syncCarousels(activeIndex); // Sincroniza todos os carrosséis para o mesmo índice
            });

            // Pausar o carrossel quando o usuário interagir manualmente
            $(carousel).on('slide.bs.carousel', function () {
                $(carousel).carousel('pause'); // Pausa o carrossel
            });
        });

        // Reinicia os carrosséis para o modo automático (se o usuário não interagir)
        setInterval(() => {
            carousels.forEach(carousel => {
                $(carousel).carousel('next'); // Avança o carrossel para o próximo slide
            });
        }, 5000);

        // Reinicia a navegação automática após 5 segundos (após o ciclo)
        setTimeout(restartAutoScroll, 5000);
    });
</script>


<!-- Car listing section starts here -->
<section id="carsection" class="ftco-section ftco-no-pt bg-light">
    <br>
    <div class="container">
        @if($cars->isEmpty())
        <div class="text-center mt-4">
            <h3>Infelizmente, não temos nenhum veículo que corresponda à sua pesquisa.</h3>
            <p>Tente ajustar os filtros ou explore outras opções disponíveis.</p>
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <h2 class="mb-2">Os nossos veículos disponíveis!</h2>
            </div>
        </div>
        @endif
        
        


        <div class="row">
            @foreach($cars as $car)
                <div class="col-md-4 mb-4"> <!-- Cada carro ocupa 1/3 da largura -->
                    <div class="car-wrap rounded ftco-animate">
                        <!-- Carrossel de imagens -->
                        <div id="carousel-{{ $car->id }}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" style="height: 200px; background-size: cover;">
                                @foreach($car->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->path) }}" 
                                             class="d-block w-100" 
                                             alt="Car Image" 
                                             style="height: 200px; object-fit: cover;">
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
                        
                                               

                        <!-- Informações do carro -->
                        <div class="text mt-3">
                            <h2 class="mb-0"><a href="#">{{ $car->name }}</a></h2>
                            <div class="d-flex mb-3">
                                <span class="cat">{{ $car->brand }}</span>
                                <p class="price ml-auto">{{ $car->price }}€</p>
                            </div>
                            <p class="d-flex mb-0 d-block">
                                <a href="#" class="btn btn-primary py-2 mr-1" data-toggle="modal" data-target="#carModal-{{ $car->id }}">Contactar</a>
                                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-secondary py-2 ml-1">Ver</a>
                            </p>
                        </div>
                    </div>
                </div>

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
                <!-- Fim do Modal -->
            @endforeach

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>
</section>



  
<style>
.page-item.active .page-link {
    background-color: #35353B !important;
    border-color: #35353B !important;
    color: white !important; /* Mantém o texto visível no botão ativo */
}

.page-link {
    color: #35353B !important;
}

.page-link:hover {
    background-color: #35353B;
    color: white !important; /* Garante que o texto fique visível ao passar o mouse */
}
</style>

  <!-- Pagination section -->
  <div class="row mt-4">
    <div class="col d-flex justify-content-center">
        {{ $cars->links('pagination::bootstrap-4') }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Seleciona todos os carrosséis pela classe .carousel
        const carousels = document.querySelectorAll('.carousel');

        // Função para trocar todos os carrosséis para o mesmo índice
        function syncCarousels(activeIndex) {
            carousels.forEach(carousel => {
                $(carousel).carousel(activeIndex); // Força o carrossel para o índice especificado
            });
        }

        // Adiciona o evento 'slid.bs.carousel' para monitorar quando um slide é alterado
        carousels.forEach(carousel => {
            $(carousel).on('slid.bs.carousel', function (event) {
                const activeIndex = $(event.relatedTarget).index(); // Obtém o índice do slide ativo
                syncCarousels(activeIndex); // Sincroniza todos os carrosséis para o mesmo índice
            });
        });

        // Sincroniza os carrosséis automaticamente no intervalo de 5 segundos
        setInterval(() => {
            carousels.forEach(carousel => {
                $(carousel).carousel('next'); // Avança para o próximo slide
            });
        }, 5000);
    });
</script>







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
                  <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
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
