@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')
    <div class="subv-banner">
      <header class="subv-header">
        <div class="left-menu">
          <a href="#">My Ticket</a>
          <a href="#">Open Ticket</a>
          <a href="#">FAQ</a>
        </div>
        <div class="search-box">
          <form>
            <input type="text" class="search-input" name="query" placeholder="Search...">
            <button type="submit" class="addon-button"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          <form>
            <button type="submit" class="addon-button"><i class="fa-solid fa-envelope"></i></button>
          </form>
        </div>
      </header>
      <img src="{{ asset('images/app/banner.jpg') }}" alt="Bannière">
      <div class="subv-banner-text">
        <h1>Ticket</h1>
        <p>If you encounter any issues, kindly submit a support ticket for prompt assistance.</p>
      </div>
    </div>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection