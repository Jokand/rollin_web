<?php
$user = "root";
$pass = "root";
$db = "rollin";
$host = "127.0.0.1";
$dsn = "mysql:host =". $host . ";dbname=".$db.";charset=utf8";
$database = new PDO($dsn, $user, $pass);
return $database;