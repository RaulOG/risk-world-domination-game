@extends('layouts/logged')

@section('title', 'World Manager')

@section('content')
    <div class="container">
        <h2>
            Welcome again, {{ Auth::user()->name }}!
        </h2>
        <nav>
            <div class="well"><a class="btn btn-success" href="{{ route('worlds.select') }}" role="button">join game</a></div>
            <div class="well"><a class="btn btn-success" href="{{ route('worlds.index') }}" role="button">create new game</a></div>
            <div><img src="ManageUsers.jpg" class="img-rounded" alt="join game" width="300" height="300"></div>
        </nav>
    </div>
@endsection