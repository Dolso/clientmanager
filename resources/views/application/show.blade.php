@extends('layouts.app')

@section('content')

    <h1>{{$application->topic}}</h1>
    <div>{{$application->message}}</div>

    @foreach ($application->comments as $comment)

        <div>{{$comment->comment}}</div>

    @endforeach

    @if ($application->closed == 0)

        <a href="{{route('applications.comments.create', $application)}}"><font color="Blue">Ответить на заявку</font></a>

    @endif

@endsection