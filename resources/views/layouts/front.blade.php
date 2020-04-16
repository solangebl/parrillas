<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Parrillas Martinez</title>
	<meta name="description" content="" />
	<meta name="keywords" content="">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="/css/styles.css" rel="stylesheet">

	<meta name="author" content="kilak.com" />
	<meta name="copyright" content="kilak.com" />
	<meta name="distribution" content="global" />
	<meta name="robots" content="all" />

	<meta property="og:title" content="Parrillas Martinez">
	<meta property="og:description" content="">
	<meta property="og:image" content="/img/favicons/fb-thumbnail.jpg">
	<meta property="og:url" content="http://www.parrillasmartinez.com.ar/">
	<meta name="twitter:card" content="summary_large_image">

	<link rel="apple-touch-icon" sizes="57x57" href="{{asset('/img/favicons/apple-icon-57x57.png')}}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{asset('/img/favicons/apple-icon-60x60.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('/img/favicons/apple-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/favicons/apple-icon-76x76.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('/img/favicons/apple-icon-114x114.png')}}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{asset('/img/favicons/apple-icon-120x120.png')}}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{asset('/img/favicons/apple-icon-144x144.png')}}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{asset('/img/favicons/apple-icon-152x152.png')}}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/img/favicons/apple-icon-180x180.png')}}">
	<link rel="icon" type="image/png" sizes="192x192" href="{asset('/img/favicons/android-icon-192x192.png')}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('/img/favicons/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('/img/favicons/favicon-96x96.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('/img/favicons/favicon-16x16.png')}}">
</head>

<body>
<div class="container-fluid p-0 mb-4">
		<header>
			<div class="container">
				<div class="row">
					<div class="col-12 col-lg-6 text-center text-lg-left logo">
						<a href="/"><img src="/img/header/logo-encabezado.png" alt="Parrillas Martinez" class="img-fluid" /></a>
					</div>
					<div class="col-12 col-lg-6 text-center text-lg-right">
						<div class="redes">
							<a href="https://www.instagram.com/parrillas.martinez/" target="_target"><i class="fab fa-instagram"></i></a>
							<a href="https://www.facebook.com/parrillas.martinez" target="_blank"><i class="fab fa-facebook-f"></i></a>
							<!--a href=""><i class="fab fa-twitter"></i></a>
							<a href=""><i class="fab fa-youtube"></i></a-->
							<a href="https://wa.me/5491136830254" target="_blank"><i class="fab fa-whatsapp"></i></a>
							<a href="mailto:parrillasmartinez@hotmail.com"><i class="far fa-envelope"></i></a>
						</div>
						<div class="telefono">
							<span>
								<a href="tel:+5491136830254"><i class="fas fa-phone"></i> +54 9 11 3683 0254</a>
							</span>
						</div>
						<div class="links">
							<a href="">QUIENES SOMOS</a> | <a href="/ayuda">AYUDA</a>
						</div>
						<div class="buscador">
							<form action="{{ route('products.search') }}" method="post" name="search">
								<i class="fas fa-search"></i>
								{{ csrf_field() }}
								<input type="text" name="name" id="" class="form-control w-50" placeholder="Buscar productos...">
								<button type="submit" class="btn btn-primary">buscar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</header>
	</div>

	<div class="container">


		<!-- WhatsApp Flotante | Inicio -->
		<div class="text-right mr-5 mr-lg-4">
			<a href="https://wa.me/5491136830254" target="_blank" class="whatsappGlobal"><i class="fab fa-whatsapp"></i></a>
		</div>
		<!-- WhatsApp Flotante | Fin -->
		<div class="row">
			<div class="col-0 col-lg-3 colLeft">
				<nav class="navbar navbar-expand-lg navbar-light">
					<button class="navbar-toggler mx-auto mb-3" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
						<label>CATEGORÍAS</label>
						@foreach ($categories as $cat)
							@if(count($cat->subcategories) == 0)
								@if(count($cat->products)>0)
								<li class="nav-item">
									<a class="nav-link" href="{{route('product.list', 'c-'.$cat->id)}}">{!! $cat->name !!}</a>
								</li>
								@endif
							@else
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								{!! $cat->name !!}
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									@foreach($cat->subcategories as $scat)
									@if(count($scat->products)>0)
									<a class="dropdown-item" href="{{route('product.list', 's-'.$scat->id)}}">{!! $scat->name !!}</a>
									@endif
									@endforeach
								</div>
							</li>
							@endif
						@endforeach
						</ul>
					</div>

				</nav>

				<div class="zonaCobertura">
					<label>ZONA DE COBERTURA</label>
					<i class="fas fa-map-marked-alt"></i> Zona Norte, Gran Buenos Aires, Argentina
					<div class="embed-responsive embed-responsive-16by9 mt-3">
						<iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26306.88532231155!2d-58.53274596327861!3d-34.493739680704465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcb05662e4a08d%3A0x9811553c3a21048c!2sMart%C3%ADnez%2C%20Buenos%20Aires%20Province!5e0!3m2!1sen!2sar!4v1581622703065!5m2!1sen!2sar" width="240" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
					</div>
				</div>

				<div class="zonaCobertura">
					<label>FORMAS DE PAGO</label>
					<img src="/img/formas-de-pago.jpg" class="img-fluid mx-auto d-block" alt="" />
				</div>
			</div>




			<main class="col-12 col-lg-9">

				<!-- CONTENT -->
				@yield('content')

			</main>
		</div>
	</div>

	<footer class="container-fluid mt-5">
		<div class="container py-3">
			<div class="row align-items-center">
				<div class="col-12 col-lg-3 text-center text-lg-left parrillas">
					<a href="/"><img src="/img/footer/logo-footer.png" alt=""></a>
				</div>
				<div class="col-12 col-lg-7 text-center my-2 telefono">
					<a href="tel:+5491136830254"><i class="fas fa-phone"></i> +54 9 11 3683 0254</a>
				</div>
				<div class="col-12 col-lg-2 text-center text-lg-right kilak">
					<a href="https://www.kilak.com" target="_blank"><img src="/img/footer/logo-kilak.png" alt="Kilak | Design Studio"></a>
				</div>
			</div>
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</body>
</html>
