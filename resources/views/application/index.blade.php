<!-- Хранится в resources/views/about.blade.php -->

@extends('layouts.app')

<!-- Секция, содержимое которой обычный текст. -->

<!-- Секция, содержащая HTML блок. Имеет открывающую и закрывающую часть. -->
@section('content')
    <h1>Список заявок</h1>
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