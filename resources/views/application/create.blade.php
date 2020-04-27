@extends('layouts.app')




@section('content')
	@if ($errors->any())
	    <div>
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
    {{ Form::model($application, ['url' => route('applications.store'), 'files' => 'true']) }}
        {{ Form::label('topic', 'Тема') }}
		{{ Form::text('topic') }}<br>
		{{ Form::label('message', 'Сообщение') }}
		{{ Form::textarea('message') }}<br>
		{{ Form::file('file') }}
	    {{ Form::submit('Добавить заявку') }}
    {{ Form::close() }}
@endsection