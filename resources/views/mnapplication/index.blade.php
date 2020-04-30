<!-- Хранится в resources/views/about.blade.php -->

@extends('layouts.app')

<!-- Секция, содержимое которой обычный текст. -->

<!-- Секция, содержащая HTML блок. Имеет открывающую и закрывающую часть. -->
@section('content')
    
    <a href="{{ route('manager.applications.index') }}"><h1>Список заявок</h1></a>

    <aside>

	    <form action="{{ route('manager.applications.index') }}">
	    
	    	<div class="form-group">

	            <label for="is_active" class="from-control">Открытые или закрытые заявки</label>

	            <select name="closed">

	            	<option value="0" {{ request()->closed == '0' ? 'selected' : ''}} > Открытые </option>
	            	<option value="1" {{ request()->closed == '1' ? 'selected' : ''}} > Закрытые </option>

	            </select>

	    	</div>

	    	<div class="form-group">

	            <label for="is_active" class="from-control">Ответили ли вы на заявку</label>

	            <select name="answered">

	            	<option value="1" {{ request()->answered == '1' ? 'selected' : ''}} > Ответил </option>
	            	<option value="0" {{ request()->answered == '0' ? 'selected' : ''}} > Не ответил </option>

	            </select>

	    	</div>

	    	<div class="form-group">

	            <label for="is_active" class="from-control">Просмотренные или нет</label>

	            <select name="viewed">

	            	<option value="1" {{ request()->viewed == '1' ? 'selected' : ''}} > Просмотрена </option>
	            	<option value="0" {{ request()->viewed == '0' ? 'selected' : ''}} > Непросмотрена </option>

	            </select>

	    	</div>
	    		
	    	</div>

	        <button type="submit" class="btn btn-primary">Filter</button>
	    </form>

    </aside>
    @foreach ($applications as $application)
        <a href= "{{ route('manager.applications.show', $application)}}" ><h2>{{$application->topic}}</h2></a>
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