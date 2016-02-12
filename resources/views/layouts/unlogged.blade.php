<html>
<head>
    @include('layouts.partials.heads.head')
</head>

<body>
<div class="container">

    <!--  THIS IS THE HEADER -->

    <header class="jumbotron">
        <a href="{{ route('landing') }}">
            {{ HTML::image('images/logo.svg', 'logo', array('height' => 42, 'weight' => 42)) }}
        </a>
        <h1>ANIMAL WORLD</h1>
        <p>creation and management</p>
    </header>

    @yield('content')

    @section('scripts')
        {{ HTML::script('bower/jquery/dist/jquery.min.js') }}
        {{ HTML::script('bower/bootstrap/dist/js/bootstrap.min.js') }}
    @show
</div>
</body>
</html>