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
        <h1>ANIMAL WORLD</h1>
        <p>creation and management</p>
        <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
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
