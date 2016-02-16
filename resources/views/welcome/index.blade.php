@extends('layouts/logged')

@section('title', 'World Manager')

@section('content')
    <div class="container">
        <h2>
            Welcome again, {{ Auth::user()->name }}!
        </h2>
        <nav>
            {{ Form::open(['url' => route('games.store'), 'method' => 'post']) }}
            <div class="well"><button class="btn btn-success" href="{{ route('games.store') }}" role="button">join game</button></div>
            {{ Form::close() }}

            {{ Form::open(['url' => route('games.store'), 'method' => 'post']) }}
            <div class="well"><button class="btn btn-success" href="{{ route('games.store') }}" role="button">create new game</button></div>
            {{ Form::close() }}
        </nav>
    </div>
@endsection