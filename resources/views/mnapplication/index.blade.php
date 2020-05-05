@extends('layouts.app')

@section('content')
    <div class="container">
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
					

				<button type="submit" class="btn btn-primary">Filter</button>
			</form>

		</aside>
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
					<a href= "{{route('manager.applications.show', $application)}}" >
					    <h3 class="card-title">{{$application->topic}}</h3>
					</a>
					<p class="card-text">{{$application->message}}</p>
				</div>  
			</div>
		@endforeach
	</div>
@endsection