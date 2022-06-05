<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">

    <title>Регистрация</title>
</head>
<body class="login-page">
<br>
<h5>Регистрация пользователя</h5><br>
<form action="/signup" method="post">
        <input placeholder="Логин" name="login" class="form-control" autofocus required><br>
        <input type="password" placeholder="Пароль" name="password" class="form-control" required><br>
        <input type="submit" value="Зарегистрироваться" class="btn btn-primary">
</form>
@if (session('error'))
<div style="color:red;">Пользователь с таким логином уже существует</div>
@endif
<br>
<a href="/login">Войти в аккаунт</a>
</body>
</html>