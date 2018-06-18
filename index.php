<?php

if (isset($_COOKIE['login'])) {
    setcookie('login', '', time()-1);
}
if (isset($_COOKIE['password'])) {
    setcookie('password', '', time()-1);
}

$userList = json_decode(file_get_contents('{login}.json'));

if(isset($_POST['submit'])) {
    session_start();

    if (!file_exists('{login}.json')) {
        echo 'Файл {login} не найден';
        exit;
    }

    $login = $_POST['login'];
    $password = $_POST['password'];

    if($password !== '') {

        foreach ($userList->users as $user) {
            if ($login === $user->login && md5($password) === md5($user->password)) {
                    setcookie('login', $user->login, time() + 60 * 60);
                    setcookie('password', md5($user->password), time() + 60 * 60);
                    $_SESSION['id'] = $user->login;
                    header('Location: list.php');
                    exit;
            }
        }

        echo 'Имя пользователя и пароль не совпадают. Попробуйте еще раз.';
    } else {
        $_SESSION['id'] = $login;
        header('Location: list.php');
        exit;
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <style>
        h3 {
            text-align: center;
        }
        form {
            width: 20%;
            border: 1px solid black;
            padding: 20px;
            margin: 20px auto;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<h3>Авторизуйтесь или войдите как гость, введя только имя:</h3>
<form method="post">
    <label>Ваше имя <input name="login" required></label>
    <label>Пароль <input type="password" name="password"></label>
    <input type="submit" name="submit" value="Войти">
</form>
</body>
</html>
