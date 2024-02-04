@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
  <h1>Downloads</h1>
    <div class="game-details">
        <h2>{{ $game->title }}</h2>
        <p>{{ $game->description }}</p>
        <a href="{{ route('games.downloads', ['id' => $game->id]) }}">Download</a>
    </div>
   @include('partials.navbar')
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection