@extends('layouts/logged')

@section('content')

    <div class="container">
        <h2>Game in progress</h2>
    </div>

    <div>
        <h2>
            Your turn, {{ $turn->player->user->name }}!
        </h2>
        <div class="container row">
            @foreach ($game->players as $player)
                <div class="col-md-6">
                    <p>{{ $player->user->name }}</p>
                    <div class="player-{{ $player->is_host? 'host' : 'guest' }}">
                        <p>number of troops</p>
                        <h4>{{ $player->troops }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
