<div class="navbar">
  <input class="search__input" type="text" id="search-input" placeholder="Search..">
  <i class="fa-regular fa-bell"></i>
  <i class="fa-solid fa-message">
    <sup>0</sup>
  </i>
  <div class="right">
    <div class="top">
      <button id="menu-btn">
        <span class="material-symbols-sharp">menu</span>
      </button>
      <p>
        <b>Theme</b>
      </p>
      <div class="theme-toggler">
        <span class="material-symbols-sharp">light_mode</span>
        <span class="material-symbols-sharp active">dark_mode</span>
      </div>
      <div class="profile">
        <div class="info">
          <p><a href="{{ route('profile') }}">{{ Auth::user()->name }}</a></p>
          <p class="coin-text">{{ number_format(Auth::user()->dcoin, 2) }} DCOIN</p>
        </div>
        <a href="{{ route('profile') }}">
          <div class="profile-photo">
            @if(Auth::user()->profile_image)
            <img src="{{ asset('images/profiles/' . Auth::user()->profile_image) }}" alt="Profile Image">
            @else
            <img src="{{ asset('images/profile-icon.png') }}" alt="Default Profile Image">
            @endif
          </div>
        </a>
      </div>
      <a href="{{ route('settings.show') }}">
        <i class="fa-solid fa-gear"></i>
      </a>
    </div>
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

    .line {
      border-bottom: 4px solid {{ $user->color }};
    }

    .strim-btn {
      background-color: {{ $user->color }};
    }

    .launcher-dl-button {
      border: 3px solid {{ $user->color }};
      box-shadow: 5px 5px {{ $user->color }};
    }

    .launcher-dl-button:active {
      box-shadow: 0px 0px {{ $user->color }};
    }
  </style>