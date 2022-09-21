<?php
include('db-connection.php');
include('get-function.php');
include('update-session.php');
$username = $_POST['username'];
$about_user = $_POST['about_user'];
$vk_link = $_POST['vk_link'];
$link_profile = "Location: /profile.php?user_id=" . $_SESSION['user_id'];
$_SESSION['errors'] = [];
if (trim($username =='')) {
    $_SESSION['errors'][] = 'Нельзя оставить имя пустым';
}
if (count($_SESSION['errors']) == 0) {
    $SQL = "UPDATE `users` SET `name`='$username', `about_user`='$about_user', `link_vk`='$vk_link' WHERE id = '{$_SESSION['user_id']}'";
    $database->query($SQL);
    $_SESSION['errors'][] = 'Данные успешно изменены';
    header($link_profile);
    die;
};
header($link_profile);