@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <a href="{{ route('applications.index') }}"><h3>Мой список заявок</h3></a>

            <h1>{{$application->topic}}</h1>

            <div>{{$application->message}}</div>

            <a href="/download?id={{ $application->id }}" class="btn btn-large pull-right"><font color="Blue">{{$application->file_name}}</font></a>

            @if ($application->closed == 1)
                <div><h3>Заявка закрыта</h3></div>
            @endif

            @if ($application->closed == 0)
                <div style="max-width: 25rem;">
                    {{ Form::model($application, ['url' => route('applications.update', $application), 'method' => 'PATCH'], [ 'class' => 'form-group' ]) }}
                        {{ Form::label('closed', 'Напишите "закрыть", для того чтобы закрыть заявку', [ 'class' => 'control-label' ]) }}<br>
                        {{ Form::text('closed', '', [ 'class' => 'form-control' ]) }}<br>
                        {{ Form::submit('Принимаю') }}
                    {{ Form::close() }}
                </div>
            @endif

        </div>

        <div class="container">
            <h4>Ответы на заявку</h4>
        
            @foreach ($application->comments as $comment)
                <div>{{$comment->comment}}</div>
            @endforeach
                       
            @if (($application->closed == 0) && ($application->id_accepted != null))
                <a href="{{route('applications.comments.create', $application)}}"><font color="Blue">Ответить на заявку</font></a>
            @endif
        </div>
    </div>

@endsection