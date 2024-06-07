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
                <button type="submit">Send</button>
            </form>
        </div>
    </main>
</div>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
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
</script>
@endsection