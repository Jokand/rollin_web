<?php
include('db-connection.php');
include('get-function.php');
include('update-session.php');
$id_post = $_POST['id_post'];
$id_parent = $_POST['id_parent'];
$id_parent = $_POST['id_parent'] == NULL ? '0' : $_POST['id_parent'];;
$message = $_POST['content'];
$_SESSION['errors'] = [];
if (strlen(trim($message)) == 0) {
    $_SESSION['errors'][] = 'Нельзя оставить пустое поле';
}
if (count($_SESSION['errors']) == 0) {
    $SQL = "INSERT INTO `comments`( `id_author`, `id_parent`, `content`, `id_game`) VALUES ('{$_SESSION['user_id']}','{$id_parent}','{$message}','{$id_post}')";
    var_dump($SQL);
    $database->query($SQL);
};
header('Location: ../single.php?id='. $id_post);

?>