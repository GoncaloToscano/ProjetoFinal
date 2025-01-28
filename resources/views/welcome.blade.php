<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Car</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
<link href="{{ asset('assets/css/font.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap') }}" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">

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

<!-- Include Bootstrap CSS -->
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
                    <li class="nav-item"><a href="#aboutus" class="nav-link">Sobre</a></li>
                    <li class="nav-item"><a href="{{ route('service.index') }}" class="nav-link">Serviços</a></li>

                    <li class="nav-item">
                      <a href="{{ route('cars.public.cars') }}" class="nav-link">Carros</a>
                    </li>

                  <li class="nav-item"><a href="#concessionarias" class="nav-link">Concessionárias</a></li>
                    <li class="nav-item"><a href="#contactos" class="nav-link">Contactos</a></li>
    
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
    
    
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('assets/images/bg_g80.jpg');" data-stellar-background-ratio="0.5">
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


<!-- Início Serviço -->
<section class="ftco-section ftco-no-pt bg-light">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-md-12 featured-top">
        <div class="row no-gutters">
          <div class="col-md-4 d-flex align-items-center">
            <!-- Formulário -->
            <form action="{{ route('service.store') }}" method="POST" class="request-form ftco-animate bg-primary">
              @csrf
              <h2>Agendar Serviço</h2>

              
              <!-- Carro (Auto Complete) -->
              <div class="form-group position-relative">
                <label for="car-model" class="label">Carro</label>
                <input type="text" id="car-model" name="car_model" class="form-control" placeholder="Escolhe o modelo do teu carro..." autocomplete="off">
                <ul id="car-model-suggestions" class="suggestions-list"></ul>
              </div>

              <!-- Concessionária (Dropdown) -->
              <div class="form-group">
                <label for="dealership" class="label">Concessionária</label>
                <select class="form-control" id="dealership" name="dealership" required>
                  <option value="setubal">Setúbal</option>
                  <option value="porto">Porto</option>
                </select>
              </div>

              <!-- Data de Entrega -->
              <div class="d-flex">
                <div class="form-group mr-2">
                  <label for="delivery-date" class="label">Data Entrega</label>
                  <input type="date" class="form-control" id="delivery-date" name="delivery_date" required>
                </div>

                <!-- Data de Recolha (Automaticamente Calculada) -->
                <div class="form-group mr-2">
                  <label for="pickup-date" class="label">Data-Recolha</label>
                  <input type="text" class="form-control" id="pickup-date" name="pickup_date" readonly required>
                </div>
              </div>

              <!-- Serviço -->
              <div class="form-group">
                <label for="service" class="label">Serviço</label>
                <select class="form-control" id="service" name="service" required>
                    <option value="Revisão">Revisão</option>
                    <option value="Mudança de Pneus">Mudança de Pneus</option>
                    <option value="Troca de Óleo">Troca de Óleo</option>
                    <option value="Lavagem Detalhada">Lavagem Detalhada</option>
                    <option value="Polimento">Polimento</option>
                    <option value="Pintura">Pintura</option>
                    <option value="Substituição de Bateria">Substituição de Bateria</option>
                    <option value="Diagnóstico de Motor">Diagnóstico de Motor</option>
                    <option value="Manutenção de Ar Condicionado">Manutenção de Ar Condicionado</option>
                    <option value="Outro">Outro</option>
                </select>
              </div>
            
              @if(auth()->check()) <!-- Verifica se o usuário está autenticado -->
            @else
              <!-- Aviso de login necessário -->
              <div class="alert alert-warning d-flex align-items-center mt-3" role="alert">
                <div>
                  <i class="fas fa-exclamation-triangle mr-2"></i> <!-- Ícone de aviso -->
                  <strong>Precisas estar logado!</strong> Por favor, <a href="{{ route('login') }}" class="alert-link">faz login aqui</a>.
                </div>
              </div>
            @endif

              <div class="form-group">
                <input type="submit" value="Agendar Serviço" class="btn btn-secondary py-3 px-4">
              </div>
            </form>
          </div>

          <!-- Aluguel de Carro -->
          <div class="col-md-8 d-flex align-items-center">
            <div class="services-wrap rounded-right w-100">
              <h3 class="heading-section mb-4">Aluga um carro conosco!</h3>
              <!-- Aqui você pode manter as opções de aluguer de carro -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Script para Autocompletar Carros e Calcular Data de Recolha -->
<script>

  // Lista de modelos de carros
  const carModels = [
  "Audi A3 (1996-2003)",
  "Audi A3 (2004-2012)",
  "Audi A3 (2013-2020)",
  "Audi A4 (1994-2000)",
  "Audi A4 (2001-2007)",
  "Audi A4 (2008-2015)",
  "BMW Série 3 (1998-2005)",
  "BMW Série 3 (2006-2012)",
  "BMW Série 3 (2013-2018)",
  "BMW Série 5 (2003-2010)",
  "BMW Série 5 (2011-2016)",
  "Fiat Punto (1984-1994)",
  "Fiat Punto (1995-2003)",
  "Fiat Punto (2004-2012)",
  "Fiat Punto (2013-2023)",
  "Ford Focus (1998-2004)",
  "Ford Focus (2005-2010)",
  "Ford Focus (2011-2018)",
  "Ford Fiesta (1995-2002)",
  "Ford Fiesta (2003-2008)",
  "Ford Fiesta (2009-2019)",
  "Honda Civic (1996-2000)",
  "Honda Civic (2001-2005)",
  "Honda Civic (2006-2011)",
  "Honda Civic (2012-2016)",
  "Honda Civic (2017-2021)",
  "Honda Fit (2001-2007)",
  "Honda Fit (2008-2014)",
  "Honda Fit (2015-2021)",
  "Hyundai HB20 (2012-2018)",
  "Hyundai HB20 (2019-2023)",
  "Hyundai Creta (2016-2021)",
  "Hyundai Creta (2022-2023)",
  "Toyota Corolla (1998-2003)",
  "Toyota Corolla (2004-2008)",
  "Toyota Corolla (2009-2013)",
  "Toyota Corolla (2014-2018)",
  "Toyota Corolla (2019-2023)",
  "Toyota Yaris (2006-2011)",
  "Toyota Yaris (2012-2017)",
  "Toyota Yaris (2018-2023)",
  "Volkswagen Golf (1997-2003)",
  "Volkswagen Golf (2004-2008)",
  "Volkswagen Golf (2009-2013)",
  "Volkswagen Golf (2014-2019)",
  "Volkswagen Polo (1996-2001)",
  "Volkswagen Polo (2002-2008)",
  "Volkswagen Polo (2009-2017)",
  "Volkswagen Polo (2018-2023)",
  "Nissan Versa (2011-2019)",
  "Nissan Versa (2020-2023)",
  "Renault Sandero (2007-2013)",
  "Renault Sandero (2014-2020)",
  "Renault Sandero (2021-2023)",
  "Kia Sportage (2005-2010)",
  "Kia Sportage (2011-2015)",
  "Kia Sportage (2016-2022)",
  "Jeep Renegade (2015-2023)",
  "Toyota Hilux (2005-2015)",
  "Toyota Hilux (2016-2023)",
  "Ferrari F430 (2004-2009)",
  "Ferrari 458 Italia (2009-2015)",
  "Ferrari 488 GTB (2015-2019)",
  "Lamborghini Gallardo (2003-2013)",
  "Lamborghini Huracan (2014-2023)",
  "Porsche 911 (1999-2004)",
  "Porsche 911 (2005-2011)",
  "Porsche 911 (2012-2019)",
  "Chevrolet Camaro (2010-2015)",
  "Chevrolet Camaro (2016-2023)",
  "Ford Mustang (2005-2014)",
  "Ford Mustang (2015-2023)",
  "Dodge Challenger (2008-2014)",
  "Dodge Challenger (2015-2023)",
  "Nissan GT-R (2007-2023)",
  "Audi R8 (2006-2015)",
  "Audi R8 (2016-2023)",
  "BMW M3 (2007-2013)",
  "BMW M3 (2014-2020)",
  "Mercedes-AMG GT (2015-2023)",
  "McLaren 570S (2015-2021)",
  "McLaren 720S (2017-2023)",
  "Aston Martin V8 Vantage (2005-2017)",
  "Aston Martin V8 Vantage (2018-2023)",
  "Renault Clio (1998-2005)",
  "Renault Clio (2006-2012)",
  "Renault Clio (2013-2023)",
  "Peugeot 208 (2012-2018)",
  "Peugeot 208 (2019-2023)",
  "Peugeot 308 (2007-2013)",
  "Peugeot 308 (2014-2021)",
  "Peugeot 308 (2022-2023)",
  "Seat Ibiza (2008-2016)",
  "Seat Ibiza (2017-2023)",
  "Seat Leon (2005-2012)",
  "Seat Leon (2013-2020)",
  "Seat Leon (2021-2023)",
  "Opel Corsa (2006-2014)",
  "Opel Corsa (2015-2023)",
  "Opel Astra (2009-2015)",
  "Opel Astra (2016-2023)",
  "Citroën C3 (2002-2009)",
  "Citroën C3 (2010-2016)",
  "Citroën C3 (2017-2023)",
  "Audi RS6 (2002-2004)",
  "Audi RS6 (2008-2010)",
  "Audi RS6 (2013-2018)",
  "Audi RS6 (2019-2024)",
  "Volkswagen Golf GTI (1976-1983)",
  "Volkswagen Golf GTI (1984-1991)",
  "Volkswagen Golf GTI (1992-1997)",
  "Volkswagen Golf GTI (2004-2009)",
  "Volkswagen Golf GTI (2013-2020)",
  "Volkswagen Golf GTI (2020-2024)",
  "Volkswagen Golf R (2010-2014)",
  "Volkswagen Golf R (2015-2020)",
  "Volkswagen Golf R (2021-2024)",
  "Audi RS3 (2011-2012)",
  "Audi RS3 (2015-2018)",
  "Audi RS3 (2020-2024)",
  "BMW M4 (2014-2020)",
  "BMW M4 (2021-2024)",
  "Mercedes-AMG A45 (2013-2015)",
  "Mercedes-AMG A45 (2016-2022)",
  "Mercedes-AMG A45 (2023-2024)",
  "Porsche 911 Turbo (2006-2009)",
  "Porsche 911 Turbo (2010-2016)",
  "Porsche 911 Turbo (2017-2020)",
  "Porsche 911 Turbo (2021-2024)"
];




// Referências aos elementos do DOM
const input = document.getElementById("car-model");
const suggestionsList = document.getElementById("car-model-suggestions");

// Evento de input para atualizar sugestões
input.addEventListener("input", () => {
  const query = input.value.toLowerCase(); // Texto digitado pelo usuário
  
  // Limpa as sugestões anteriores
  suggestionsList.innerHTML = "";

  if (query) {
    // Filtra os modelos de carros com base na entrada
    const filteredModels = carModels.filter(model => model.toLowerCase().includes(query));

    // Adiciona as sugestões à lista
    filteredModels.forEach(model => {
      const listItem = document.createElement("li");
      listItem.textContent = model;
      listItem.classList.add("suggestion-item");

      // Evento de clique para preencher o input com a sugestão selecionada
      listItem.addEventListener("click", () => {
        input.value = model;
        suggestionsList.innerHTML = ""; // Limpa as sugestões após a seleção
      });

      suggestionsList.appendChild(listItem);
    });
  }
});

// Estilos básicos para as sugestões
const style = document.createElement("style");
style.textContent = `
  .suggestions-list {
    position: absolute;
    background: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    max-height: 150px;
    overflow-y: auto;
    padding: 0;
    margin: 0;
    list-style: none;
    width: 100%;
    z-index: 1000;
  }

  .suggestion-item {
    padding: 8px;
    cursor: pointer;
  }

  .suggestion-item:hover {
    background-color: #f0f0f0;
  }
`;
document.head.appendChild(style);


// Função para calcular a data de recolha (uma semana após a data de entrega)
document.getElementById('delivery-date').addEventListener('change', function() {
  let deliveryDate = new Date(this.value);
  if (!isNaN(deliveryDate.getTime())) {
      deliveryDate.setDate(deliveryDate.getDate() + 7); // Adiciona 7 dias
      let pickupDate = deliveryDate.toISOString().split('T')[0]; // Formato yyyy-mm-dd
      document.getElementById('pickup-date').value = pickupDate;
  }
});
</script>


<!-- CSS para a lista de sugestões -->
<style>
  #car-model-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background-color: white;
    border: 1px solid #ccc;
    border-top: none;
    max-height: 200px;
    overflow-y: auto;
    z-index: 1000;
    list-style-type: none;
    padding: 0;
    margin: 0;
  }

  .suggestion-item {
    padding: 10px;
    cursor: pointer;
  }

  .suggestion-item:hover {
    background-color: #f0f0f0;
  }

  .suggestion-item:active {
    background-color: #ddd;
  }

  /* Ajuste de estilo para os campos select */
  select.form-control {
      background-color: #f8f9fa !important;  /* Cor de fundo clara */
      color: #333 !important;  /* Cor do texto escura */
      border: 1px solid #ccc !important;  /* Borda sutil */
      padding: 10px;  /* Padding confortável */
      font-size: 16px;  /* Tamanho de fonte legível */
      appearance: none;  /* Remover o estilo padrão do select */
      -webkit-appearance: none; /* Para Safari */
      -moz-appearance: none; /* Para Firefox */
  }

  /* Ajuste de cor para as opções dentro do dropdown */
  select.form-control option {
      background-color: #ffffff !important;  /* Cor de fundo das opções */
      color: #333 !important;  /* Cor do texto das opções */
  }

  /* Cor do texto do campo de input */
  input.form-control {
      color: #333 !important;  /* Garante que o texto no campo input seja visível */
  }

  /* Estilo de foco do select */
  select.form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }

</style>
<!-- Fim do Serviço-->


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
                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-secondary py-2 ml-1">Detalhes</a>
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
					<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(assets/images/image_1.jpg);">
					</div>
					<div class="col-md-6 wrap-about ftco-animate">
	          <div class="heading-section heading-section-white pl-md-5">
	          	<span class="subheading">Sobre nós</span>
	            <h2 class="mb-4">Bem-vindos ao Drive&Ride</h2>

	            <p>Com concessionárias no Porto e em Setúbal, estamos aqui para oferecer soluções práticas e personalizadas para quem procura experiências automóveis únicas.
              </p>
	            <p>No nosso stand, alugamos carros e focamo-nos em ajudá-lo a agendar serviços especializados como revisões e testar os carros que procura através dos nossos test drives! Quer esteja a descobrir o seu próximo carro ou a cuidar do seu, garantimos um atendimento profissional e de excelência.
              </p>
	            <p><a href="{{ route('cars.public.cars') }}" class="btn btn-secondary py-3 px-4">Procurar Veículos</a></p>
	          </div>
					</div>
				</div>
			</div>
		</section>

    <section class="ftco-section" id="services">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Serviços</span>
            <h2 class="mb-3">Os nossos serviços mais requisitados</h2>
          </div>
        </div>
        <div class="row">
          <!-- Troca de Óleo -->
          <div class="col-md-3">
            <div class="services services-2 w-100 text-center" style="height: 350px;">
              <div class="icon d-flex align-items-center justify-content-center" style="background: #007bff; border-radius: 50%; width: 80px; height: 80px; margin-bottom: 20px;">
                <i class="fas fa-oil-can" style="font-size: 30px; color: white;"></i> <!-- Ícone de troca de óleo -->
              </div>
              <div class="text w-100">
                <h3 class="heading mb-2">Troca de Óleo</h3>
                <p>Realizamos a troca de óleo do motor com produtos de alta qualidade para manter seu veículo em perfeito estado.</p>
              </div>
            </div>
          </div>
    
          <!-- Revisão Completa -->
          <div class="col-md-3">
            <div class="services services-2 w-100 text-center" style="height: 350px;">
              <div class="icon d-flex align-items-center justify-content-center" style="background: #007bff; border-radius: 50%; width: 80px; height: 80px; margin-bottom: 20px;">
                <i class="fas fa-tools" style="font-size: 30px; color: white;"></i> <!-- Ícone de ferramentas -->
              </div>
              <div class="text w-100">
                <h3 class="heading mb-2">Revisão Completa</h3>
                <p>Inspecionamos o motor, suspensão, freios e mais para garantir a segurança e desempenho do seu carro.</p>
              </div>
            </div>
          </div>
    
          <!-- Diagnóstico Eletrônico -->
          <div class="col-md-3">
            <div class="services services-2 w-100 text-center" style="height: 350px;">
              <div class="icon d-flex align-items-center justify-content-center" style="background: #007bff; border-radius: 50%; width: 80px; height: 80px; margin-bottom: 20px;">
                <i class="fas fa-laptop-code" style="font-size: 30px; color: white;"></i> <!-- Ícone de diagnóstico eletrônico -->
              </div>
              <div class="text w-100">
                <h3 class="heading mb-2">Diagnóstico Eletrônico</h3>
                <p>Identificamos e corrigimos falhas nos sistemas eletrônicos do veículo com tecnologia de ponta.</p>
              </div>
            </div>
          </div>
    
          <!-- Lavagem Completa -->
          <div class="col-md-3">
            <div class="services services-2 w-100 text-center" style="height: 350px;">
              <div class="icon d-flex align-items-center justify-content-center" style="background: #007bff; border-radius: 50%; width: 80px; height: 80px; margin-bottom: 20px;">
                <i class="fas fa-water" style="font-size: 30px; color: white;"></i> <!-- Ícone de lavagem -->
              </div>
              <div class="text w-100">
                <h3 class="heading mb-2">Lavagem Completa</h3>
                <p>Oferecemos serviços de lavagem interna e externa. Uma limpeza detalhada, deixando o seu carro com aparência de novo.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    
    
    
    

		<section class="ftco-section ftco-intro" style="background-image: url(assets/images/image_6.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-md-6 heading-section heading-section-white ftco-animate">
            <h2 class="mb-3">Queres ver mais dos nossos serviços</h2>
            <a href="{{ route('service.index') }}" class="btn btn-secondary btn-lg">Vem conhecer mais!</a>
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
      <section>
  <!-- Contact Form HTML -->
  <div id="contactos" class="container contact-form">
    <br>
    <div class="contact-image">
        <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
    </div>
    <form action="{{ route('suporte.enviar') }}" method="POST">
        @csrf
        <h3>Envie-nos uma Mensagem</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="nome" class="form-control" placeholder="Seu Nome *" required />
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Seu E-mail *" required />
                </div>
                <div class="form-group">
                    <input type="text" name="telefone" class="form-control" placeholder="Seu Telefone *" required />
                </div>
                <div class="form-group">
                    <input type="submit" class="btnContact" value="Enviar Mensagem" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea name="mensagem" class="form-control" placeholder="Sua Mensagem *" style="height: 150px;" required></textarea>
                </div>
            </div>
        </div>
    </form>
  </div>
</section>

<!-- Styling for the contact form -->
<style>
  body {
      background: #f1f1f1; /* Fundo geral mais escuro */
  }

  .contact-form {
      background: #ffffff; /* Fundo branco do formulário */
      margin-top: 10%;
      margin-bottom: 5%;
      width: 70%;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15); /* Sombra mais evidente */
      border: 1px solid #dcdcdc; /* Borda mais contrastante */
  }

  .contact-form .form-control {
      border-radius: 1rem;
      box-shadow: none;
      border: 1px solid #ccc;
  }

  .contact-image {
      text-align: center;
  }

  .contact-image img {
      border-radius: 50%;
      width: 12%;
      margin-top: -4%;
      transform: rotate(29deg);
  }

  .contact-form form {
      padding: 10%;
  }

  .contact-form h3 {
      margin-bottom: 3rem;
      text-align: center;
      color: #0062cc;
  }

  .contact-form .btnContact {
      width: 50%;
      border: none;
      border-radius: 1rem;
      padding: 1.5%;
      background: #dc3545;
      font-weight: 600;
      color: #fff;
      cursor: pointer;
  }

  .contact-form .btnContact:hover {
      background-color: #c82333;
  }

  input.form-control, textarea.form-control {
      padding: 1rem;
      font-size: 1rem;
  }

  .form-group {
      margin-bottom: 1.5rem;
  }
</style>


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
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
<!-- Include Bootstrap and jQuery JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

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