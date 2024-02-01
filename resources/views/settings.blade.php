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
    <form method="POST" action="{{ route('settings.update') }}">
      @csrf
      @method('POST')
      <div class="settings-container">
        <div class="settings-box">
          <h1>Launcher</h1>
          <input type="hidden" name="setting_type[]" value="launcher"> <!-- Add a hidden field to differentiate settings -->
          <label for="color">Color Customisation</label>
          <input type="text" id="colorPicker" name="color" data-coloris>
        </div>
        <div class="settings-box">
          <h1>Profile</h1>
          <input type="hidden" name="setting_type[]" value="profile"> <!-- Add a hidden field to differentiate settings -->
          <div class="settings-form-group">
            <label for="prenom">First Name</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}">
          </div>
          <div class="settings-form-group">
            <label for="nom">Last Name</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom }}">
          </div>
          <div class="settings-form-group">
            <label for="language">Nationality</label>
            <select class="form-control" id="language" name="language">
              <!-- Options -->
            </select>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css" />
<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>
@endsection