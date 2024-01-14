<div class="search__container">
  <input class="search__input" type="text" id="search-input" placeholder="Search..">
  <i class="fa-regular fa-bell"></i>
  <i class="fa-solid fa-message">
    <sup>0 </sup>
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