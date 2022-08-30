<?php
include "db-connection.php";
session_start();
$login = $_POST['login'];
$password = $_POST['password'];
$users = $database->query('SELECT * FROM `users`')->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['entrance'] = false;
foreach ($users as $user) {
    if (($login == $user['email'] || $login == $user['name']) && password_verify($password, $user['password'])) {
        $_SESSION['entrance'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['link_vk'] = $user['link_vk'];
        $_SESSION['link_avatar'] = $user['link_avatar'];
        $_SESSION['role'] = $user['role'];
        header('Location: ../index.php');
        die;
    }
};
$_SESSION['errors'][] = 'Не удалось войти';
header('Location: ../authorization.php');

