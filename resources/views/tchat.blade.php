@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
    @include('partials.sidebar')
    <main>
        @include('partials.navbar')

        <div class="chat-container">
            <div class="chat-messages">
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
                <button type="button" id="send-message">Send</button>
            </form>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('message-form');
        var messageInput = document.getElementById('message-input');
        var sendMessageButton = document.getElementById('send-message');

        sendMessageButton.addEventListener('click', function(event) {
            event.preventDefault();
            
            var message = messageInput.value;

            // Envoyer les données via AJAX
            axios.post('{{ route('chat.send') }}', {
                message: message
            })
            .then(function (response) {
                // Réponse de succès
                console.log(response.data);

                // Effacer le champ de saisie
                messageInput.value = '';
            })
            .catch(function (error) {
                // Gérer les erreurs
                console.error(error);
            });
        });

        // Ecouter les messages envoyés en temps réel avec Pusher
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            encrypted: true
        });

        var channel = pusher.subscribe('chat');
        channel.bind('message.sent', function(data) {
            var messageContainer = document.querySelector('.chat-messages');
            var messageElement = document.createElement('div');
            messageElement.classList.add('message');
            messageElement.innerHTML = '<strong>' + data.message.user.name + ':</strong> ' + data.message.message;
            messageContainer.appendChild(messageElement);
        });
    });
</script>
@endsection