<?php
require_once("config.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT login, avatar FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($login, $avatar);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newLogin = $_POST['login'];
    $newPassword = $_POST['password'];
    $uploadedAvatar = $_FILES['avatar'];

    if ($uploadedAvatar['error'] == 0) {
        $avatarPath = '/www/regmail.hgweb.ru/uploads/' . uniqid() . '.' . pathinfo($uploadedAvatar['name'], PATHINFO_EXTENSION);
        move_uploaded_file($uploadedAvatar['tmp_name'], $avatarPath);
    } else {
        $avatarPath = $avatar; // Если ошибка, оставляем старый аватар
    }

    $stmt = $conn->prepare("UPDATE users SET login = ?, password = ?, avatar = ? WHERE id = ?");
    $stmt->bind_param("sssi", $newLogin, $newPassword, $avatarPath, $userId);
    $stmt->execute();
    $stmt->close();

    header("Location: posts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настройки аккаунта</title>
    <link rel="stylesheet" href="styles.css"> <!-- Подключите ваш файл стилей -->
</head>
<body>
    <h1>Настройки аккаунта</h1>
    <form method="POST" enctype="multipart/form-data">
        <div>
            <label for="login">Логин:</label>
            <input type="text" name="login" id="login" value="<?php echo htmlspecialchars($login); ?>" required>
        </div>
        <div>
            <label for="password">Новый пароль:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="avatar">Аватар:</label>
            <input type="file" name="avatar" id="avatar">
        </div>
        <button type="submit">Сохранить изменения</button>
    </form>
    <div>
        <h2>Ваш текущий аватар:</h2>
        <img src="<?php echo htmlspecialchars($avatar); ?>" alt="Аватар" width="100">
    </div>
</body>
</html>