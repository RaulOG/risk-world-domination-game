@extends('layouts/unlogged')

@section('title', 'World Manager')

@section('content')

        <!--  THIS IS THE MAIN CONTENT -->

<div>
    <h2>
        Hello Animal Lover!
    </h2>
</div>

<!--  LOG IN  -->

<div class="well">
    <h3>
        Log in
    </h3>
    <form role="form">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd">
        </div>
        <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
        </div>
        <a class="btn btn-success btn-lg" href="welcome" role="button">Log in</a>
        <!--   for now we need this, but later we can use submit <button type="submit" class="btn btn-default">Submit</button> -->
    </form>
</div>

<!--  SIGN IN  -->

<div class="container">
    <h3>
        New in here?
    </h3>

    <!-- Trigger the sign in modal with a button -->
    <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal">Sign in</button>

    <!-- Sign in Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Sign in Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create a new account</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="username" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox"> Remember me</label>
                        </div>
                        <a class="btn btn-success btn-lg" href="welcome" role="button">Create an account and log in</a>
                        <!--   for now we need this, but later we can use submit <button type="submit" class="btn btn-default">Submit</button> -->
                    </form>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection