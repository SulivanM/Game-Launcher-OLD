<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/svg" href="{{ asset('images/logo.svg') }}" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com" />
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />
  <!-- Scripts -->
  <script src="https://kit.fontawesome.com/9184ea9ca6.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- CSS -->
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <!-- Link SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div id="app">
    @if (!Request::is('/home'))
    <nav class="header navbar navbar-expand-md" style="display: none;">
      @else
      <nav class="header navbar navbar-expand-md">
        @endif
        <a href="/">
          <img class="logo" src="{{ asset('images/logo.svg') }}" alt="Logo" href="/" />
        </a>
        <a class="logo-title navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto"></ul>
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
            <!-- Authentication Links --> @guest @if (Route::has('login')) <li class="link nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}
                <i class="fas fa-user"></i>
              </a>
            </li> @endif @if (Route::has('register')) <li class="link nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}
                <i class="fas fa-user-plus"></i>
              </a>
            </li> @endif @else <li class="link nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
              </div>
            </li> @endguest
          </ul>
        </div>
  </div>
  <style>
    .navbar sup {
      background-color: {{ $user->color }};
    }

    .play-button {
      background-color: {{ $user->color }};
    }

    .aside .sidebar a.active {
      color: {{ $user->color }};
    }

    .aside .sidebar a .active span {
      color: {{ $user->color }};
    }

    aside .sidebar .message-count {
      background-color: {{ $user->color }};
    }

    .active {
      background-color: {{ $user->color }};
    }

    .primary {
      color: {{ $user->color }};
    }

    .strim-btn {
      background-color: {{ $user->color }};
    }
  </style>
  <main>@yield('content')</main>
  </div>
  @include('partials.footer')
</body>

</html>