@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')
    <div class="subv-banner">
      <header class="subv-header">
        <div class="left-menu">
          <a href="#" onclick="showTickets()">My Ticket</a>
          <a href="#" onclick="showForm()">Open Ticket</a>
          <a href="#" onclick="showFAQ()">FAQ</a>
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
    <div class="title-space" id="ticketsSection">
      <h2>Support Tickets</h2>
      @foreach($user->tickets ?? [] as $ticket)
      <div>
        <h3>{{ $ticket->subject }}</h3>
        <p>{{ $ticket->description }}</p>
        <p>Status: {{ $ticket->status }}</p>

        @if(Auth::user() && (Auth::user()->id === $ticket->user_id) && $ticket->status !== 'closed')
        <form action="{{ route('tickets.close', ['ticket' => $ticket]) }}" method="POST">
          @csrf
          @method('PATCH')
          <button type="submit">Close Ticket</button>
        </form>
        @endif
      </div>
      @endforeach
    </div>
    <div class="title-space" id="formSection" style="display: none;">
      <h2>Support Tickets</h2>
      <form action="{{ route('tickets.store') }}" method="POST">
          @csrf
          <label for="subject">Subject:</label>
          <input type="text" name="subject" required>
          <label for="description">Description:</label>
          <textarea name="description" required></textarea>
          <button type="submit">Submit Ticket</button>
      </form>
    </div>
    <div id="faqSection" style="display: none;">
      <p>This is the FAQ section. Add your FAQ content here.</p>
    </div>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/support.js') }}"></script>
@endsection