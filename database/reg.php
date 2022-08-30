<?php
include('db-connection.php');
unset($_SESSION['errors']);
$_SESSION['errors'] = [];
if (isset($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $content = $_POST['content'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    $hash_password = password_hash($password, PASSWORD_BCRYPT);
    $user = $database->query("SELECT * FROM `users` WHERE `email` = '{$email}'")->fetch(PDO::FETCH_ASSOC);
    $fileName = NULL;
    if (isset($_FILES)) {
        $fileName = NULL;
        $image = $_FILES['file'];
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $ext;
        if (!is_dir(__DIR__ . '/../uploads')) {
            mkdir(__DIR__ . '/../uploads');
        }
        move_uploaded_file($image['tmp_name'], __DIR__ . '/../uploads/' . $fileName);
        $fileName = 'uploads/' . $fileName;
    }

    if (trim($name =='')) {
        $_SESSION['errors'][] = 'Вы не ввели данные в поле "Имя"';
    }
    if (trim($email =='')) {
        $_SESSION['errors'][] = 'Вы не ввели данные в поле "Email"';
    }
    if (trim(is_array($user))) {
        $_SESSION['errors'][] = 'Пользователь с почтой "' . $user['email'] . '" уже существует';
    }
    if (strlen(trim($password)) < 8) {
        $_SESSION['errors'][] = 'Пароль менее 8 символов';
    }
    if (trim($password) != trim($repeat_password)) {
        $_SESSION['errors'][] = 'Пароли не совпадают';
    }
    if (count($_SESSION['errors']) == 0) {
        $SQL = "INSERT INTO `users`( `name`, `email`, `about_user`, `password`, `link_avatar`) VALUES ('{$name}','{$email}','{$content}','{$hash_password}','{$fileName}')";
        var_dump($SQL);
        $database->query($SQL);
        //header('Location: ../index.php');
        die();
    };
};

header('Location: ../registration.php');
