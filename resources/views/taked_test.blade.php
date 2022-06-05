<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <x-head></x-head>
    <title th:text="${takedTest.test.title}">{{$takedTest->test->title}}</title>
    <script src="/js/jquery.min.js"></script>
</head>
<body>
<x-header></x-header>
<div class="main-content">
<h1><div>Вы прошли тест &#34;{{$takedTest->test->title}}&#34;. Набрано баллов: {{$takedTest->score}} из {{$takedTest->test->max_scores}}</div></h1>
<a href="/tests">Вернуться к списку тестов</a>
</div>
</body>
</html>