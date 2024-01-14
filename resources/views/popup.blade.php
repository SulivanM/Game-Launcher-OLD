@extends('layouts.app') @section('content')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<form class="connect-form" method="POST" action="{{ route('update.email') }}">
   <a href="/">
      <img class="logo" src="{{ asset('images/logo.svg') }}" alt="Logo">
   </a> @csrf
   <h1>{{ __('Add Your Email') }}</h1>
   <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
   <button type="submit" class="btn btn-primary">Submit</button>
   <div class="additional-buttons">
      <button type=button class="register-button" onclick="window.location.href = '{{ url('/') }}'">
         <i class="fas fa-user-plus"></i> Home </button>
   </div>
</form>
@endsection