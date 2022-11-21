<?php

include_once 'user.php';

$login = getCurrentUser();

?>
<div class="topnav">
    <div class="page_title">Путешествие на Бали</div>
    <div class="user_name">
        <a href=<?php
                if (!$login) {
                    echo '"login.php">Войти';
                } else {
                    echo '"profile.php">' . $login;
                }
                ?> </a>
    </div>
    <div class="top_menu_btn">
        <a id="btnLink" href="javascript:void(0);" class="dropbtn barbtn">
            <i class="fa fa-bars barbtn"></i>
        </a>
    </div>
</div>

<div id="myDropdown" class="dropdown-content">
    <h3 class="widget-title">Наши услуги</h3>
    <ul class="widget-list">
        <li><a href="/">Релаксация</a></li>
        <li><a href="/">Оздоровливающие процедуры</a></li>
        <li><a href="/">Процедуры красоты</a></li>
        <li><a href="/">Акции</a></li>
        <li><a href="/">Магазин</a></li>
    </ul>
    <p></p>
    <h3 class="widget-title">О нас</h3>
    <ul class="widget-list">
        <li><a href="/">Наши салоны</a></li>
        <li><a href="/">Лицензия</a></li>
    </ul>
    <p></p>
    <h3 class="widget-title">О Вас</h3>
    <ul class="widget-list">
        <?php if ($login) { ?>
            <li><a href="profile.php">Ваш профиль</a></li>
            <li><a href="auth.php?logoff">Выйти</a></li>
        <?php } else { ?>
            <li><a href="login.php">Войти</a></li>
        <?php } ?>
    </ul>
</div>
<script src="../js/head.js"></script>


