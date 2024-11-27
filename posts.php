<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Бабушки на Лавочке</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
            cursor: pointer;
            float: right; 
            margin-top: 10px; 
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .header {
            position: relative; 
        }

    </style>
</head>
<body>
    <div class="header">
        <h1>Бабушки на Лавочке</h1>
        <a href="account.php" class="avatar">
            <?php
              $avatar = isset($_SESSION['user_avatar']) ? $_SESSION['user_avatar'] : 'default.jpg';
              echo "<img src='$avatar' alt='Аватар'>";
            ?>
        </a>
    </div>
    <div class="content">
        <div class="posts">
            <article>Пост 1</article>
            <article>Пост 2</article>
            <article>Пост 3</article>
        </div>
        <div class="login">
            <p>Вы вошли!</p>
            <a href="logout.php" class="gradient-button">Выйти</a>
        </div>
    </div>
</body>
</html>

