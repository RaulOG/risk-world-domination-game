<html>
<head>
	@include('layouts.partials.heads.head')
</head>

<body>
	<div class="container">

		<!--  THIS IS THE HEADER -->

		<header class="jumbotron">
        		<a href="{{ route('welcome') }}">
            			{{ HTML::image('images/logo.svg', 'logo', array('height' => 42, 'weight' => 42)) }}
        		</a>
			<h1>ANIMAL WORLD</h1>
			<p>creation and management</p>

			<!--  THIS IS THE USER OPTION PANEL -->
			<div class="well">
				<p>Signed in as Bl</p>
				<div class="container">
					<img src="images/user.png" height="60" width="60">
				</div>
				<a class="btn btn-default btn-sm" href="../" role="button">Log out</a>
			</div>

		</header>

    @yield('content')

    @section('scripts')
        {{ HTML::script('bower/jquery/dist/jquery.min.js') }}
        {{ HTML::script('bower/bootstrap/dist/js/bootstrap.min.js') }}
    @show
</div>
</body>
</html>
