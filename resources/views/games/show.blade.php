@extends('layouts/logged')

@section('content')

    <div class="container">
        <h2>Game lobby</h2>
    </div>

    <ul>
        @foreach ($game->players as $player)
            <li>
                Player: {{ $player->user->name }}
                @if ($player->is_host) <span class="label label-default">Host</span> @endif
            </li>
        @endforeach
    </ul>

    @if ($player->is_host)
        <div class="container">
            @if (count($game->players) >= 2)
                <a class="btn btn-default" href="{{ route('games.store') }}" role="button">start</a>
            @else
                <h3>waiting for an opponent to join...</h3>
                <p> press F5 to refresh the page </p>
            @endif
        </div>
    @else
        <div class="container">
            <h3>waiting for host to start the game...</h3>
        </div>
    @endif

@endsection
