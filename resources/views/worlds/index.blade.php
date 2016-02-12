@extends('layouts/logged')

@section('content')
    World index

    <p>
        <a href="{{ route('worlds.create') }}">Create World</a>
    </p>
@endsection