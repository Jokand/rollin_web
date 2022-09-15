<?php
function getAllPosts(){
    global $database;
    $data = $database->query('SELECT * FROM `games`')->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
function getPostsByMon($mon){
    global $database;
    $data = $database->query("SELECT * FROM `games` WHERE MONTH(`beginning_game`) = '{$mon}'")->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
function getPostById($id){
    global $database;
    $data = $database->query("SELECT * FROM `games` WHERE `id` = '{$id}'")->fetch(PDO::FETCH_ASSOC);
    return $data;
}
function getUserById($id){
    global $database;
    $data = $database->query("SELECT * FROM `users` WHERE `id` = '{$id}'")->fetch(PDO::FETCH_ASSOC);
    return $data;
}
function getCommByIdPost($id){
    global $database;
    $data = $database->query("SELECT * FROM `comments` WHERE `id_game` = '{$id}'")->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
function getImageUserPath($id){
    $link_avatar = getUserById($id)['link_avatar'];
    if($link_avatar!=NULL){
        return $link_avatar;
    }else{
    return "../images/avatar.jpg";
    }
}
function getPostsByIdUser($id){
    global $database;
    $data = $database->query("SELECT * FROM `games` WHERE `id_master` = '{$id}'")->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getRecordUsersByIdGame($id){
    global $database;
    $data = $database->query("SELECT * FROM `list_of_registered` WHERE `id_game` = '{$id}' AND `application_status` = 'confirmed'")->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

//функция изменения формата даты и обрезки текста до определённого колличества слов

function formatDate($str, $date_format)
{
    $date = new DateTime($str);
    $intlFormatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
    $intlFormatter->setPattern($date_format);
    return $intlFormatter->format($date);
}

function word_teaser($string, $count){
    $original_string = $string;
    $words = explode(' ', $original_string);

    if (count($words) > $count) {
        $words = array_slice($words, 0, $count);
        $string = implode(' ', $words);
    }

    return $string;
}