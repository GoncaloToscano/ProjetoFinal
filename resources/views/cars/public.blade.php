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
        <a class="navbar-brand" href="#">Drive<span>&Ride</span></a>
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


    
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
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
                              <option value="{{ $brand->brand }}" {{ request('brand') == $brand->brand ? 'selected' : '' }}>{{ $brand->brand }}</option>
                          @endforeach
                      </select>
                  </div>
                  
                  <!-- Campo Modelo -->
                  <div class="col-md-2 mb-3">
                      <select name="name" id="model" class="form-control">
                          <option value="">Modelo</option>
                      </select>
                  </div>

                  <div class="col-md-2 mb-3">
                      <input type="number" name="min_price" class="form-control" placeholder="Preço Mín." value="{{ request('min_price') }}">
                  </div>
                  <div class="col-md-2 mb-3">
                      <input type="number" name="max_price" class="form-control" placeholder="Preço Máx." value="{{ request('max_price') }}">
                  </div>
                  <div class="col-md-2 mb-3">
                      <select name="fuel_type" class="form-control">
                          <option value="">Combustível</option>
                          <option value="Gasolina" {{ request('fuel_type') == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                          <option value="Diesel" {{ request('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                          <option value="Elétrico" {{ request('fuel_type') == 'Elétrico' ? 'selected' : '' }}>Elétrico</option>
                          <option value="Híbrido" {{ request('fuel_type') == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                      </select>
                  </div>
                  <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary filter-btn px-4">Pesquisar</button>
                      <a href="{{ route('cars.public.cars') }}" class="btn btn-secondary filter-btn px-4">Resetar</a>
                  </div>
              </form>
          </div>
      </div>
  </div>
</section>

<script>
  // Função para atualizar os modelos com base na marca selecionada
  document.getElementById('brand').addEventListener('change', function () {
      var brand = this.value;

      // Se não houver marca selecionada, limpar o campo de modelos
      if (brand === '') {
          document.getElementById('model').innerHTML = '<option value="">Modelo</option>';
          return;
      }

      // Fazer uma requisição AJAX para obter os modelos da marca selecionada
      fetch("{{ route('cars.models.byBrand') }}?brand=" + brand)
          .then(response => response.json())
          .then(models => {
              var modelSelect = document.getElementById('model');
              
              // Limpar os modelos existentes
              modelSelect.innerHTML = '<option value="">Modelo</option>';

              // Preencher o select com os modelos retornados
              models.forEach(function(model) {
                  var option = document.createElement('option');
                  option.value = model.name;
                  option.textContent = model.name;
                  modelSelect.appendChild(option);
              });
          });
  });
</script>



<!-- filtrar FIM -->



<!-- Car listing section starts here -->
<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <h2 class="mb-2">Todos os nossos veículos disponíveis!</h2>
            </div>
        </div>
        <div class="row">
            @foreach($cars as $car)
                <div class="col-md-4 mb-4"> <!-- Cada carro ocupa 1/3 da largura -->
                    <div class="car-wrap rounded ftco-animate">
                        <!-- Carrossel de imagens -->
                        <div id="carousel-{{ $car->id }}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" style="height: 200px; background-size: cover;">
                                @foreach($car->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Car Image" style="height: 200px; object-fit: cover;">
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



  

  <!-- Pagination section -->
  <div class="row mt-5">
    <div class="col text-center">
      <div class="block-27">
        <ul>
          <li><a href="#">&lt;</a></li>
          <li class="active"><span>1</span></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">&gt;</a></li>
        </ul>
      </div>
    </div>
  </div>

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
