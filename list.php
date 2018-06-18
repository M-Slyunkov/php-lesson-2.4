<?php
    session_start();
    $id = $_SESSION['id'];
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
    <style>
        h1 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            margin: 15px auto;
        }
        td {
            border: 1px solid black;
            padding: 5px 15px;
        }
        .add {
            margin-left: 40%;
        }
    </style>
</head>
<body>
    <h1>Список тестов</h1>
    <table>
<?php
    $files = array_diff(scandir('tests/' ), Array( ".", ".." ));
    $counter = 1;

    foreach ($files as $file) {
        if (end(explode('.', $file)) === 'json') {
            $test = pathinfo($file)['filename'];
            echo '<tr><td>' . $counter . '</td><td><a href="test.php?name=' . $test . '">' . $test . '</a></td>';
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
                echo '<td><a href="delete.php?name=' . $test . '">Удалить тест</a></td>';
            }
            echo '</tr>';
            $counter++;
        }
    }

?>
    </table>
<?php
if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
    echo '<a class="add" href="admin.php">Добавить тест</a>';
}

?>
</body>
</html>