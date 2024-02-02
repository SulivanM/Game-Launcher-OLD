@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container">
    @include('partials.sidebar')
    <main>
        @include('partials.navbar')

        <h1>Friends</h1>

        <h2>Your Friends</h2>
        @if(!is_null($friends))
            @foreach($friends as $friend)
            <p>{{ $friend->name }}</p>
            @endforeach
        @else
            <p>No friends at the moment.</p>
        @endif

        <h2>Pending Friend Requests</h2>
        @if(!is_null($friendRequests))
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
        @else
            <p>No pending friend requests.</p>
        @endif

        <h2>Send Friend Request</h2>
        <form method="POST" action="{{ route('send.friend.request') }}">
            @csrf
            <select name="friend_id">
                @if(!is_null($users))
                    @foreach($users as $user)
                        @if($user->id != auth()->id())
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
            <button type="submit">Send Friend Request</button>
        </form>
    </main>
</div>
@endsection