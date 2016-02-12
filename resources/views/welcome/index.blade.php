@extends('layouts/logged')

@section('title', 'World Manager')

@section('content')
    <div>
        <h2>
            Welcome again, {{ Auth::user()->name }}!
        </h2>
        <nav class="row">
            <div class="col-sm-4"><a class="btn btn-default" href="{{ route('worlds.select') }}" role="button">VISIT WORLDS</a></div>
            <div class="col-sm-4"><a class="btn btn-default" href="{{ route('worlds.index') }}" role="button">MANAGE WORLDS</a></div>
            <div class="col-sm-4"><a class="btn btn-default" href="{{ route('users.index') }}" role="button">MANAGE USERS</a></div>
        </nav>
    </div>
@endsection