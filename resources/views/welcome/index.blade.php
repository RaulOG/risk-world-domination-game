@extends('layouts/logged')

@section('title', 'World Manager')

@section('content')
    <div class="container">
        <h2>
            Welcome again, {{ Auth::user()->name }}!
        </h2>
        <nav class="row">
            {{ Form::open(['url' => route('games.store'), 'method' => 'post', 'class' => 'formWelcome']) }}
            <div class="col-md-6">
                <button class="btn" id="join" href="{{ route('games.store') }}" role="button"></button>                
            </div>
            {{ Form::close() }}

            {{ Form::open(['url' => route('games.store'), 'method' => 'post', 'class' => 'formWelcome']) }}
            <div class="col-md-6">
                <button class="btn" id="create" href="{{ route('games.store') }}" role="button"></button>
            </div>
            {{ Form::close() }}
        </nav>
    </div>
@endsection