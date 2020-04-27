@extends('layouts.app')

@section('content')

    <h1>{{$application->name}}</h1>
    <div>{{$application->message}}</div>

    @can('update', $order)
        <a href="{{ route('orders.edit', $order) }}">Редактировать</a>
    @endcan
    
@endsection