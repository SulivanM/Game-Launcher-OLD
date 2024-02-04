@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  <h1>Téléchargements</h1>

  @if(isset($game))
  <div class="game-details">
    <h2>{{ $game->title }}</h2>
    <p>{{ $game->description }}</p>
    <a href="{{ route('games.download', ['id' => $game->id]) }}" class="btn btn-primary">Télécharger {{ $game->title
      }}</a>
  </div>
  @else
  <p>Aucun jeu sélectionné pour le téléchargement.</p>
  @endif
</div>
@endsection