@extends('layouts.app')

@section('content')

    <h1>{{ $application->name }}</h1>
    <div>{{ $application->message }}</div>
    @if ($application->closed == 1)
        <div>Закрытая заявка</div>
    @else
        <div>Открытая заявка</div>
    @endif

    <a href="/download?id={{ $application->id }}" class="btn btn-large pull-right"><font color="Blue">{{$application->file_name}}</font></a>

    @foreach ($application->comments as $comment)

        <div>{{$comment->comment}}</div>

    @endforeach
     
    @if ($application->closed == 0)
        <a href="{{ route('applications.comments.create', $application) }}"><font color="Blue">Ответить на заявку</font></a>
    @endif

@endsection