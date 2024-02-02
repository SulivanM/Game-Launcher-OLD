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
            <input type="text" name="search" placeholder="Search for a user">
            <button type="submit">Search</button>
        </form>
        @if(isset($searchResults))
        @if($searchResults->count() > 0)
        <ul>
            @foreach($searchResults as $result)
            <li>
                {{ $result->name }}
                <form method="POST" action="{{ route('send.friend.request') }}">
                    @csrf
                    <input type="hidden" name="friend_id" value="{{ $result->id }}">
                    <button type="submit">Send Friend Request</button>
                </form>
            </li>
            @endforeach
        </ul>
        @else
        <p>No results found.</p>
        @endif
        @endif
    </main>
</div>
@endsection