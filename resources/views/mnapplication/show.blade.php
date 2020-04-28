@extends('layouts.app')

@section('content')

    <h1>{{ $application->name }}</h1>
    <div>{{ $application->message }}</div>
    @if ($application->closed == 1)
        <div>Закрытая заявка</div>
    @else
        <div>Открытая заявка</div>
    @endif
    <a href="/download?id={{ $application->id }}" class="btn btn-large pull-right"><font color="Blue">{{$application->file_name}}</font></a> 
@endsection