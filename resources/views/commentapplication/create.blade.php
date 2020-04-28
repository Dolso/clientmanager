@extends('layouts.app')


@section('content')
    {{ Form::model($comment, ['url' => route('applications.comments.store', $application)]) }}
		{{ Form::label('comment', 'Комментарий') }}
		{{ Form::textarea('comment') }}<br>
	    {{ Form::submit('Ответить на заявку') }}
    {{ Form::close() }}
@endsection