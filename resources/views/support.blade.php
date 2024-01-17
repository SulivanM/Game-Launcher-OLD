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
          <a id="open-ticket">Open Ticket</a>
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
        <input type="text" name="subject" required>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
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
        // Ajoutez un gestionnaire de clic sur le lien "Open Ticket"
        document.getElementById('open-ticket').addEventListener('click', function (event) {
            event.preventDefault();

            // Affichez la fenêtre modale avec le formulaire
            Swal.fire({
                title: 'Open Ticket',
                html:
                    '<form id="ticket-form">' +
                    '   @csrf' +
                    '   <label for="subject">Subject:</label>' +
                    '   <input type="text" name="subject" id="subject" required>' +
                    '   <label for="description">Description:</label>' +
                    '   <textarea name="description" id="description" required></textarea>' +
                    '</form>',
                showCancelButton: true,
                confirmButtonText: 'Submit Ticket',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    // Récupérez les données du formulaire
                    const formData = new FormData(document.getElementById('ticket-form'));

                    // Soumettez les données via AJAX
                    return fetch('{{ route('tickets.store') }}', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
                },
            }).then(result => {
                // Vérifiez si la requête AJAX a réussi
                if (result.isConfirmed) {
                    Swal.fire('Ticket submitted successfully!', '', 'success');
                    // Vous pouvez actualiser la page ici si nécessaire
                    location.reload();
                }
            });
        });
    });
</script>
@endsection