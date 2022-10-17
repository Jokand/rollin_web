<?php
include('db-connection.php');
include('get-function.php');
include('update-session.php');
$_SESSION['errors'] = [];
if (isset($_POST)) {
    $id = $_POST['id'];
    $fileName = $_POST['link_to_illustration'];
    $title = $_POST['title'];
    $setting = $_POST['setting'];
    $system = $_POST['system'];
    $genre = $_POST['genre'];
    $environment = $_POST['environment'];
    $location = $_POST['location'];
    $record = $_POST['record'];
    $price = $_POST['price'];
    $begin_date = $_POST['begin_date'];
    $begin_time = $_POST['begin_time'];
    $end_time = $_POST['end_time'];
    $description = $_POST['description'];
    $remark = $_POST['remark'];
    $id_master = $_SESSION['user_id'];


    if ($_FILES && $_FILES['file']['name']!=null) {
        $image = $_FILES['file'];
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $ext;
        if (!is_dir(__DIR__ . '/../uploads')) {
            mkdir(__DIR__ . '/../uploads');
        }
        move_uploaded_file($image['tmp_name'], __DIR__ . '/../uploads/' . $fileName);
        $fileName = 'uploads/' . $fileName;
    }
    if (trim($title == '')) {
        $_SESSION['errors'][] = 'Вы не ввели название игры';
    }
    if (trim($setting == '')) {
        $_SESSION['errors'][] = 'Вы не указали сеттинг';
    }
    if (trim($system == '')) {
        $_SESSION['errors'][] = 'Вы не указали систему';
    }
    if (trim($genre == '')) {
        $_SESSION['errors'][] = 'Вы не указали жанр';
    }
    if (trim($location == '')) {
        $_SESSION['errors'][] = 'Вы не указали место проведения';
    }
    if (trim($record == '') || $record == NULL) {
        $_SESSION['errors'][] = 'Вы не указали количество игроков';
    }
    if (trim($price == '') || $price == NULL) {
        $_SESSION['errors'][] = 'Вы не указали стоимость игры. Если хотите чтобы она была бесплатной, то поставьте 0 в соответвующем поле';
    }
    if (trim($description == '')) {
        $_SESSION['errors'][] = 'Вы не добавили описание к игре';
    }
    if ($begin_date < date('Y-m-d')) {
        $_SESSION['errors'][] = 'Вы не можете заявлять игры на прошедшие даты';
    }
    if (count($_SESSION['errors']) == 0) {
        $SQL = "UPDATE `games` SET `title`='{$title}',`record`='{$record}',`link_to_illustration`='{$fileName}',`description`='{$description}', `remark`='{$remark}',`setting`='{$setting}',`system`='{$system}',`genre`='{$genre}',`price`='{$price}',`environment`='{$environment}',`location`='{$location}',`dategame`='{$begin_date}',`beginning_game`='{$begin_time}',`end_game`='{$end_time}' WHERE `id`='{$id}'"; 
        $database->query($SQL);
        header('Location: ../admin_panel.php');
        die();
    };
};
header('Location: ../claim_game.php');
