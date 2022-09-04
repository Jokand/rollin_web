<?php 
include('db-connection.php');
include('get-function.php');
include('update-session.php');
$SQL = "INSERT INTO `list_of_registered`(`id_game`, `id_gamer`) VALUES ('{$_POST['id_post']}','{$_SESSION['user_id']}')";
$database->query($SQL);
header('Location: ../single.php?id='. $_POST['id_post']);

