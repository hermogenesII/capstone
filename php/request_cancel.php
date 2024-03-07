<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST["submit"])) {
    $serviceID = $_POST['serviceID'];
    $senderID = $_SESSION['user_id'];
    $receiverID = $_POST['providerID'];

    $sql = "UPDATE services SET status = 'Cancelled' WHERE service_id = '$serviceID'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;

    $notification = "cancel his/her request";

    $sql = "INSERT INTO notification(sender_id, receiver_id, notification, status, notification_type) VALUES ('$senderID', '$receiverID','$notification', 0, 'Cancel')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    echo "<script>
    window.setTimeout(function(){
    window.location.href = '/../OOP/practice/user-account/includes/request-SS.php';});</script>";
    echo "<script> alert('Successfully cancel the request');</script>";
    // header("Location: /../OOP/practice/user-account/user-account.php");

}
