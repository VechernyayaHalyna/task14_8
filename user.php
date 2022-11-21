<?php

require_once 'config.php';

function getUsersList($reload)
{

    if (!key_exists('users', $_SESSION) && !$reload) {
        return [];
    }
    if ($_SESSION['users'] && !$reload) {
        $users = $_SESSION['users'];
    } else {
        if (file_exists(Config::userDataFilePath())) {
            $json = file_get_contents(Config::userDataFilePath());
            $users = json_decode($json, true);
        } else {
            $users = [];
        }
        $_SESSION['users'] = $users;
    }
    return $users;
}

function saveUsersList()
{
    $users = getUsersList(false);
    $json = json_encode($users);

    file_put_contents(Config::userDataFilePath(), $json);
}

function existsUser($login)
{
    $users = getUsersList(false);
    return key_exists($login, $users);
}

function checkPassword($login, $password)
{
    $users = getUsersList(false);
    if (!$users) {
        return false;
    }
    $userPassword = $users[$login]['password'];
    if (!$userPassword) {
        return false;
    }
    $checkPasswHash = sha1($password);
    return $userPassword === $checkPasswHash;
}

function addUser($login, $password)
{
    $users = getUsersList(false);
    $userExists = existsUser($login);
    $users[$login]['password'] = sha1($password);
    
    if (!$userExists) {
        $users[$login]['regdate'] = time();
    }
    $_SESSION['users'] = $users;
    
    if (!$userExists) {
        saveUsersList();
    }
    return true;
}

function changeUserPassword($login, $newPassword)
{
    $users = getUsersList(false);
    $userExists = existsUser($login);
    if (!$userExists) {
        return false;
    }
    $users[$login]['password'] = sha1($newPassword);
    $_SESSION['users'] = $users;
    
    saveUsersList();
    return true;
}

function loginUser($login, $password)
{
    $users = getUsersList(true);

    $userExists = existsUser($login);

    if (!$userExists) {
        return false;
    }
    if (sha1($password) === $users[$login]['password']) {
        $_SESSION['user_login'] = $login;
        $_SESSION['user_regdate'] = $users[$login]['regdate'];
        return true;
    } else {
        return false;
    }
}

function logoffUser()
{
    unset($_SESSION['user_login']);
    unset($_SESSION['user_regdate']);
    unset($_SESSION['user_birthday']);
}

function getCurrentUser()
{
    if (!key_exists('user_login', $_SESSION)) {
        return null;
    }
    if (!$_SESSION['user_login']) {
        return null;
    } else {
        $login = $_SESSION['user_login'];
        return $login;
    }
}

function getUserRegDate()
{
    if (!key_exists('user_regdate', $_SESSION)) {
        return null;
    }
    if (!$_SESSION['user_regdate']) {
        return null;
    } else {
        $regdate = $_SESSION['user_regdate'];
        return $regdate;
    }
}

function saveUserProfile($login, $fullname, $birthday)
{
    $users = getUsersList(false);
    $userExists = existsUser($login);
    if (!$userExists) {
        return false;
    }
    $users[$login]['fullname'] = $fullname;
    $users[$login]['birthday'] = $birthday;


    $_SESSION['users'] = $users;
    $_SESSION['user_birthday'] = $birthday;

    
    saveUsersList();
    return true;
}

function getUserFullName($login)
{
    $users = getUsersList(false);
    if (!existsUser($login)) {
        return null;
    }
    if (!key_exists('fullname', $users[$login])) {
        return null;
    }
    return $users[$login]['fullname'];
}

function getUserBirthday($login)
{
     
    if (key_exists('user_birthday', $_SESSION) && key_exists('user_login', $_SESSION) && $login === $_SESSION['user_login']) {
        return $_SESSION['user_birthday'];
    } else {
        
        $users = getUsersList(false);
        if (!existsUser($login)) {
            return null;
        }
        if (!key_exists('birthday', $users[$login])) {
            return null;
        }
        $birthday = $users[$login]['birthday'];
        $_SESSION['user_birthday'] = $birthday;

        return $birthday;
    }
}