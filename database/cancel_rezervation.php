<?php 
include('db-connection.php');
include('get-function.php');
include('update-session.php');
$SQL = "DELETE FROM `list_of_registered` WHERE `id_game`='{$_GET["id"]}' AND `id_gamer`='{$_SESSION["user_id"]}'";
$database->query($SQL);
header('Location: ../single.php?id='. $_GET["game_id"]);
