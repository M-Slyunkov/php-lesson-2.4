<?php
session_start();
$id = $_SESSION['id'];
if (!file_exists(__DIR__ . '/tests/' . $_GET["name"] . '.json')) {
    header('HTTP/1.1 404 Not Found');
    exit;
}
$testFile = '/tests/' . $_GET["name"] . '.json';
$test = json_decode(file_get_contents(__DIR__ . $testFile));

if(isset($_COOKIE['authorized'])) {
        $username = $_COOKIE['id'];
        echo $username;
    }
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
    <style>
        fieldset {
            width: 40%;
            margin: 0 auto 20px;
            padding: 10px;
        }
        input[type="radio"] {
            margin-left: 15px;
        }
        input[type="submit"] {
            margin-left: 30%;
        }
        p {
            margin-left: 30%;
        }
    </style>
</head>
<body>
<form method="post" action="src/filled-cert.php">
    <input type="hidden" name="myName" value="<?= $id ?>">
    <input type="hidden" name="testFile" value="<?= $testFile ?>">
    <?php

    if (!empty($_GET["name"])) {

        foreach($test->questions as $question) {
            echo '<fieldset>';
            echo '<h3>' . $question->question . '</h3>';
            foreach($question->choices as $key => $choice) {
                echo '<label><input type="radio" value="' . $key . '" name="' . $question->id . '">'. $choice . '</label>';
            }
            echo '</fieldset>';
        }
    }
    ?>
    <input type="submit" value="Принять ответы">
</form>
</body>
</html>
