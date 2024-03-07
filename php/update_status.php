<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';

if (isset($_POST['submit'])) {

    $serviceID = $_POST['serviceID'];
    $status = $_POST['status'];
    $receiverID = $_POST['receiverID'];
    $senderID = $_SESSION['user_id'];

    $sql = "UPDATE services SET status = '$status' WHERE service_id = $serviceID";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;

    $notification = "update your service status";

    $sql = "INSERT INTO notification(sender_id, receiver_id, notification, status, notification_type) VALUES ('$senderID', '$receiverID','$notification', 0, 'Update')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    echo "<script>
    window.setTimeout(function(){
    window.location.href = '/../OOP/practice/user-account/includes/status-SP.php';});</script>";
    echo "<script> alert('Status Updated Successfully');</script>";
}
