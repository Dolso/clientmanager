@extends('layouts.app')

@section('content')

    <h1>{{$application->topic}}</h1>
    <div>{{$application->message}}</div>
    <a href="/download?id={{ $application->id }}" class="btn btn-large pull-right"><font color="Blue">{{$application->file_name}}</font></a>
	@if ($application->closed == 0)
        {{ Form::model($application, ['url' => route('applications.update', $application), 'method' => 'PATCH']) }}
            {{ Form::label('closed', 'Напишите "закрыть", для того чтобы закрыть заявку') }}<br>
			{{ Form::text('closed') }}<br>
		    {{ Form::submit('Принимаю') }}
        {{ Form::close() }}
    @endif
    <h4>Ответы на заявки</h4>
    @foreach ($application->comments as $comment)

        <div>{{$comment->comment}}</div>

    @endforeach
    
    

    @if ($application->closed == 0)

        <a href="{{route('applications.comments.create', $application)}}"><font color="Blue">Ответить на заявку</font></a>

    @endif

@endsection