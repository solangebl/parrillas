<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Parrillas Martínez - Administrador') }}</title>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
    <!-- Dashboard Core -->

    <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/utils.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="app">
      <div class="page">

      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
                <a class="header-brand" href="{{ url('/admin/home') }}">
                  <img src="{{ asset('img/header/logo-encabezado.png') }}" class="header-brand-img" alt="Parrillas Martínez - Administrador">
                    Parrillas Martínez - Administrador
                </a>
                <div class="d-flex order-lg-2 ml-auto">
                  @guest
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  @else
                  <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                      <span class="ml-2 d-none d-lg-block">
                        <span class="text-default">{{ Auth::user()->name }}</span>
                      </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="dropdown-icon fe fe-log-out"></i> Salir
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </div>
                  </div>
                  @endguest
                </div>
                <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                  <span class="header-toggler-icon"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @auth
      <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg order-lg-first">
              <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                <li class="nav-item">
                  <a href="{{ url('/admin/home') }}" class="nav-link {{ (empty(Request::segment(2)) || Request::segment(2)=='home') ? 'active' : '' }}"><i class="fe fe-home"></i> Home</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('categories.index') }}" class="nav-link {{ Request::segment(2)=='categories' ? 'active' : '' }}"><i class="fe fe-tag"></i> Categorías</a>
                </li>
				        <li class="nav-item">
                  <a href="{{ route('providers.index') }}" class="nav-link {{ Request::segment(2)=='providers' ? 'active' : '' }}"><i class="fe fe-truck"></i> Proveedores</a>
                </li>
				        <li class="nav-item">
                  <a href="{{ route('deposits.index') }}" class="nav-link {{ Request::segment(2)=='deposits' ? 'active' : '' }}"><i class="fe fe-package"></i> Depósitos</a>
                </li>
				        <li class="nav-item">
                  <a href="{{ route('products.index') }}" class="nav-link"><i class="fe fe-shopping-cart {{ Request::segment(2)=='products' ? 'active' : '' }}"></i> Productos</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      @endauth

      <div class="my-3 my-md-5">
          <div class="container">

          @yield('content')
          </div>
      </div>


      <!-- End page -->
      </div>
    <!-- End App -->
    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    @yield('script')
</body>
</html>
