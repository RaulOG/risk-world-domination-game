<html>
<head>
    @include('layouts.partials.heads.head')
</head>
<body>
<div class="container">
	<header class="jumbotron">
		<img src="images/logo.svg" alt="logo" height="42" width="42">
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