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
        <form method="GET" action="{{ route('friends.index') }}">
            @csrf
            <input type="text" name="search" placeholder="Search users">
            <button type="submit">Search</button>
        </form>

        <h2>Available Users</h2>
        <ul>
            @foreach($users as $user)
            <li>{{ $user->name }}</li>
            @endforeach
        </ul>

    </main>
</div>
@endsection