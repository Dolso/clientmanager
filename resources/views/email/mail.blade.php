<!DOCTYPE html>
<html>
<head>
	<title>Laravel Mail Queue Tutorial</title>
</head>
<body>
@if ($status == 'create_application')

<div>
	<h2>Была создана новая заявка</h2>
	<div><h4>{{$application->topic}}</h4></div>
	<div>{{$application->message}}</div>
	<dir>Ссылка: {{ route('manager.applications.show', $application) }}</dir>
</div>

@endif

@if ($status == 'close')

<div>
	<h2>Была закрыта заявка</h2>
	<div><h4>{{$application->topic}}</h4></div>
	<div>{{$application->message}}</div>
	<dir>Ссылка: {{ route('manager.applications.show', $application) }}</dir>
</div>  

@endif

@if ($status == 'comment_to_manager')

<div>
	<h2>Клиент ответил на свою заявку</h2>
	<div>Под заявкой</div>
	<div><h4>{{$application->topic}}</h4></div>
	<div>{{$application->message}}</div>
	<div>Клиент оставил ответ</div>
	<div>{{$comment->comment}}</div>
    <dir>Ссылка: {{ route('manager.applications.show', $application) }}</dir>
</div>
    
@endif

@if ($status == 'comment_to_client')

<div>
	<h2>Менеджер ответил на вашу заявку</h2>
	<div>Под заявкой</div>
	<div><h4>{{$application->topic}}</h4></div>
	<div>{{$application->message}}</div>
	<div>Менеджер оставил ответ</div>
	<div>{{$comment->comment}}</div>
	<dir>Ссылка: {{ route('applications.show', $application) }}</dir>
</div>
    
@endif


</body>
</html>