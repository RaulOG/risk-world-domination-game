<html>
<head>
    @include('layouts.partials.heads.head')
</head>

<body>
<div class="container">
    <header class="jumbotron">
        <a href="{{ route('welcome') }}">
            {{ HTML::image('images/logo.svg', 'logo', array('height' => 42, 'weight' => 42)) }}
        </a>
        <div class="h1">
            <h1>RISK</h1>
        </div>
        <p>A world domination game</p>

        <!--  THIS IS THE USER OPTION PANEL -->
        <div class="userPanel">
            <small>Signed in as {{ Auth::user()->name }}</small>
            <a class="btn btn-default btn-sm" href="{{ route('logout') }}" role="button">Log out</span></a>
        </div>

    </header>
    @include('partials.flash_messages')

    @yield('content')

    @section('scripts')
        {{ HTML::script('bower/jquery/dist/jquery.min.js') }}
        {{ HTML::script('bower/bootstrap/dist/js/bootstrap.min.js') }}
    @show

</div>
</body>
</html>
