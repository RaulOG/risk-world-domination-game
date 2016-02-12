@extends('layouts/logged')

@section('content')
    @unless($users->count())
        There are no users
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            {{ Form::open(['url' => 'users/'.$user->id, 'method' => 'put']) }}
                            <button type="submit">Edit</button>
                            {{ Form::close() }}

                            {{ Form::open(['url' => 'users/'.$user->id, 'method' => 'delete']) }}
                            <button type="submit">Delete</button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endunless

            {{--@forelse($users as $user)
                <li>{{ $user->name }}</li>
            @empty
                <p>No users</p>
            @endforelse--}}
@endsection