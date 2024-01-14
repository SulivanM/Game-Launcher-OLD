@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
   @include('partials.navbar')
	  	<div class="profile-photo">
            @if($user->profile_image) <!-- Utilisez $user->profile_image au lieu de Auth::user()->profile_image -->
                <img src="{{ asset('images/profiles/' . $user->profile_image) }}" alt="Profile Image">
            @else
                <img src="{{ asset('images/profile-icon.png') }}" alt="Default Profile Image">
            @endif
        </div>
		<h1>User : {{ $user->name }}</h1>
	    @if (!is_null($user->prenom) && !is_null($user->nom))
        <p>Real Name : {{ $user->prenom }} {{ $user->nom }}</p>
		@else
			<p>Real Name : NA</p>
		@endif
	    @if (!is_null($user->language))
        <p>Nationality : {{ $user->language }}</p>
		@else
			<p>Nationality : NA</p>
		@endif
        <p>Email : {{ $user->email }}</p>
	  	<p>User Created At : {{ $user->created_at->format('d/m/Y H:i:s') }}</p>
        <p>Last Login : {{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection