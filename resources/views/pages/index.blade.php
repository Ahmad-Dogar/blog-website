@extends('layouts.app')

@section('content')

<div class="container bg-dark p-4 mt-4 text-white">
<div class="row text-center">
<h2 class="mb-4">Main Page </h2>
<div class="col-lg-6 text-end"><a href="/register" class="btn btn-primary">Register Button</a></div>
<div class="col-lg-6 text-start"><a href="/login" class="btn btn-success">Login Now</a></div>
</div>
</div>
@endsection