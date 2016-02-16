@extends('layouts/logged')

@section('title', 'World Manager')

@section('content')
    <div class="container">
        <h2>
            Welcome again, {{ Auth::user()->name }}!
        </h2>
        <nav>
            {{ Form::open(['url' => route('games.store'), 'method' => 'post']) }}
            <button type="submit">Create game</button>
            {{ Form::close() }}

            {{--<div class="well"><a class="btn btn-success" href="{{ route('games.store') }}" role="button">join game</a></div>--}}
            {{--<div class="well"><a class="btn btn-success" href="{{ route('games.store') }}" role="button">create new game</a></div>--}}
        </nav>
    </div>
@endsection