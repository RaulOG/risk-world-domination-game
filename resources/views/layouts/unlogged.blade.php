<html>
<head>
    @include('layouts.partials.heads.head')
</head>
<body>
<div>
    @yield('content')

    @section('scripts')
        {{ HTML::script('bower/jquery/dist/jquery.min.js') }}
        {{ HTML::script('bower/bootstrap/dist/js/bootstrap.min.js') }}
    @show
</div>
</body>
</html>