<aside>
  <div class="top">
    <div class="logo">
      <img class="logo" src="{{ asset('images/logo.svg') }}" alt="Logo" href="/" />
      <h2>DCHOC <span class="danger">FR</span>
      </h2>
    </div>
    <div class="close" id="close-btn">
      <span class="material-symbols-sharp">close</span>
    </div>
  </div>
  <div class="sidebar">
    <a href="../collections" style="margin-left: 0;">
      <button class="play-button rounded-corners">
        Play
        <span class="vector-icon">
          <i class="fa fa-play-circle"></i>
        </span>
      </button>
    </a>

    <a href="../home" class="active">
      <span class="material-symbols-sharp">house</span>
      <h1 class="h1">Home</h1>
    </a>
    <a href="#">
      <span class="material-symbols-sharp">search</span>
      <h1 class="h1">Search</h1>
    </a>
    <a href="../friends">
      <span class="material-symbols-sharp">person_add</span>
      <h1 class="h1">Friends</h1>
    </a>
    <a href="../games">
      <span class="material-symbols-sharp">gamepad</span>
      <h1 class="h1">Games</h1>
    </a>
    <a href="../collections">
      <span class="material-symbols-sharp">gamepad</span>
      <h1 class="h1">Collections</h1>
    </a>
    <a href="../notifications">
      <span class="material-symbols-sharp">mail_outline</span>
      <h1 class="h1">Notifications</h1>
      <circle class="message-count">0</circle>
    </a>
    <a href="../trophy">
      <span class="material-symbols-sharp">star</span>
      <h1 class="h1">Trophy</h1>
    </a>
    <a href="../tchat">
      <span class="material-symbols-sharp">person</span>
      <h1 class="h1">Tchat</h1>
    </a>
    <a href="../streams">
      <span class="material-symbols-sharp">camera</span>
      <h1 class="h1">Streams</h1>
    </a>
    <a href="../balance">
      <span class="material-symbols-sharp">add</span>
      <h1 class="h1">Balance</h1>
    </a>
    <a href="../suggests">
      <span class="material-symbols-sharp">add</span>
      <h1 class="h1">Suggestions</h1>
    </a>
    <a id="downloadLink" href="../downloads">
      <span class="material-symbols-sharp">download</span>
      <h1 class="h1">Downloads</h1>
    </a>
    <div class="icons">
      <i class="fa-brands fa-twitch"></i>
      <i class="fa-brands fa-twitter"></i>
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-facebook"></i>
      <i class="fa-brands fa-youtube"></i>
      <i class="fa-brands fa-discord"></i>
    </div>
    <a href="../support">
      <span class="material-symbols-sharp">logout</span>
      <h1 class="h1">Support</h1>
    </a>
    <a href="{{ route('settings.show') }}">
      <span class="material-symbols-sharp">settings</span>
      <h1 class="h1">Settings</h1>
    </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
      <span class="material-symbols-sharp">logout</span>
      <h1 class="h1">{{ ('Logout') }}</h1>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
    <a href="https://cdn.digitalchocolate.online/launcher-prod/win/x64/E74E2B495D30FB57F7BD8D7F10832AEA9FE7019BC74B0C6D873C7DE480260AB3.exe" style="margin-left: 0;" id="launcherDL">
      <button class="launcher-dl-button">INSTALL LAUNCHER</button>
    </a>
  </div>
</aside>
<script>
  const downloadLink = document.getElementById('downloadLink');

  if (navigator.userAgent.toLowerCase().indexOf('electron') > -1) {
    downloadLink.addEventListener('click', (event) => {
    });
  } else {
    downloadLink.addEventListener('click', (event) => {
      event.preventDefault();
      Swal.fire({ icon: 'error', title: 'Error', text: 'This feature is only accessible with launcher app.' });
    });
  }

  const launcherDL = document.getElementById('launcherDL');

  if (navigator.userAgent.toLowerCase().indexOf('electron') > -1) {
    launcherDL.style.display = 'none';
  } else {
    launcherDL.addEventListener('click', (event) => {
      event.preventDefault();
    });
  }
</script>