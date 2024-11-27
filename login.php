<?php
require_once("config.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка соединения с базой данных: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE login = ?");
    if (!$stmt) {
        die("Ошибка подготовки запроса: " . $conn->error);
    }
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($id, $db_password); // Изменено: теперь получаем нехешированный пароль
    $stmt->fetch();
    $stmt->close();

    if ($id) {
        if ($password === $db_password) { // НЕЗАЩИЩЕННОЕ сравнение паролей!
            $_SESSION["user_id"] = $id;
            header("Location: posts.php");
            exit();
        } else {
            echo "Неверный пароль";
        }
    } else {
        echo "Неверный логин";
    }
}

$conn->close();
?>