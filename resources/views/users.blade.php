<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <x-head></x-head>
    <title>Все пользователи</title>
</head>
<body>
<x-header></x-header>
<div class="main-content">
    <h6>Чтобы изменить роль пользователя, нажмите на нее.</h6>
    <table class="table">
        @foreach ($users as $user)
        <tr>
            <td>{{$user->login}}</td>
            @if ($user->id === Auth::user()->id)
            <td><input type="submit" class="btn btn-secondary"
                                                            title="Вы не можете изменить роль своей учетной записи"
                                                            disabled value="Администратор" style="pointer-events: auto;"></td>
            @else
            <td>
                <form method="post" action="/users/{{$user->id}}/role" th:switch="${user.role}">
                    @switch($user->role)
                    @case('USER')
                    <span>
                        <input type="hidden" name="admin" value="true">
                        <input type="submit" class="btn btn-secondary" value="Пользователь">
                    </span>
                    @break
                    @case('ADMIN')
                    <span>
                        <input type="hidden" name="admin" value="false">
                        <input type="submit" class="btn btn-primary" value="Администратор">
                    </span>
                    @endswitch
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>