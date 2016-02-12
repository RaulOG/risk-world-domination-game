@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if (Session::has('alert'))
    <div class="alert alert-info">{{ Session::get('alert') }}</div>
@endif

@if (Session::has('error'))
    <div class="alert alert-warning">{{ Session::get('error') }}</div>
@endif