<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <x-head></x-head>
    <title>Настройки профиля</title>
</head>
<body>
<x-header></x-header>
<div class="main-content">
        <h5>Сменить пароль</h5>
        <form action="/settings/password" method="post" style="max-width: 290px">
            <label>Старый пароль</label>
            <input name="oldPassword" type="password" class="form-control" required><br>
            <label>Новый пароль</label>
            <input name="newPassword" type="password" class="form-control" required><br>
            @if (isset($passwordIsWrong))
            <div style="color: red">Неверный пароль</div>
            @endif
            @if (isset($passwordChanged))
            <div style="color: green">Пароль изменен</div>
            @endif

            <br>
            <input type="submit" value="Сменить" class="btn btn-primary">

        </form>
</div>
</body>
</html>