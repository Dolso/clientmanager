@extends('layouts.app')

@section('content')

    <a href="{{ route('manager.applications.index') }}"><h3>Список заявок</h3></a>
    <h1>{{ $application->name }}</h1>
    <div>{{ $application->message }}</div>
    @if ($application->closed == 1)
        <div><h3>Заявка закрыта</h3></div>
    @endif

    <a href="/download?id={{ $application->id }}" class="btn btn-large pull-right"><font color="Blue">{{$application->file_name}}</font></a>
    @if ($application->closed == 0 ?? $application->id_accepted == null)
        <div>
            {{ Form::model($application, ['url' => route('manager.applications.update', $application), 'method' => 'PATCH']) }}
                {{ Form::label('accept', 'Напишите "принять", для того чтобы закрыть заявку') }}<br>
                {{ Form::text('accept') }}<br>
                {{ Form::submit('Принимаю') }}
            {{ Form::close() }}
        </div>
    @endif

    <div>
        <h4>Ответы на заявку</h4>
    </div>

    @foreach ($application->comments as $comment)

        <div>{{$comment->comment}}</div>

    @endforeach
     
    @if (($application->closed == 0 ) && ($application->id_accepted != null))
        <a href="{{ route('applications.comments.create', $application) }}"><font color="Blue">Ответить на заявку</font></a>
    @endif

@endsection