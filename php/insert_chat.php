<?php

session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$outgoing_id = $_POST["outgoing_id"];
$incoming_id = $_POST["incoming_id"];
$message = $_POST["message"];

if (!empty($message) && !ctype_space($message)) {
    $sql = "INSERT INTO message (receiver_id, sender_id, message) VALUES ('$incoming_id', '$outgoing_id', '$message')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;

    $notification = "sent you a message";

    $sql = "INSERT INTO notification(sender_id, receiver_id, notification, status, notification_type) VALUES ('$outgoing_id', '$incoming_id','$notification', 0, 'Message')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
}
