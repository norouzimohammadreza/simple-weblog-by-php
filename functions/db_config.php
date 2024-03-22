<?php
$serverName = 'localhost';
$user = 'root';
$password = '';
$dataBase = 'weblog_tutorial';
global $connection;
try {
    $options = [
        [
            pdo::ATTR_ERRMODE => pdo::ERRMODE_EXCEPTION
        ],
        [
            pdo::ATTR_DEFAULT_FETCH_MODE => pdo::FETCH_OBJ
        ]
    ];
    $connection = new PDO("mysql:host=$serverName;dbname=$dataBase", $user, $password, $options);
    return $connection;
} catch (PDOException $th) {

    echo $th->getMessage();
}
