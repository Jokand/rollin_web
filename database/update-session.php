<?php
session_start();
if($_SESSION['entrance'] == true){
    $user = getUserById($_SESSION['user_id']); 
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['link_vk'] = $user['link_vk'];
    $_SESSION['link_avatar'] = $user['link_avatar'];
    $_SESSION['role'] = $user['role'];
}