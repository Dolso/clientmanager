@extends('layouts.app')


@section('content')
    <div class="container">
		@if (Session::has('flash_message'))
			<font color="Red">{{ Session::get('flash_message') }}</font>
		@endif
		<a href="{{ route('applications.index') }}"><h3>Мой список заявок</h3></a>
		<div style="max-width: 40rem;">
			{{ Form::model($application, ['url' => route('applications.store'), 'files' => 'true']) }}
				{{ Form::label('topic', 'Тема', [ 'class' => 'control-label']) }}
				{{ Form::text('topic', '', [ 'class' => 'form-control' ]) }}<br>
				{{ Form::label('message', 'Сообщение', [ 'class' => 'control-label' ]) }}
				{{ Form::textarea('message', '', [ 'class' => 'form-control' ]) }}<br>
				{{ Form::file('file', [ 'class' => 'form-control-file' ]) }}
				{{ Form::submit('Добавить заявку', [ 'class' => 'btn btn-info' ]) }}
			{{ Form::close() }}
		</div>
	</div>
@endsection