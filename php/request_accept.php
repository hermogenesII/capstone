<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST["submit"])) {
    $serviceID = $_POST['serviceID'];
    $senderID = $_SESSION['user_id'];
    $receiverID = $_POST['receiverID'];

    $sql = "UPDATE services SET status = 'Pending' WHERE service_id = '$serviceID'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;

    $notification = "accept your request";

    $sql = "INSERT INTO notification(sender_id, receiver_id, notification, status, notification_type) VALUES ('$senderID', '$receiverID','$notification', 0, 'Accept')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    header("Location: /../OOP/practice/user-account/includes/status-SP.php");

}
