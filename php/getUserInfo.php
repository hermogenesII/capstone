<?php
include './config/db_conn.php';

// $sp = "";
$sql = "SELECT * FROM `user` WHERE `user_id` = ?";
$stmt = prepared_query($conn, $sql, ['']);
$user = $stmt->get_result()->fetch_assoc();
printf($user);
// print_r($user);

function prepared_query($mysqli, $sql, $params, $types = "")
{
    $types = $types ?: str_repeat("s", count($params));
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt;
}
