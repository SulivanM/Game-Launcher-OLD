@extends('layouts.app') 
@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')
    <div class="title-space">
      <h2>Settings</h2>
    </div>
    <div class="settings-container">
      <div class="settings-box">
        <h1>Launcher</h1>
        <form method="POST" action="{{ route('settings.update') }}">
          @csrf
          @method('POST')
          <label for="color">Color Customisation</label>
          <input type="text" id="colorPicker" name="color" data-coloris>
          
          <label for="prenom">First Name</label>
          <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}">
          
          <label for="nom">Last Name</label>
          <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom }}">
          
          <label for="language">Nationality</label>
          <select class="form-control" id="language" name="language">
            <option value="French" @if($user->language == 'French') selected @endif>French</option>
            <option value="English" @if($user->language == 'English') selected @endif>English</option>
            <!-- autres options de langue -->
          </select>

          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css" />
<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>
@endsection
