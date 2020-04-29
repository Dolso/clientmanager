@extends('layouts.app')

@section('content')

    <h1>{{$application->topic}}</h1>
    <div>{{$application->message}}</div>
    <a href="/download?id={{ $application->id }}" class="btn btn-large pull-right"><font color="Blue">{{$application->file_name}}</font></a>
    @if ($application->closed == 1)
        <div><h3>Заявка закрыта</h3></div>
    @endif
	@if ($application->closed == 0)
        <div>
            {{ Form::model($application, ['url' => route('applications.update', $application), 'method' => 'PATCH']) }}
                {{ Form::label('closed', 'Напишите "закрыть", для того чтобы закрыть заявку') }}<br>
    			{{ Form::text('closed') }}<br>
    		    {{ Form::submit('Принимаю') }}
            {{ Form::close() }}
        </div>
    @endif
    <div>
        <h4>Ответы на заявки</h4>
    </div>
    @foreach ($application->comments as $comment)

        <div>{{$comment->comment}}</div>

    @endforeach
    
    

    @if (($application->closed == 0) && ($application->id_accepted != null))

        <a href="{{route('applications.comments.create', $application)}}"><font color="Blue">Ответить на заявку</font></a>

    @endif

@endsection