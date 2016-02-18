<div class="game_content">
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
    <div class="game_content row">
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
                {{ Form::open(array('route' => array('games.action', $game->id), 'method' => 'post', 'name' => 'actionForm'))  }}
                    @if ($player->id == $current_player->id)
                        {{ Form::hidden('action', 'action.eot') }}
                        {{Form::submit('End the turn') }}
                    @else
                        {{ Form::hidden('action', 'action.attack') }}
                        {{Form::submit('Attack') }}
                    @endif
                {{ Form::close() }}
            </div>
        @endforeach
    </div>
</div>
