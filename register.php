<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["login"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["reppass"])) {
        echo "чето не так"; 
        exit();
    }

    if ($_POST["password"] !== $_POST["reppass"]) {
        echo "чето не так"; 
        exit();
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo "чето не так";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO users (login, email, password) VALUES (?, ?, ?)");

    // Убираем хеширование пароля
    $password = $_POST["password"];
    
    $stmt->bind_param("sss", $login, $email, $password);

    $login = $_POST["login"];
    $email = $_POST["email"];

    if ($stmt->execute()) {
        echo "успешно";
    } else {
        echo "чето не так"; 
    }

    $stmt->close();
}

$conn->close();
?>