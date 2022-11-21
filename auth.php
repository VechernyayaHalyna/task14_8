<?php

session_start();
require_once 'user.php';

if (!empty($_REQUEST)) {
    
    if (key_exists('profile', $_POST)) {
        if (key_exists('login', $_POST)) {
            $login = $_POST['login'];
            if (key_exists('fullname', $_POST)) {
                $fullname = $_POST['fullname'];
            }
            if (key_exists('birthday', $_POST)) {
                $birthday = $_POST['birthday'];
            }
            
            saveUserProfile($login, $fullname, $birthday);

            header('Location: /');
        }
        die('Ошибка сохранения профиля пользователя');
    }
    
    elseif (key_exists('register', $_POST)) {
        if (key_exists('login', $_POST)) {
            $login = $_POST['login'];
            if (key_exists('password', $_POST)) {
                $password = $_POST['password'];
                
                if (addUser($login, $password)) {
                    
                    if (loginUser($login, $password)) {
                        header('Location: /');
                    }
                }
            }
            die('Ошибка регистрации пользователя');
        }
        die('Ошибка регистрации пользователя');
    }
    
    elseif (key_exists('login', $_POST)) {
        $login = $_POST['login'];
        if (key_exists('password', $_POST)) {
            $password = $_POST['password'];
            
            if (loginUser($login, $password)) {
                header('Location: /');
            } else {

                if (existsUser($login)) {
                    header('Location: login.php?error');
                } else {
                    header('Location: register.php?login=' . $login);
                }
            }
        }
        die('Ошибка входа пользователя');
    }
    
    elseif (key_exists('logoff', $_REQUEST)) {
        logoffUser();
        
        header('Location: /');
    }
}
die('Ошибка операции входа/выхода');
