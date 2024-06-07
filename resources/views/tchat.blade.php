@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
    @include('partials.sidebar')
    <main>
        @include('partials.navbar')

        <div class="chat-container">
            <div class="chat-messages" id="chat-messages">
                @forelse($messages as $message)
                <div class="message">
                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                </div>
                @empty
                <p>No messages at the moment.</p>
                @endforelse
            </div>

            <form id="message-form" action="{{ route('chat.send') }}" method="post">
                @csrf
                <input type="text" id="message-input" name="message" placeholder="Enter your message...">
                <button type="submit">Send</button>
            </form>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ecouter les messages envoyés en temps réel avec Pusher
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            encrypted: true
        });

        var channel = pusher.subscribe('chat');
        channel.bind('message.sent', function(data) {
            var messageContainer = document.getElementById('chat-messages');
            var messageElement = document.createElement('div');
            messageElement.classList.add('message');
            messageElement.innerHTML = '<strong>' + data.message.user.name + ':</strong> ' + data.message.message;
            messageContainer.appendChild(messageElement);
        });

        // Envoyer les données via AJAX lors de la soumission du formulaire
        document.getElementById('message-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var messageInput = document.getElementById('message-input');
            var message = messageInput.value;

            axios.post('{{ route('
                    chat.send ') }}', {
                        message: message
                    })
                .then(function(response) {
                    // Check if the message was sent successfully
                    if (response.data.status === 'Message sent!') {
                        // Clear the input field
                        messageInput.value = '';
                    } else {
                        // Handle other status responses (optional)
                        console.log(response.data);
                    }
                })
                .catch(function(error) {
                    // Handle validation errors
                    if (error.response && error.response.status === 422) {
                        console.log(error.response.data.errors);
                    } else {
                        // Handle other errors
                        console.error(error);
                    }
                });
        });

    });
</script>
@endsection