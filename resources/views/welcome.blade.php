<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Car</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
<link href="{{ asset('assets/css/font.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap') }}" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
                    <li class="nav-item"><a href="#aboutus" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#services" class="nav-link">Services</a></li>

                    <li class="nav-item">
                      <a href="{{ route('cars.public.cars') }}" class="nav-link">Carros</a>
                    </li>

                  <li class="nav-item"><a href="#concessionarias" class="nav-link">Concessionárias</a></li>
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
    
    
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('assets/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
          <div class="col-lg-8 ftco-animate">
          	<div class="text w-100 text-center mb-md-5 pb-md-5">
	            <h1 class="mb-4">Bem vindos ao nosso stand automóvel!</h1>
	            <p style="font-size: 18px;">O carro dos seus sonhos encontra-se aqui...</p>
              <p style="font-size: 18px;">Desde a manutenção até aos test drives com duas concessionárias prontas a realizar o seu sonho.</p>

                <a href="{{ route('cars.public.cars') }}" class="icon-wrap d-flex align-items-center mt-4 justify-content-center">
                  <div class="icon d-flex align-items-center justify-content-center">
                      <span class="ion-ios-car"></span>
                  </div>
                  <div class="heading-title ml-5">
                      <span>Conheça os nossos carros</span>
                  </div>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>



<!-- Test Drive -->
     <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row no-gutters">
    			<div class="col-md-12	featured-top">
    				<div class="row no-gutters">
	  					<div class="col-md-4 d-flex align-items-center">
	  						<form action="#" class="request-form ftco-animate bg-primary">
		          		<h2>Agendar Serviço</h2>
			    				<div class="form-group">
			    					<label for="" class="label">Carro</label>
			    					<input type="text" class="form-control" placeholder="Escolhe o modelo do teu carro...">
			    				</div>
			    				<div class="form-group">
			    					<label for="" class="label">Concessionária</label>
			    					<input type="text" class="form-control" placeholder="Escolhe a concessionária mais perto de ti">
			    				</div>
			    				<div class="d-flex">
			    					<div class="form-group mr-2">
			                <label for="" class="label">Data Entrega</label>
			                <input type="text" class="form-control" id="book_pick_date" placeholder="Date">
			              </div>
                    <div class="form-group mr-2">
			                <label for="" class="label">Data-Recolha</label>
			                <input type="text" class="form-control" id="book_pick_date" placeholder="...">
			              </div>
		              </div>
		              <div class="form-group">
		                <label for="" class="label">Serviço</label>
		                <input type="text" class="form-control" id="servico" placeholder="Escolha o serviço desejado..">
		              </div>
			            <div class="form-group">
			              <input type="submit" value="Agendar Serviço" class="btn btn-secondary py-3 px-4">
			            </div>
			    			</form>
	  					</div>
	  					<div class="col-md-8 d-flex align-items-center">
	  						<div class="services-wrap rounded-right w-100">
	  							<h3 class="heading-section mb-4">Aluga um carro conosco!</h3>
	  							<div class="row d-flex mb-4">
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Escolhe a localização de recolha do veículo</h3>
				                </div>
					            </div>      
					          </div>
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Escolhe o melhor negócio</h3>
					              </div>
					            </div>      
					          </div>
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Reserva o teu carro</h3>
					              </div>
					            </div>      
					          </div>
					        </div>
					        <p><a href="#" class="btn btn-primary py-3 px-4">Aluga conosco!</a></p>
	  						</div>
	  					</div>
	  				</div>
				</div>
  		</div>
    </section>
<!-- Fim do TestDrive-->



<!--Recenetemente adicionados 4 -->
<section class="ftco-section ftco-no-pt bg-light">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
              <span class="subheading">Vê agora</span>
              <h2 class="mb-2">As nossas novidades!</h2>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="carousel-car owl-carousel">
                  @foreach($recentCars as $car)
                      <div class="item">
                          <div class="car-wrap rounded ftco-animate">
                              <div class="img rounded d-flex align-items-end" style="background-image: url({{ asset('storage/'.$car->images->first()->path) }});">
                              </div>
                              <div class="text">
                                  <h2 class="mb-0"><a href="#">{{ $car->name }}</a></h2>
                                  <div class="d-flex mb-3">
                                      <span class="cat">{{ $car->brand }}</span>
                                      <p class="price ml-auto">{{ $car->price }}€ <span></span></p>
                                  </div>
                                  <p class="d-flex mb-0 d-block">
                                    <a href="{{ route('cars.public.cars') }}" class="btn btn-primary py-2 mr-1">Ver Mais Carros</a>
                                    <a href="#" class="btn btn-secondary py-2 ml-1">Detalhes</a>
                                  </p>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
</section>



<!--Recenetemente adicionados 4 - Fim -->
    <section class="ftco-section ftco-about" id="aboutus">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(assets/images/about.jpg);">
					</div>
					<div class="col-md-6 wrap-about ftco-animate">
	          <div class="heading-section heading-section-white pl-md-5">
	          	<span class="subheading">Sobre nós</span>
	            <h2 class="mb-4">Bem-vindos ao Drive&Ride</h2>

	            <p>Com concessionárias no Porto e em Setúbal, estamos aqui para oferecer soluções práticas e personalizadas para quem procura experiências automóveis únicas.
              </p>
	            <p>No nosso stand, alugamos carros e focamo-nos em ajudá-lo a agendar serviços especializados como revisões e testar os carros que procura através dos nossos test drives! Quer esteja a descobrir o seu próximo carro ou a cuidar do seu, garantimos um atendimento profissional e de excelência.
              </p>
	            <p><a href="#" class="btn btn-primary py-3 px-4">Procurar Veículos</a></p>
	          </div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section" id="services">
			<div class="container">
				<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Services</span>
            <h2 class="mb-3">Our Latest Services</h2>
          </div>
        </div>
				<div class="row">
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Wedding Ceremony</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">City Transfer</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Airport Transfer</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Whole City Tour</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section ftco-intro" style="background-image: url(assets/images/bg_3.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-md-6 heading-section heading-section-white ftco-animate">
            <h2 class="mb-3">Queres ver mais dos nossos carros</h2>
            <a href="{{ route('cars.public.cars') }}" class="btn btn-primary btn-lg">Vem conhecer!</a>
          </div>
				</div>
			</div>
		</section>


    <section class="ftco-section testimony-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Testimonial</span>
            <h2 class="mb-3">Happy Clients</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(assets/images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Marketing Manager</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(assets/images/person_2.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Interface Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(assets/images/person_3.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">UI Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(assets/images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Web Developer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(assets/images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">System Analyst</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

      <!-- Inicio secção suporte-->

      <section id="suporte" class="suporte-section d-flex justify-content-center align-items-center py-5" style="background-color: #f4f4f4 !important;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-header text-center" style="background: linear-gradient(90deg, #007bff, #6610f2); border-top-left-radius: 12px; border-top-right-radius: 12px;">
                        <h3 class="text-white mb-0">Suporte</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('suporte.enviar') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nome" class="font-weight-bold">Nome</label>
                                <input type="text" name="nome" id="nome" required class="form-control" placeholder="Escreva o seu nome" style="border-radius: 8px;">
                            </div>

                            <div class="form-group">
                                <label for="mensagem" class="font-weight-bold">Mensagem</label>
                                <textarea name="mensagem" id="mensagem" rows="4" required class="form-control" placeholder="Descreva sua dúvida ou problema" style="border-radius: 8px;"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-3" style="background: linear-gradient(90deg, #007bff, #6610f2); border: none; border-radius: 8px;">Enviar Pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script para garantir que o alerta desapareça após 5 segundos -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => alert.classList.add('fade-out'));
        }, 5000);
    });
</script>

<style>
    .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease;
    }
</style>
  <!-- Fim secção suporte-->

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


    <section class="ftco-counter ftco-section img bg-white" id="section-counter">
			<div class="overlay"></div>
    	<div class="container">
    		<div class="row">
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="60">0</strong>
                <span>Year <br>Experienced</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="1090">0</strong>
                <span>Total <br>Cars</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="2590">0</strong>
                <span>Happy <br>Customers</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text d-flex align-items-center">
                <strong class="number" data-number="67">0</strong>
                <span>Total <br>Branches</span>
              </div>
            </div>
          </div>
        </div>
    	</div>
    </section>	

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
                <li><a href="#services" class="py-2 d-block">Serviços</a></li>
                <li><a href="#" class="py-2 d-block">Termos e Condições</a></li>
                <li><a href="#" class="py-2 d-block">Privacidade  &amp; Política de Cookies</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Customer Support</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">FAQ</a></li>
                <li><a href="#" class="py-2 d-block">Buy a Car</a></li>
                <li><a href="#" class="py-2 d-block">Test Drive</a></li>
                <li><a href="#" class="py-2 d-block">How it works</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
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
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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
<script src="{{ asset('assets/js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset('assets/js/google-map.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>


<!-- Scripts do Bootstrap para garantir o funcionamento do alerta -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  </body>
</html>