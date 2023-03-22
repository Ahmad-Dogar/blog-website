@extends('layouts.app')

@section('content')
<h1>
    Contact Page
</h1>
@if (count($array) > 0)
    <ul>
        @foreach ($array as $values)
            <li>{{$values}}</li>
        @endforeach
    </ul>
@endif
@endsection