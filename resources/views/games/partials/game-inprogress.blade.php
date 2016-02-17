@extends('layouts/logged')

@section('content')

    <div class="container">
        <h2>Game in progress</h2>
    </div>

    <div>
        <h2>
            Go for it, {{ Auth::user()->name }}!
        </h2>
        <div class="container row">
            <div class="col-md-6">
                <p>{{ Auth::user()->name }}</p>
                <div class="player-host">
                    <p>number of troops</p>
                    <h4>5</h4>
                </div>
            </div>
            <div class="col-md-6">
                <p>your opponent</p>
                <div class="player-guest">
                    <p>number of troops</p>
                    <h4>5</h4>
                </div>
            </div>
        </div>
    </div>

@endsection
