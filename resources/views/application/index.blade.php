@extends('layouts.app')

@if (Session::has('flash_message'))
    <font color="Red">{{ Session::get('flash_message') }}</font>
@endif

@section('content')
    <div class="container">
        <h1>Список заявок</h1>
        <a href=" {{ route('applications.create') }}"><h3>Создать заявку</h3></a>
        @foreach ($applications as $application)   
            <div class="card mb-3" style="max-width: 50rem;">
                <div class="card-header">
                    @if ($application->closed == 1)
                        <div>Заявка закрыта</div>
                    @elseif ($application->id_accepted != null)
                        <div>Заявка принята</div>
                    @else
                        <div>Заявка открыта</div>
                    @endif
                </div>  
                <div class="card-body text-dark">  
                    <a href= "{{route('applications.show', $application)}}" >
                        <h3 class="card-title">{{$application->topic}}</h3>
                    </a>
                    <p class="card-text">{{$application->message}}</p>
                </div>  
            </div>          
        @endforeach
    </div>
@endsection