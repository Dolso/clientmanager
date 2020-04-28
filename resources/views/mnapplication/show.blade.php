@extends('layouts.app')

@section('content')

    <h1>{{ $application->name }}</h1>
    <div>{{ $application->message }}</div>
    @if ($application->closed == 1)
        <div>Закрытая заявка</div>
    @else
        <div>Открытая заявка</div>
    @endif
    <a href="/download?id={{ $order->id }}" class="btn btn-large pull-right"><font color="Blue">{{$order->file}}</font></a> 
    {{ Form::model($application, ['url' => route('manager.applications.update'), 'method' => 'PATCH']) }}
        {{ Form::submit('Принять заявку') }}
    {{ Form::close() }}
@endsection