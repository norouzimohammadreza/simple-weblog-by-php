<?php
$serverName = 'localhost';
$user = 'root';
$password = '';
$dataBase = 'weblog_tutorial';
$options = array(pdo::ATTR_ERRMODE => pdo::ERRMODE_EXCEPTION,pdo::ATTR_DEFAULT_FETCH_MODE => pdo::FETCH_OBJ);

try {
    $connection = new PDO("mysql:host=$serverName;dbname=$dataBase", $user, $password, $options);
    return $connection;
} catch (PDOException $th) {

    echo $th->getMessage();
}
