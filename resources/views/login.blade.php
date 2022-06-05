<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">

    <title>Войти</title>
</head>
<body class="login-page">
<br>
<h5>Войдите в систему или зарегистрируйтесь</h5><br>
<form action="/login" method="post">
    <input placeholder="Логин" name="login" class="form-control" autofocus required><br>
    <input type="password" placeholder="Пароль" name="password" class="form-control" required><br>
    @if (session('error'))
    <div style="color:red">Неверный логин или пароль</div>
    @endif
    <br>
    <input type="submit" value="Войти" class="btn btn-primary">
</form>
<br>
<a href="/signup">Регистрация</a>
</body>
</html>