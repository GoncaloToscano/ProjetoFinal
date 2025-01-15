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
  
.navbar {
  background-color: transparent !important;
  box-shadow: none !important;  /* Se quiser remover qualquer sombra */
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
                    <li class="nav-item">
                      <a href="{{ route('cars.public.cars') }}" class="nav-link">Carros</a>
                    </li>
                    
                    <li class="nav-item"><a href="#" class="nav-link">Test Drive</a></li>

                    <li class="nav-item"><a href="contactos.html" class="nav-link">Contactos</a></li>

    
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
                                    @if(Auth::user()->role == 'admin')  <!-- Verifica a role do utilizador -->
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


    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
          <p class="breadcrumbs">
            <span class="mr-2">
              <a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a>
            </span>
            <span class="mr-2">
              <a href="{{ route('cars.public.cars') }}">Carros <i class="ion-ios-arrow-forward"></i></a>
            </span>
            <span class="mr-2">Detalhes do Veículo <i class="ion-ios-arrow-forward"></i></span>
          </p>
            <h1 class="mb-3 bread">Detalhes do Veículo</h1>
        </div>
      </div>
    </div>
  </section>

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
					  <input type="text" class="form-control" id="name" name="name" required placeholder="Escreva seu nome"
						  value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}">
				  </div>
  
				  <div class="form-group">
					  <label for="email">Seu E-mail</label>
					  <input type="email" class="form-control" id="email" name="email" required placeholder="Escreva seu e-mail"
						  value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}">
				  </div>
  
				  <div class="form-group">
					  <label for="phone">Seu Telefone</label>
					  <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Escreva seu número de telefone"
						  value="{{ old('phone') }}">
				  </div>
  
				  <div class="form-group">
					  <label for="preferred_date">Data Preferencial</label>
					  <input type="date" class="form-control" id="preferred_date" name="preferred_date" required
						  value="{{ old('preferred_date') }}">
				  </div>
  
				  <div class="form-group">
					  <label for="preferred_time">Hora Preferencial</label>
					  <input type="time" class="form-control" id="preferred_time" name="preferred_time" required min="08:00" max="19:00" step="900"
						  value="{{ old('preferred_time') }}">
				  </div>
  
				  <div class="form-group">
					  <label for="observations">Observações</label>
					  <textarea class="form-control" id="observations" name="observations" rows="4" placeholder="Caso tenha alguma observação.">{{ old('observations') }}</textarea>
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
					</div>
				  </div>
				</div>       
			  </div>
			</div>
		  </div>
		</div>
		<br>
	  </div>
	</div>
  </div>
<!-- Test - Drive Fim -->

<!-- Carros Relacionados -->
<section class="ftco-section ftco-no-pt bg-light">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
            <br>
              <span class="subheading">Vê agora</span>
              <h2 class="mb-2">Carros Relacionados</h2>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="carousel-car owl-carousel">
                  @forelse($relatedCars as $relatedCar)
                      <div class="item">
                          <div class="car-wrap rounded ftco-animate">
                              <!-- Imagem do carro -->
                              <div class="img rounded d-flex align-items-end" style="background-image: url({{ asset('storage/'.$relatedCar->images->first()->path) }});">
                              </div>
                              <!-- Informações do carro -->
                              <div class="text">
                                  <h2 class="mb-0"><a href="{{ route('cars.show', $relatedCar->id) }}">{{ $relatedCar->name }}</a></h2>
                                  <div class="d-flex mb-3">
                                      <span class="cat">{{ $relatedCar->brand }}</span>
                                      <p class="price ml-auto">{{ number_format($relatedCar->price, 2, ',', '.') }}€</p>
                                  </div>
                                  <p class="d-flex mb-0 d-block">
                                    <a href="{{ route('cars.show', $relatedCar->id) }}" class="btn btn-secondary py-2 ml-1">Detalhes</a>
                                  </p>
                              </div>
                          </div>
                      </div>
                  @empty
                      <p>Nenhum carro relacionado encontrado, mostrando carros recentes.</p>
                  @endforelse
              </div>
          </div>
      </div>
  </div>
</section>
<!-- Fim Carros Relacionados -->



<!-- Concessionárias -->
<section class="ftco-section testimony-section bg-light" id="concessionarias">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <span class="subheading">Visite-nos</span>
        <h2 class="mb-3">Onde estamos?</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4">
        <h3 class="text-center">Porto</h3>
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d206695.99637812872!2d-8.7310956125!3d40.961916675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDU3JzQyLjkiTiA4wrAzNSc0Mi4wIlc!5e0!3m2!1spt-PT!2spt!4v1700000000000" 
          width="100%" 
          height="300" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>

      <div class="col-md-6 mb-4">
        <h3 class="text-center">Setúbal</h3>
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d408.1657437553885!2d-9.052974231!3d38.597278415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd194936ca2a12b3%3A0xb6d61a200ad7f69f!2sBR%20Autos!5e0!3m2!1spt-PT!2spt!4v1700000000000" 
          width="100%" 
          height="300" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </div>
</section>
<!-- Fim concessionária -->  

  <!--Footer-->
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
