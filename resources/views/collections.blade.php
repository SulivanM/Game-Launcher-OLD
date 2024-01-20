@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')
    <div class="all-games-container">
      @foreach ($games as $game)
      <div class="all-games">
        <h2>{{ $game->title }}</h2>
        <p>{{ $game->description }}</p>
      </div>
      @endforeach
    </div>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection