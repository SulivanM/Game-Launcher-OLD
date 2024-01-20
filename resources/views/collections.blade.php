@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')
    <div class="all-games-container">
      @foreach ($games as $game)
      <div class="all-games">
        <img src="{{ asset('images/games/' . $game->game_image) }}" alt="{{ $game->title }}" class="game-image">
        <div class="game-details">
          <h2>{{ $game->title }}</h2>
          <h1>{{ $game->subtitle }} <span class="primary">!</span></h1>
          <p>{{ $game->description }}</p>
          <div class="button-all-games">
            <a href="{{ route('games.show', ['id' => $game->id]) }}">PLAY NOW FOR FREE !</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection