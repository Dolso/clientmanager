@extends('layouts.app')

@section('content')

    <h1>{{$application->topic}}</h1>
    <div>{{$application->message}}</div>

    
@endsection