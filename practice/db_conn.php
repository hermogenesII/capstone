<?php
$db_host = 'localhost:3307';
$db_user = 'root';
$db_pass = '';
$db_name = 'serviseek_db';

try {
    $conn = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED,
    ]);
    // return $conn;
} catch (PDOException $ex) {
    exit($ex->getMessage());
}

// $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// if (mysqli_connect_error()) {
//     exit('Error connection to the DataBase' . mysqli_connect_error());
// }
