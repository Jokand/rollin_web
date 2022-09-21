<?php
include('db-connection.php');
include('get-function.php');
include('update-session.php');
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$re_password = $_POST['re_password'];
$user = getUserById($_SESSION['user_id']);
$password_hash = password_hash($new_password, PASSWORD_BCRYPT);

if ($old_password =='' || $new_password ==''|| $re_password =='') {
    $_SESSION['errors'][] = 'Не все поля заполнены';
}
if(!password_verify($old_password, $user['password'])){
    $_SESSION['errors'][] = 'Старый пароль введён неверно';

};
if($new_password!=$re_password){
    $_SESSION['errors'][] = 'Повторный пароль введён неверно';
};
if (count($_SESSION['errors']) == 0) {
    $SQL = "UPDATE `users` SET `password`='$password_hash' WHERE id = '{$_SESSION['user_id']}'";
    $database->query($SQL);
    $_SESSION['errors'][] = 'Пароль успешно изменён';
    header('Location: ../password_change.php');
    die;
};
header('Location: ../password_change.php');