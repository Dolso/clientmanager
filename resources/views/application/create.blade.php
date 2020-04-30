@extends('layouts.app')


@section('content')

	@if (Session::has('flash_message'))
		<font color="Red">{{ Session::get('flash_message') }}</font>
	@endif
    <a href="{{ route('applications.index') }}"><h3>Мой список заявок</h3></a>
    {{ Form::model($application, ['url' => route('applications.store'), 'files' => 'true']) }}
        {{ Form::label('topic', 'Тема') }}
		{{ Form::text('topic') }}<br>
		{{ Form::label('message', 'Сообщение') }}
		{{ Form::textarea('message') }}<br>
		{{ Form::file('file') }}
	    {{ Form::submit('Добавить заявку') }}
    {{ Form::close() }}
@endsection