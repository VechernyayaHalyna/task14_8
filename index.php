<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Путешествие на Бали</title>
</head>

<body>
    <?php
    session_start();
    include_once 'user.php';
    include_once 'head.php';

    
    $login = getCurrentUser();
    $regdate = getUserRegDate() * 1;
    
    $birthday = getUserBirthday($login);
    if ($birthday) {
        $dbd = getdate(strtotime($birthday));
        $dn = getdate();
        if ($dn['yday'] > $dbd['yday']) {
            $bdDayCount = 365 - ($dn['yday'] - $dbd['yday']);
        } else {
            $bdDayCount = $dbd['yday'] - $dn['yday'];
        }
    } else {
        $bdDayCount = null;
    }

    ?>
    <main>
        <div class="page-content">
            <div class="main-header content-block">
                <div style="flex: 1; margin: 0; text-align: center;">
                    <img src="images/bali.png" width="100px">
                </div>
                <div style="flex: 2; margin-left: 20px"" >
                    <p><strong><span style=" font-size: x-large; color: #adad14;">+7987 005 98 65</span></strong></p>
                    <p><strong><span style="font-size: x-large; color: #adad14;">+7987 004 87 54</span></strong></p>
                    <p></p>
                    <p><span style="color: #adad14; font-size: medium;"><strong>9:00-23:00</strong></span></p>
                    <p></p>
                    <p style="text-align: center;">
                        <span style="text-decoration: underline;">
                            <a href="https://www.facebook.com/" target="_blank" rel="noopener"><img style="border: 0px none; vertical-align: middle; margin: 10px; float: left;" src="images/facebook-256-1.png" alt="" width="25" height="25"></a>
                            <a href="https://www.youtube.com/" target="_blank" rel="noopener"><img style="border: 0px none; vertical-align: middle; margin: 10px; float: left;" src="images/youtube-256-1.png" alt="" width="25" height="25"></a>
                            <a href="https://twitter.com/" target="_blank" rel="noopener"><img style="border: 0px none; vertical-align: middle; margin: 10px; float: left;" src="images/twitter-256-1.png" alt="" width="25" height="25"></a>
                            <a href="https://www.instagram.com/" target="_blank" rel="noopener"><img style="border: 0px none; vertical-align: middle; margin: 10px; float: left;" src="images/instagram-256-1.png" alt="" width="25" height="25"></a>
                    </p>
                    <p></p>

                </div>
            </div>
            <div class="content">
                <div class="side-content content-block">
                    <a class="side-content-item" href="/">Наш СПА</a>
                    <a class="side-content-item" href="/">Наша Сауна</a>
                    <a class="side-content-item" href="/">Наши услуги</a>
                    <a class="side-content-item" href="/">Записаться</a>
                    <a class="side-content-item" href="/">Купить подарочный сертификат</a>
                </div>
                <div class="main-content ">
                    <div id="action_content" class="main-content-item content-block" style="display: none;">
                        <h2 style="text-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.5);">Бонус каждому новому клиенту: массаж лица в подарок</h2><br>
                        <hr>
                        <img src="images/face.jpg" alt="Акция для новых клиентов" style="width: 100%;">
                        <div class="slide-text text-bottom">
                            <span style="font-size: 16px;">Для использования бонуса свяжитесь с администратором салона в течении <span id="act_time">0 часов 5 минут 10 секунд</span>
                            </span>
                        </div>
                    </div>
                    <?php 
                    if ($login && !$birthday) { ?>
                        <div id="set_birthday" class="main-content-item content-block">
                            <img src="images/birthday.jpg" alt="День рождения" style="width: 100%;">
                            <div class="slide-text text-top">
                                <span style="font-size: 16px;">Укажите <a href="profile.php">дату рождения в своем профиле</a> чтобы получить притный сюрприз к празднику!</span>
                                </span>
                            </div>
                        </div>
                    <?php  }

                    
                    if ($login && !is_null($bdDayCount) && ($bdDayCount === 0)) {
                    ?>
                        <div id="birthday_content" class="main-content-item content-block">
                            <h2>Сердечно поздравляем с Днем рождения!</h2><br>
                            <hr>
                            <img src="images/actionl.png" alt="Подарочный сертификат" style="width: 100%;">
                            <div class="slide-text text-bottom">
                                <span style="font-size: 16px;">Ваш подарок - любая программа нашего салона на выбор. Для активации сертификата свяжитесь с администратором салона в течении недели со дня рождения</span>
                                </span>
                            </div>
                        </div>
                    <?php } elseif ($login && $bdDayCount) 
                    {
                    ?>
                        <div class="main-content-item content-block">
                            До Вашего Дня рождения 
                            <?= $bdDayCount ?> дн.
                        </div>
                    <?php } ?>
                    <div class="main-content-item content-block">
                        <img src="images/new.jpg" alt="Новые услуги" style="width: 100%;">
                        <div class="slide-text text-top">
                            <span style="font-size: 16px;">Новая услуга нашего салона: Релаксация для молодых мам. Оставьте ребенка на родителей и подарите себе несколько часов блаженства - полный пакет СПА-услуг.
                            </span>
                        </div>
                    </div>
                    <div class="main-content-item content-block">
                        <h2>СПА для пар </h2><br>
                        <div style="display: flex; margin: 0 10px;">
                            <img src="images/2x2.jpg" alt="СПА для двоих" style="width: 40%;">
                            <span style="margin: 0 10px;">Уникальная услуга - СПА для пар, приводите вторую половинку и окунитесь в мир отдыха вместе!
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                
                let actionContent = document.querySelector('#action_content');
                let clock = document.querySelector('#act_time');

                let userRegDate = <?= $regdate ?>;
                userRegDate += 24 * 3600;

                if ((Date.now() / 1000) < userRegDate) {

                    window.setInterval(function() {
                        let actTime = userRegDate - Date.now() / 1000;
                        let hours = Math.trunc(actTime / 3600);
                        let minutes = Math.trunc((actTime - hours * 3600) / 60);
                        let seconds = Math.trunc(actTime - hours * 3600 - minutes * 60);
                        clock.innerHTML = hours + ' ч. ' + minutes + ' мин. ' + seconds + ' сек.';
                    }, 1000);
                    actionContent.style.display = '';
                } else {
                    actionContent.style.display = 'none';
                }
            </script>

            <div class="footer content-block">
                <div class="links">
                    <a href="#">Сотрудничество</a>
                    <a href="#">Наши контакты</a>
                    <a href="#">О нас</a>
                </div>
                <div class="copyright">
                    Copyright © Bali 2022
                </div>
            </div>
        </div>
    </main>
	<script src="js/script.js"></script>
</body>

</html>