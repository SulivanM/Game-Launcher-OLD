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
        <!-- ... (rest of the header) ... -->
      </header>
      <!-- ... (rest of the banner) ... -->
    </div>
    <div class="title-space">
      <h2>Support Tickets</h2>

      <!-- Form to create a ticket (unchanged) -->

      @foreach($user->tickets ?? [] as $ticket)
      <!-- Ticket display (unchanged) -->
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