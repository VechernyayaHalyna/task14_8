<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Путешествие на Бали - Вход</title>
</head>

<body>
    <?php
    session_start();
    include_once 'user.php';
    include_once 'head.php';

    ?>
    <main>
        <div class="input-box login-box">
            <div class="login-box-title">Вход</div>
            <?php
            if (key_exists('error', $_REQUEST)) {
            ?>
                <div class="login-box-error">Вы ввели неправильный пароль. Попробуйте еще раз</div>
            <?php
            } else {
            ?>
                <div class="login-box-note">Если у вас нет аккаунта, <a href="register.php">зарегистрируйтесь</a>, чтобы получать бонусы и подарки!</div>
            <?php
            }
            ?>
            <form action="auth.php" method="post" class="login-form">
                <label for="login">Имя пользователя:</label>
                <input name="login" type="text" placeholder="..." class="inpt">
                <label for="password">Пароль:</label>
                <input name="password" type="password" placeholder="..." class="inpt">
                <input name="submit" type="submit" value="Войти" class="btn">
                <input name="button" type="button" value="Отмена" onclick="location='/'" class="btn">
            </form>
        </div>
    </main>
</body>

</html>
