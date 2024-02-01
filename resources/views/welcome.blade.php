@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
	
	@include('preloader')

    <header class="header">
        <div class="logo">
            <a href="/">
                <img class="logo-img" src="{{ asset('images/logo.svg') }}" alt="Logo">
            </a>
        </div>
        <nav class="nav-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

	<div class="title-main">
		<h2>WELCOME TO MOBACHOCOLATE LAUNCHER !</h2>
        <p>Total Chocolate Users: {{ $totalUsers }} Thanks !</p>
	</div>

	<div class="slider">
    <div class="owl-slider">
        <div id="carousel" class="owl-carousel">
            @foreach ($games as $game)
            <div class="item">
                <div class="slider-tile">
					<img src="{{ asset('images/games/' . $game->game_image) }}" alt="{{ $game->title }}" class="game-image">
                </div>
            </div>
            @endforeach
        </div>
    </div>
	</div>

	<script src="{{ asset('js/preloader.js') }}"></script>
	<script src="{{ asset('js/carousel.js') }}"></script>
@endsection
