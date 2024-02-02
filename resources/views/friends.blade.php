@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container">
    @include('partials.sidebar')
    <main>
        @include('partials.navbar')

        <h1>Friends</h1>

        <h2>Your Friends</h2>
        @foreach($friends as $friend)
        <p>{{ $friend->name }}</p>
        @endforeach

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

        <h2>Send Friend Request</h2>
        <form method="POST" action="{{ route('send.friend.request') }}">
            @csrf
            <input type="text" name="search" placeholder="Search friends">
            <button type="submit">Search</button>
        </form>
        @if(isset($searchResults))
        <ul>
            @foreach($searchResults as $user)
            <li>
                {{ $user->name }}
                <input type="hidden" name="friend_id" value="{{ $user->id }}">
                <button type="submit">Send Friend Request</button>
            </li>
            @endforeach
        </ul>
        @endif

    </main>
</div>
@endsection