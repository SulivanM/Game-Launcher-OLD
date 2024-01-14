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

    <script src="{{ asset('js/index.js') }}"></script>
@endsection
