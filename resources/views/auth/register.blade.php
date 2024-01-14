@extends('layouts.app')
@section('content')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<!-- Ajoutez le script hCaptcha -->
<script src="https://hcaptcha.com/1/api.js" async defer></script>

<form class="connect-form" method="POST" action="{{ route('register') }}" id="registerForm">
    <a href="/">
        <img class="logo" src="{{ asset('images/logo.svg') }}" alt="Logo">
    </a>
    @csrf
    <h1>{{ __('Register') }}</h1>

    <input id="name" type="text" class="form-control bg-dark text-white @error('name') is-invalid @enderror"
        name="name" value="{{ old('name') }}" required placeholder="{{ __('Name') }}" autocomplete="name" autofocus />
    @error('name')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: @json($message),
        });
    </script>
    @enderror

    <input id="email" type="email" class="form-control bg-dark text-white @error('email') is-invalid @enderror"
        name="email" value="{{ old('email') }}" required placeholder="{{ __('Email Address') }}"
        autocomplete="email" />
    @error('email')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: @json($message),
        });
    </script>
    @enderror

    <input id="password" type="password"
        class="form-control bg-dark text-white @error('password') is-invalid @enderror" name="password" required
        placeholder="{{ __('Password') }}" autocomplete="new-password" />
    @error('password')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: @json($message),
        });
    </script>
    @enderror

    <input id="password-confirm" type="password" class="form-control bg-dark text-white" name="password_confirmation"
        required placeholder="{{ __('Password') }}" autocomplete="new-password" />

    <!-- Ajoutez le champ hCaptcha -->
    <div class="h-captcha" data-sitekey="07bd6c94-935f-4a36-b0b8-a0cd2a201c77"></div>

    <button type="button" onclick="validateForm()">{{ __('Register') }}</button>
    <p class="or">OR</p>
    <div class="additional-buttons">
        <button type=button class="login-button"
            onclick="window.location.href = '{{ url('login') }}'"><i class="fas fa-sign-in-alt"></i> Login</button>
        <button type=button class="forgot-password-button"
            onclick="window.location.href = '{{ url('password/reset') }}'"><i class="fas fa-key"></i> Forgot
            Password</button>
    </div>
</form>
<div class="social-buttons">
    <button class="social-button twitter" onclick="window.location.href = '{{ url('auth/twitter') }}'">
        <i class="fa-brands fa-x-twitter"></i> Register With X</button>
    <button class="social-button github" onclick="window.location.href = '{{ url('auth/github') }}'">
        <i class="fab fa-github"></i> Register With GitHub</button>
    <button class="social-button discord" onclick="window.location.href = '{{ url('auth/discord') }}'">
        <i class="fab fa-discord"></i> Register With Discord</button>
</div>

<script>
    function validateForm() {
        // Vérifier si hCaptcha est validé
        var response = hcaptcha.getResponse();
        if (response) {
            // Si hCaptcha est validé, soumettre le formulaire
            document.getElementById('registerForm').submit();
        } else {
            // Sinon, afficher un message d'erreur
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please complete the hCaptcha verification.',
            });
        }
    }
</script>

@endsection
