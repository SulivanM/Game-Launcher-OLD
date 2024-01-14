@extends('layouts.app') @section('content')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<form class="connect-form" method="POST" action="{{ route('login') }}">
   <a href="/">
      <img class="logo" src="{{ asset('images/logo.svg') }}" alt="Logo">
   </a> @csrf
   <h1>{{ __('Reset Password') }}</h1>
   <input id="email" type="email" class="form-control bg-dark text-white @error('email') is-invalid @enderror"
      name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> @error('email') <span
      class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
   </span> @enderror <button type="submit">{{ __('Send Password Link') }}</button>
   <p class="or">OR</p>
   <div class="additional-buttons">
      <button type=button class="register-button" onclick="window.location.href = '{{ url('/') }}'">
         <i class="fas fa-user-plus"></i> Home </button>
   </div>
</form>
@endsection