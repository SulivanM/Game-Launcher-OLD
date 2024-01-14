@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
   @include('partials.navbar')
	  <div class="title-space">
	  	<h2>{{ $game->title }}</h2>
      </div>
	  <div class="game">
    <img style="width: 500px;" src="{{ asset('images/games/' . $game->game_image) }}" alt="{{ $game->title }}" class="game-image">
    <p>{{ $game->description }}</p>
    <div class="button">
        <a href="{{ $game->game_link }}" class="strim-btn">PLAY NOW</a>
    </div>
	</div>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/carousel.js') }}"></script>
@endsection