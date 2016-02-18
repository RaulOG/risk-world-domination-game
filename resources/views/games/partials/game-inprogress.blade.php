@extends('layouts/logged')

@section('content')

    <div class="container">
        <h2>Game in progress</h2>
    </div>

    <div>
        <h2>
            @if ($turn->player->id == $current_player->id)
                Your turn, {{ $turn->player->user->name }}!
            @else
                Is the turn of {{ $turn->player->user->name }}!
            @endif
        </h2>
        <div class="container row">
            @foreach ($game->players as $player)
                <div class="col-md-6">
                    @if ($player->id == $current_player->id)
                        <p>
                            <strong>
                                {{ $player->user->name }}
                            </strong>
                        </p>
                    @else
                        <p>
                            {{ $player->user->name }}
                        </p>
                    @endif

                    <div class="player-{{ $player->is_host? 'host' : 'guest' }}">
                        <p>number of troops</p>
                        <h4>{{ $player->troops }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
