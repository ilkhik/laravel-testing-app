<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <x-head></x-head>
    <title>Все тесты</title>
</head>
<body>
<x-header></x-header>
<div class="main-content">
    @if (Auth::user()->role === 'ADMIN')
    <h6><a href="/tests/create">Создать новый тест</a></h6>
    @endif
    <h4>Список всех тестов:</h4>
    <ul>
        @foreach ($tests as $test)
        <li><a href="/tests/{{$test->id}}">{{$test->title}}</a></li>
        @endforeach
    </ul>
</div>
</body>
</html>