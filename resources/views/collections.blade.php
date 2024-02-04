@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="container">
        @include('partials.sidebar')
        <main>
            @include('partials.navbar')
            <div class="title-space">
                <h2>MY COLLECTIONS</h2>
            </div>
            <div class="title-space">
                <span class="dc-loader"></span>
            </div>
            <div class="section" id="game-collection" style="display:none;">
                <div class="all-games-container">
                    @if(count($games) > 0)
                        @foreach ($games as $game)
                            <div class="all-games">
                                <img src="{{ asset('images/games/' . $game->game_image) }}" alt="{{ $game->title }}" class="game-image">
                                <div class="game-details">
                                    <h2>{{ $game->title }}</h2>
                                    <h1>{{ $game->subtitle }} <span class="primary">!</span></h1>
                                    <p>{{ $game->description }}</p>
                                    <a href="{{ route('games.download', ['id' => $game->id]) }}" class="button-all-games">Download</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>There are no games in your collection.</p>
                    @endif
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/collections.js') }}"></script>
@endsection
