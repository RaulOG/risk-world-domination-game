<html>
<head>
    @include('layouts.partials.heads.head')
</head>

<body>
    <div class="container">
        <header class="jumbotron">
            <a href="{{ route('landing') }}">
                {{ HTML::image('images/logo.svg', 'logo') }}
            </a>
            <h1>RISK</h1>
            <p>A world domination game</p>
        </header>

        @yield('content')

        @section('scripts')
        {{ HTML::script('bower/jquery/dist/jquery.min.js') }}
        {{ HTML::script('bower/bootstrap/dist/js/bootstrap.min.js') }}
        @show
    </div>
</body>
</html>
