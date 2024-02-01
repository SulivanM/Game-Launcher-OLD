@extends('layouts.app') @section('content')
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
          <button type="submit" class="btn btn-primary">Save</button>
        </form>

      </div>
      <div class="settings-box">
        <h1>Profile</h1>
        <form method="POST" action="{{ route('settings.update') }}">
          @csrf
          @method('POST')

          <div class="settings-form-group">
            <label for="prenom">First Name</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}">
          </div>

          <div class="settings-form-group">
            <label for="nom">Last Name</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom }}">
          </div>
          <label for="color">Color Customisation</label>
          <input type="text" id="colorPicker" name="color" data-coloris>
          <div class="settings-form-group">
            <label for="language">Nationality</label>
            <select class="form-control" id="language" name="language">
              <option value="French" @if($user->language == 'French') selected @endif>French</option>
              <option value="English" @if($user->language == 'English') selected @endif>English</option>
              <option value="Spanish" @if($user->language == 'Spanish') selected @endif>Spanish</option>
              <option value="German" @if($user->language == 'German') selected @endif>German</option>
              <option value="Chinese" @if($user->language == 'Chinese') selected @endif>Chinese</option>
              <option value="Japanese" @if($user->language == 'Japanese') selected @endif>Japanese</option>
              <option value="Korean" @if($user->language == 'Korean') selected @endif>Korean</option>
              <option value="Russian" @if($user->language == 'Russian') selected @endif>Russian</option>
              <option value="Italian" @if($user->language == 'Italian') selected @endif>Italian</option>
              <option value="Portuguese" @if($user->language == 'Portuguese') selected @endif>Portuguese</option>
              <option value="Dutch" @if($user->language == 'Dutch') selected @endif>Dutch</option>
              <option value="Arabic" @if($user->language == 'Arabic') selected @endif>Arabic</option>
            </select>
          </div>

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