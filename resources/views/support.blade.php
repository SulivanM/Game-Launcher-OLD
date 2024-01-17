@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
    @include('partials.sidebar')
    <main>
        @include('partials.navbar')
        <div class="subv-banner">
            <header class="subv-header">
                <div class="left-menu">
                    <a href="#">My Ticket</a>
                    <a href="#" id="openTicketBtn">Open Ticket</a>
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
        <div class="title-space">
            <h2>Support Tickets</h2>

            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
                <button type="submit">Submit Ticket</button>
            </form>

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
    </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('openTicketBtn').addEventListener('click', function () {
            // Display SweetAlert2 modal for ticket creation
            Swal.fire({
                title: 'Open Ticket',
                html:
                    '<form id="openTicketForm">' +
                    '<label for="subject">Subject:</label>' +
                    '<input type="text" id="subject" required>' +
                    '<label for="description">Description:</label>' +
                    '<textarea id="description" required></textarea>' +
                    '</form>',
                showCancelButton: true,
                confirmButtonText: 'Submit Ticket',
                preConfirm: () => {
                    // Capture form data
                    const subject = Swal.getPopup().querySelector('#subject').value;
                    const description = Swal.getPopup().querySelector('#description').value;

                    // Send AJAX request to submit the ticket
                    return fetch('{{ route('tickets.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            subject: subject,
                            description: description
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Success', 'Ticket created successfully.', 'success');
                                // You may want to refresh the ticket list or handle it accordingly
                            } else {
                                Swal.fire('Error', 'Failed to create ticket.', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'An unexpected error occurred.', 'error');
                        });
                }
            });
        });
    });
</script>
@endsection