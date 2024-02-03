@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    <div class="banner" id="particles-js">
      @include('partials.navbar')
      <div class="banner-text">
        <h1>DIGITAL +</h1>
        <br>
        <h1>
          <span style="color:#3c454c;"> COMING </span>
          <span class="primary">SOON</span>
        </h1>
        <p style="color: #fdfdfd;">More Details <span style="color: white;">></span>
        </p>
      </div>
      <div class="bottom">
        <a href="{{ route('profile') }}">
          <div class="profile-photo">
            @if(Auth::user()->profile_image)
            <img src="{{ asset('images/profiles/' . Auth::user()->profile_image) }}" alt="Profile Image">
            @else
            <img src="{{ asset('images/profile-icon.png') }}" alt="Default Profile Image">
            @endif
          </div>
        </a>
        <button type="button" class="strim-btn">Profile</button>
        <button>Challenge</button>
        <p>
          <b class="mx-3">Team: NONE</b>
          <i class="fa fa-pencil"></i>
        </p>
      </div>
      <div class="dfjsac">
        <div class="links">
          <a href="#" class="nav-link" data-target="basic-information">Basic Information</a>
          <a href="#" class="nav-link" data-target="statistics">Statistics</a>
          <a href="#" class="nav-link" data-target="team">Team</a>
          <a href="#" class="nav-link" data-target="acheivements">Acheivements</a>
          <a href="#" class="nav-link" data-target="friends">Friends</a>
        </div>
        <div class="social-links">
          <a href="#">
            <i class="fa-brands fa-twitch"></i>
          </a>
          <a href="#">
            <i class="fa-brands fa-twitter"></i>
          </a>
          <a href="#">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="#">
            <i class="fa-brands fa-facebook"></i>
          </a>
          <a href="#">
            <i class="fa-brands fa-youtube"></i>
          </a>
          <a href="#">
            <i class="fa-brands fa-discord"></i>
          </a>
        </div>
      </div>
      <div class="line"></div>
    </div>
    <div class="title-space">
      <span class="dc-loader"></span>
    </div>
    <div class="section" id="basic-information">
      <div class="title-space">
        <h1> RANDOM GAMES </h1>
      </div>
      <div class="slider">
        <div class="owl-slider">
          <div id="carousel" class="owl-carousel">
            @foreach ($games as $game)
            <div class="item">
              <div class="tile-1 slider-tile">
                <img src="{{ asset('images/games/' . $game->game_image) }}" alt="{{ $game->title }}" class="game-image">
                <div class="first-txt">
                  <h2>{{ $game->title }}</h2>
                  <h1>{{ $game->subtitle }} <span class="primary">!</span></h1>
                  <p>{{ $game->description }}</p>
                  <div class="button">
                    @if($game->status == 0)
                    <button type="button" class="coming-soon-btn">Coming Soon</button>
                    @else
                    <form action="{{ route('collections.add', ['gameId' => $game->id]) }}" method="post">
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
    </div>

    <div class="section" id="statistics" style="display:none;">
      <div class="statistics">
        <div class="statistics-heading">
          <h1> Statistics </h1>
          <!--<div>
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
        </div>-->
        </div>
        <div class="data">
          <div>
            <img src="{{ asset('images/app/stats.svg') }}" class="shield-img">
          </div>
          <div>
            <p>
              <span class="text_mutted">Nickname</span> {{ Auth::user()->name }}
            </p>
            <p>
              <span class="text_mutted">Real Name </span>
              @if (!is_null($user->prenom) || !is_null($user->nom))
              {{ $user->prenom ?? 'NA' }} {{ $user->nom ?? 'NA' }}
              @else
              NA
              @endif
            </p>
            <p class="flag-img">
              <span class="text_mutted">Nationality </span>
              @if (!is_null($user->language))
              {{ $user->language ?? 'NA' }}
              @php
              $flagImagePath = asset("images/app/languages/{$user->language}.svg");
              @endphp
              <img src="{{ $flagImagePath }}" alt="{{ $user->language }} flag">
              @else
              NA
              @endif
            </p>
          </div>
          <div>
            <p>
              <span class="text_mutted">Level</span> NA
            </p>
            <p>
              <span class="text_mutted">Team</span> NA
            </p>
            <p>
              <span class="text_mutted">Best Friend</span> NA
            </p>
          </div>
          <div>
            <p>
              <span class="text_mutted">Win Rate</span> NA%
            </p>
            <p>
              <span class="text_mutted">Rating Total </span> NA
            </p>
            <p>
              <span class="text_mutted">Position</span> NA
            </p>
          </div>
          <div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-gold"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-gold"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
          </div>
          <div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-sliver"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-sliver"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section" id="team" style="display:none;">
      <div class="statistics">
        <div class="statistics-heading">
          <h1> Team </h1>
          <!--<div>
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
        </div>-->
        </div>
        <div class="data">
          <div>
            <img src="{{ asset('images/app/stats.svg') }}" class="shield-img">
          </div>
          <div>
            <p>
              <span class="text_mutted">Nickname</span> {{ Auth::user()->name }}
            </p>
            <p>
              <span class="text_mutted">Real Name </span>
              @if (!is_null($user->prenom) || !is_null($user->nom))
              {{ $user->prenom ?? 'NA' }} {{ $user->nom ?? 'NA' }}
              @else
              NA
              @endif
            </p>
            <p class="flag-img">
              <span class="text_mutted">Nationality </span>
              @if (!is_null($user->language))
              {{ $user->language ?? 'NA' }}
              @else
              NA
              @endif
              <img src="{{ asset('images/app/flag.png') }}">
            </p>
          </div>
          <div>
            <p>
              <span class="text_mutted">Level</span> NA
            </p>
            <p>
              <span class="text_mutted">Team</span> NA
            </p>
            <p>
              <span class="text_mutted">Best Friend</span> NA
            </p>
          </div>
          <div>
            <p>
              <span class="text_mutted">Win Rate</span> NA%
            </p>
            <p>
              <span class="text_mutted">Rating Total </span> NA
            </p>
            <p>
              <span class="text_mutted">Position</span> NA
            </p>
          </div>
          <div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-gold"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-gold"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
          </div>
          <div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-sliver"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-sliver"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section" id="acheivements" style="display:none;">
      <div class="statistics">
        <div class="statistics-heading">
          <h1> Acheivements </h1>
          <!--<div>
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
        </div>-->
        </div>
        <div class="data">
          <div>
            <img src="{{ asset('images/app/stats.svg') }}" class="shield-img">
          </div>
          <div>
            <p>
              <span class="text_mutted">Nickname</span> {{ Auth::user()->name }}
            </p>
            <p>
              <span class="text_mutted">Real Name </span>
              @if (!is_null($user->prenom) || !is_null($user->nom))
              {{ $user->prenom ?? 'NA' }} {{ $user->nom ?? 'NA' }}
              @else
              NA
              @endif
            </p>
            <p class="flag-img">
              <span class="text_mutted">Nationality </span>
              @if (!is_null($user->language))
              {{ $user->language ?? 'NA' }}
              @else
              NA
              @endif
              <img src="{{ asset('images/app/flag.png') }}">
            </p>
          </div>
          <div>
            <p>
              <span class="text_mutted">Level</span> NA
            </p>
            <p>
              <span class="text_mutted">Team</span> NA
            </p>
            <p>
              <span class="text_mutted">Best Friend</span> NA
            </p>
          </div>
          <div>
            <p>
              <span class="text_mutted">Win Rate</span> NA%
            </p>
            <p>
              <span class="text_mutted">Rating Total </span> NA
            </p>
            <p>
              <span class="text_mutted">Position</span> NA
            </p>
          </div>
          <div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-gold"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-gold"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
          </div>
          <div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-sliver"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-sliver"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="section" id="friends" style="display:none;">
      <div class="statistics">
        <div class="statistics-heading">
          <h1> Friends </h1>
          <!--<div>
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
          <img src="{{ asset('images/app/pro-img.png') }}">
        </div>-->
        </div>
        <div class="data">
          <div>
            <img src="{{ asset('images/app/stats.svg') }}" class="shield-img">
          </div>
          <div>
            <p>
              <span class="text_mutted">Nickname</span> {{ Auth::user()->name }}
            </p>
            <p>
              <span class="text_mutted">Real Name </span>
              @if (!is_null($user->prenom) || !is_null($user->nom))
              {{ $user->prenom ?? 'NA' }} {{ $user->nom ?? 'NA' }}
              @else
              NA
              @endif
            </p>
            <p class="flag-img">
              <span class="text_mutted">Nationality </span>
              @if (!is_null($user->language))
              {{ $user->language ?? 'NA' }}
              @else
              NA
              @endif
              <img src="{{ asset('images/app/flag.png') }}">
            </p>
          </div>
          <div>
            <p>
              <span class="text_mutted">Level</span> NA
            </p>
            <p>
              <span class="text_mutted">Team</span> NA
            </p>
            <p>
              <span class="text_mutted">Best Friend</span> NA
            </p>
          </div>
          <div>
            <p>
              <span class="text_mutted">Win Rate</span> NA%
            </p>
            <p>
              <span class="text_mutted">Rating Total </span> NA
            </p>
            <p>
              <span class="text_mutted">Position</span> NA
            </p>
          </div>
          <div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-gold"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-gold"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
          </div>
          <div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-sliver"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
            <div class="price-tag">
              <div class="icon">
                <i class="fas fa-trophy trophy-sliver"></i>
              </div>
              <div>
                <p>Prize pool <br>
                  <span class="text_mutted">NA $</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="{{ asset('js/particules-home.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/carousel.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
@endsection