@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.sidebar')
    <main>
        @include('partials.navbar')

        <h1>Friends</h1>

        <!-- Barre de recherche -->
        <form method="GET" action="{{ route('search.friends') }}">
            @csrf
            <input type="text" name="search" placeholder="Search friends">
            <button type="submit">Search</button>
        </form>

        <!-- Affichage des amis existants -->
        <h2>Your Friends</h2>
        @if(!is_null($user->friends) && $user->friends->count() > 0)
        <ul>
            @foreach($user->friends as $friend)
            <li>
                {{ $friend->name }}
                <form method="POST" action="{{ route('remove.friend', $friend) }}">
                    @csrf
                    <button type="submit">Remove</button>
                </form>
            </li>
            @endforeach
        </ul>
        @else
        <p>No friends at the moment.</p>
        @endif

        <!-- Affichage des résultats de recherche -->
        @if(isset($searchResults))
        <h2>Search Results</h2>
        @if($searchResults->count() > 0)
        <ul>
            @foreach($searchResults as $result)
            <li>
                {{ $result->name }}
                <form method="POST" action="{{ route('send.friend.request', $result) }}">
                    @csrf
                    <button type="submit">Send Friend Request</button>
                </form>
            </li>
            @endforeach
        </ul>
        @else
        <p>No results found.</p>
        @endif
        @endif

        <!-- Section pour afficher les notifications en temps réel -->
        <div id="real-time-notifications"></div>
    </main>
</div>

<!-- Intégration de Laravel Echo pour les notifications en temps réel -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.1/dist/echo.iife.js"></script>
<script>
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        encrypted: true,
    });

    const channel = pusher.subscribe('friend-requests');

    channel.bind('FriendRequestSent', (event) => {
        document.getElementById('real-time-notifications').innerHTML +=
            `<div>New friend request from ${event.user.name}</div>`;
    });

    channel.bind('FriendRequestAccepted', (event) => {
        document.getElementById('real-time-notifications').innerHTML +=
            `<div>${event.user.name} accepted your friend request</div>`;
    });

    channel.bind('FriendRequestDeclined', (event) => {
        document.getElementById('real-time-notifications').innerHTML +=
            `<div>${event.user.name} declined your friend request</div>`;
    });
</script>
@endsection