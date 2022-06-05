<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <x-head></x-head>
    <title>{{$user->login}}</title>
</head>
<body>
<x-header></x-header>
<div class="main-content">

    <h1>Профиль: {{$user->login}}</h1>

    <div>Дата регистрации: {{$signupDate}}</div>

    <a href="/settings">Настройки профиля</a>

    @if ($user->role === 'ADMIN')
    <h6>У Вас учетная запись администратора. <a
            href="/users">Показать всех пользователей</a></h6>
    @endif

    @if ($user->test_passed_number === 0)
    <div>
        У Вас пока нет пройденных тестов
    </div>
    @else
    <div>
        <div>Количество пройденных тестов: {{$user->test_passed_number}}</div>
        <div>Всего набрано баллов: {{$user->score_sum}} из {{$user->score_max_sum}}</div>
        <br>
        <h5>Вами пройденные тесты:</h5>
        <table class="table">
            <tr>
                <td>Название</td>
                <td>Набрано баллов</td>
                <td>Максимальное количество баллов</td>
            </tr>

            @foreach ($takedTests as $takedTest)
            <tr>
                <td><a href="/tests/{{$takedTest->test_id}}">{{$takedTest->test->title}}</a></td>
                <td>{{$takedTest->score}}</td>
                <td>{{$takedTest->test->max_scores}}</td>
            </tr>
            @endforeach

        </table>
    </div>
    @endif
</div>
</body>
</html>