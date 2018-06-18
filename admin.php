<?php
if(!isset($_COOKIE['login']) || !isset($_COOKIE['password'])) {
    header('HTTP/1.1 403 Forbidden');
    exit;
}
if (isset($_FILES['testFile'])) {
    if (is_uploaded_file($_FILES['testFile']['tmp_name'])) {
        $uploaddir = 'tests/';
        $uploadfile = $uploaddir . basename($_FILES['testFile']['name']);

        if (end(explode('.', $_FILES['testFile']['name'])) === 'json') {

            if ($_FILES['testFile']['error'] === UPLOAD_ERR_OK && move_uploaded_file($_FILES['testFile']['tmp_name'], $uploadfile)) {
                header('Location: list.php');
                exit;
            }
        }
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка тестов</title>
    <style>
        form {
            text-align: left;
            width: 30%;
            margin: 10% auto;
        }
        input {
            display: block;
            margin-bottom: 10px;
        }
        a {
            margin-left: 35%;
        }
    </style>
</head>
<body>
<form action="" enctype="multipart/form-data" method="post">
    <p>Загрузите тест в формате json:</p>
    <input type="hidden" name="MAX_FILE_SIZE" value="10000">
    <input type="file" name="testFile">
    <input type="submit" value="Загрузить тест" name="submit">
</form>



</body>
</html>

