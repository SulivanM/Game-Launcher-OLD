@extends('layouts.app')
@section('content')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<!-- Ajoutez le script hCaptcha -->
<script src="https://hcaptcha.com/1/api.js" async defer></script>

<form class="connect-form" method="POST" action="{{ route('login') }}" id="loginForm">
    <a href="/">
        <img class="logo" src="{{ asset('images/logo.svg') }}" alt="Logo">
    </a>
    @csrf
    <h1>{{ __('Login') }}</h1>

    <input id="email" type="email" class="form-control bg-dark text-white @error('email') is-invalid @enderror"
        name="email" value="{{ old('email') }}" autocomplete="email" required placeholder="{{ __('Email Address') }}"
        autofocus />
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
        class="form-control bg-dark text-white @error('password') is-invalid @enderror" name="password"
        autocomplete="current-password" required placeholder="{{ __('Password') }}" />
    @error('password')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: @json($message),
        });
    </script>
    @enderror

    <h5>{{ __('Remember Me') }}</h5>
    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    <!-- Ajoutez le champ hCaptcha -->
    <div class="h-captcha" data-sitekey="07bd6c94-935f-4a36-b0b8-a0cd2a201c77"></div>
    <button type="button" onclick="validateForm()">{{ __('Login') }}</button>
    <p class="or">OR</p>
    <div class="additional-buttons">
        <button type=button class="register-button"
            onclick="window.location.href = '{{ url('register') }}'"><i
                class="fas fa-user-plus"></i> Register</button>
        <button type=button class="forgot-password-button"
            onclick="window.location.href = '{{ url('password/reset') }}'"><i class="fas fa-key"></i> Forgot
            Password</button>
    </div>
</form>
<div class="social-buttons">
    <button class="social-button twitter" onclick="window.location.href = '{{ url('auth/twitter') }}'">
        <i class="fa-brands fa-x-twitter"></i> Login With X</button>
    <button class="social-button github" onclick="window.location.href = '{{ url('auth/github') }}'">
        <i class="fab fa-github"></i> Login With GitHub</button>
    <button class="social-button discord" onclick="window.location.href = '{{ url('auth/discord') }}'">
        <i class="fab fa-discord"></i> Login With Discord</button>
</div>

<script>
    function validateForm() {
        // Vérifier si hCaptcha est validé
        var response = hcaptcha.getResponse();
        if (response) {
            // Si hCaptcha est validé, soumettre le formulaire
            document.getElementById('loginForm').submit();
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
