@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container">
    @include('partials.sidebar')
    <main>
        @include('partials.navbar')
        <div class="subv-banner">
            <header class="subv-header">
                <div class="left-menu">
                    <a href="#">Your Store</a>
                    <a href="#">New and Discover</a>
                    <a href="#">Categories</a>
                    <a href="#">Points Store</a>
                    <a href="#">News</a>
                    <a href="#">Mystery</a>
                </div>
                <div class="search-box">
                    <form>
                        <input type="text" class="search-input" name="query" placeholder="Search...">
                        <button type="submit" class="addon-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <form>
                        <button type="submit" class="addon-button"><i class="fa-solid fa-cart-shopping"></i></button>
                    </form>
                </div>
            </header>
            <img src="{{ asset('images/app/shop-banner.jpg') }}" alt="Bannière">
            <div class="subv-banner-text">
                <h1>Join our passionate community</h1>
                <p>Explore a world of limitless entertainment. Let the adventure begin !</p>
            </div>
        </div>
        <div class="title-space">
            <h2>POPULAR AND RECOMMENDED</h2>
        </div>
        <div class="slider">
            <div class="owl-slider">
                <div id="carousel" class="owl-carousel">
                    @foreach ($games as $game)
                    <div class="item">
                        <div class="tile-1 slider-tile">
                            <img src="{{ asset('images/games/' . $game->game_image) }}" alt="{{ $game->title }}"
                                class="game-image">
                            <div class="first-txt">
                                <h2>{{ $game->title }}</h2>
                                <h1>{{ $game->subtitle }} <span class="primary">!</span></h1>
                                <p>{{ $game->description }}</p>
                                <div class="button">
                                    @if($game->status == 0)
                                    <button type="button" class="coming-soon-btn">Coming Soon</button>
                                    @else
                                    <form action="{{ route('collections.add', ['gameId' => $game->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="strim-btn">ADD TO MY COLLECTION</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="title-space">
            <h2>ALL GAMES</h2>
        </div>
        <div class="all-games-container">
            @foreach ($games as $game)
            <div class="all-games">
                <img src="{{ asset('images/games/' . $game->game_image) }}" alt="{{ $game->title }}" class="game-image">
                <div class="game-details">
                    <h2>{{ $game->title }}</h2>
                    <h1>{{ $game->subtitle }} <span class="primary">!</span></h1>
                    <p>{{ $game->description }}</p>
                    @if($game->status == 0)
                    <button type="button" class="button-all-games coming-soon">Coming Soon</button>
                    @else
                    <form action="{{ route('collections.add', ['gameId' => $game->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="button-all-games">ADD TO MY COLLECTION</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/carousel.js') }}"></script>
@endsection