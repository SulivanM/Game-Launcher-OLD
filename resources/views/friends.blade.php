@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.sidebar')
        <main>
            @include('partials.navbar')

            <h1>Friends</h1>

            <h2>Pending Friend Requests</h2>
            @if($user->pendingFriendRequests->count() > 0)
                <ul>
                    @foreach($user->pendingFriendRequests as $request)
                        <li>
                            {{ $request->name }}
                            <form method="POST" action="{{ route('accept.friend.request', $request) }}">
                                @csrf
                                <button type="submit">Accept</button>
                            </form>
                            <form method="POST" action="{{ route('decline.friend.request', $request) }}">
                                @csrf
                                <button type="submit">Decline</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No pending friend requests.</p>
            @endif

            <div id="real-time-notifications"></div>
        </main>
    </div>

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