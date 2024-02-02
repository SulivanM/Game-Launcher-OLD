@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container">
    @include('partials.sidebar')
    <main>
        @include('partials.navbar')
        <div class="subv-banner">
            <header class="subv-header">
                <div class="left-menu">
                    <a href="#" class="page-link" data-target="my-friends">My Friends</a>
                    <a href="#" class="page-link" data-target="pending-friends">Pending Friends</a>
                </div>
                <div class="search-box">
                    <form method="GET" action="{{ route('friends.index') }}">
                        @csrf
                        <input type="text" class="search-input" name="search" placeholder="Search User...">
                        <button type="submit" class="addon-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </header>
            <img src="{{ asset('images/app/banner.jpg') }}" alt="Bannière">
            <div class="subv-banner-text">
                <h1>Friends</h1>
                <p>Add your chocolate friends now !</p>
            </div>
        </div>

        <ul>
            @foreach($users as $user)
            <li>
                {{ $user->name }}
                <form id="friend-request-form-{{ $user->id }}" method="POST"
                    action="{{ route('send.friend.request') }}">
                    @csrf
                    <input type="hidden" name="friend_id" value="{{ $user->id }}">
                    <button type="button" class="send-friend-request-btn" data-user-id="{{ $user->id }}">Send Friend
                        Request</button>
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
<script src="{{ asset('js/index.js') }}"></script>
<script>
    // Écouteur d'événement pour les clics sur les boutons d'envoi de demande d'ami
    document.querySelectorAll('.send-friend-request-btn').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-user-id');

            Swal.fire({
                title: 'Send Friend Request',
                text: 'Are you sure you want to send a friend request?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire correspondant
                    document.getElementById('friend-request-form-' + userId).submit();
                }
            });
        });
    });
</script>
@endsection