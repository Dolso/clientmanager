@extends('layouts.app')

@section('content')
	@can('manager-index-application')
        <a href="{{ route('manager.applications.index') }}"><h3>Cписок заявок</h3></a>
    @endcan
    @can('client-index-application')
        <a href="{{ route('applications.index') }}"><h3>Мой список заявок</h3></a>
    @endcan
    {{ Form::model($comment, ['url' => route('applications.comments.store', $application)]) }}
		{{ Form::label('comment', 'Комментарий') }}
		{{ Form::textarea('comment') }}<br>
	    {{ Form::submit('Ответить на заявку') }}
    {{ Form::close() }}
@endsection