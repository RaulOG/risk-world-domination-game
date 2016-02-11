@extends('layouts/logged')

@section('title', 'World Manager')

@section('content')
	<div>
		<h2>
			Welcome again, Bl!
		</h2>
		<nav class="row">
  			<div class="col-sm-4"><a class="btn btn-default" href="worlds" role="button">VISIT WORLDS</a></div>
  			<div class="col-sm-4"><a class="btn btn-default" href="worlds" role="button">MANAGE WORLDS</a></div>
  			<div class="col-sm-4"><a class="btn btn-default" href="worlds" role="button">MANAGE USERS</a></div>
  		</nav>
	</div>
@endsection