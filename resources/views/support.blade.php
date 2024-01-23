@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')
    <div class="subv-banner">
      <header class="subv-header">
        <div class="left-menu">
          <a href="#" class="page-link" data-target="support-tickets">My Ticket</a>
          <a href="#" class="page-link" data-target="open-tickets">Open Ticket</a>
          <a href="#" class="page-link" data-target="faq-tickets">FAQ</a>
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
    <div class="title-space">
      <span class="dc-loader"></span>
    </div>
    <div class="section" id="support-tickets" style="display:none;">
      <div class="title-space">
        <h2>Support Tickets</h2>
        <div class="all-box-container">
          @if(count($user->tickets) > 0)
          @foreach($user->tickets as $ticket)
          <div class="all-box">
            <img src="{{ asset('images/profile-icon.png') }}" alt="Image" class="box-image">
            <div class="box-details">
              <h2>{{ $ticket->subject }}</h2>
              <p>{{ $ticket->description }}</p>
              <p>Status: {{ $ticket->status }}</p>

              @if(Auth::user() && (Auth::user()->id === $ticket->user_id) && $ticket->status !== 'closed')
              <form action="{{ route('tickets.close', ['ticket' => $ticket]) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit">Close Ticket</button>
              </form>
            </div>
            @endif
          </div>
          @endforeach
          @else
          <p>You don't have a ticket for the moment.</p>
          @endif
        </div>
      </div>
    </div>
    <div class="section" id="open-tickets" style="display:none;">
      <div class="title-space">
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
    </div>
    <div class="section" id="faq-tickets" style="display:none;">
      <div class="title-space">
        <h2>FAQ</h2>
        <p>This section aims to answer frequently asked questions. Feel free to explore the content below.</p>
        <div class="faq-container">
          <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(0)">
              How do I submit a support ticket? <i class="fas fa-chevron-right"></i>
            </div>
            <div class="faq-answer">
              To submit a support ticket, click "Open Ticket" on this page. Fill in the required fields and click
              “Submit ticket”.
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(1)">
              Can I edit or update my submitted ticket? <i class="fas fa-chevron-right"></i>
            </div>
            <div class="faq-answer">
              Yes, if you have additional information you can reply to the answer.
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(2)">
              How can I check the status of my ticket? <i class="fas fa-chevron-right"></i>
            </div>
            <div class="faq-answer">
              You can check the status of your ticket in the "My Ticket" section. Open the ticket details to view its
              current status.
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/support.js') }}"></script>
@endsection