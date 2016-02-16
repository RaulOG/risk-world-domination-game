@extends('layouts/logged')

@section('content')

    <div class="container">
        <h2>New game lobby</h2>
    </div>

    <div class="container">
        <h3>waiting for an opponent to join...</h3>
        <p> press F5 to refresh the page </p>
        <a class="btn btn-default" href="{{ route('zuzanna.index') }}" role="button">start</a>
    </div>

@endsection
