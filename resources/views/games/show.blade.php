@extends('layouts/logged')

@section('content')

    @if ($game->state == 'open')
        @include('games.partials.game-open')
    @elseif ($game->state == 'in_progress')
        @include('games.partials.game-inprogress')
    @else
        @include('games.partials.game-close')
    @endif

    {{ HTML::script('js/game.js') }}
@endsection
