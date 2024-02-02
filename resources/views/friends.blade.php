@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container">
    @include('partials.sidebar')
    <main>
        @include('partials.navbar')
        <form method="GET" action="{{ route('friends.index') }}">
            @csrf
            <input type="text" name="search" placeholder="Search users">
            <button type="submit">Search</button>
        </form>

        <ul>
            @foreach($users as $user)
            <li>
                {{ $user->name }}
                <form method="POST" action="{{ route('send.friend.request') }}">
                    @csrf
                    <input type="hidden" name="friend_id" value="{{ $user->id }}">
                    <button type="submit">Send Friend Request</button>
                </form>
            </li>
            @endforeach
        </ul>
        <h2>Friends</h2>
        @if($friends->isEmpty())
        <p>You don't have any friends yet.</p>
        @else
        @foreach($friends as $friend)
        <p>{{ $friend->name }}</p>
        @endforeach
        @endif

        <h2>Pending Friend Requests</h2>
        @foreach($friendRequests as $request)
        <p>{{ $request->name }}
        <form method="POST" action="{{ route('accept.friend.request', $request) }}">
            @csrf
            <button type="submit">Accept</button>
        </form>
        <form method="POST" action="{{ route('decline.friend.request', $request) }}">
            @csrf
            <button type="submit">Decline</button>
        </form>
        </p>
        @endforeach
    </main>
</div>
@endsection