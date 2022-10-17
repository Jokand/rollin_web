<?php
include('db-connection.php');
include('get-function.php');
include('update-session.php');
$_SESSION['errors'] = [];
if (isset($_POST)) {
    $id = $_POST['id'];
    $status = $_POST['status'];


    switch ($status) {
        case 'accept':
            $status_bd = 'confirmed';
            break;
        case 'reject':
            $status_bd = 'canceled';
            break;
    }

    $SQL = "UPDATE `games` SET `status`='{$status_bd}' WHERE `id`='{$id}'";
    $database->query($SQL);
    header('Location: ../admin_panel.php');
    die();
};
header('Location: ../claim_game.php');
