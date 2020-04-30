@extends('layouts.app')

@if (Session::has('flash_message'))
    <font color="Red">{{ Session::get('flash_message') }}</font>
@endif

@section('content')
    <h1>Список заявок</h1>
    <a href=" {{ route('applications.create') }}"><h3>Создать заявку</h3></a>
    @foreach ($applications as $application)
        <a href= "{{route('applications.show', $application)}}" ><h2>{{$application->topic}}</h2></a>
        <div>{{Str::limit($application->message, 200)}}</div>
        <div>
            @if ($application->closed == 1)
                <div>Заявка закрыта</div>
            @elseif ($application->id_accepted != null)
                <div>Заявка принята</div>
            @endif
        </div>
    @endforeach
@endsection