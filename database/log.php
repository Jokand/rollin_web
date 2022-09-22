<?php
include "db-connection.php";
session_start();
$login = $_POST['login'];
$password = $_POST['password'];
$users = $database->query('SELECT `id`, `email`, `password` FROM `users`')->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['entrance'] = false;
foreach ($users as $user) {
    // if (($login == $user['email'] || $login == $user['name']) && password_verify($password, $user['password'])) {
    if (($login == $user['email']) && password_verify($password, $user['password'])) {
        $_SESSION['entrance'] = true;
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../index.php');
        die;
    }
};
$_SESSION['errors'][] = 'Не удалось войти';
header('Location: ../authorization.php');

