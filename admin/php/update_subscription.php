<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
// if (isset($_POST["submit"])) {
if ($_POST["type"] == "Monthly") {
    $exp = 30 . ' DAY';
} elseif ($_POST["type"] == "Quarterly") {
    $exp = 120 . ' DAY';
} else {
    $exp = 360 . ' DAY';
}
if ($_POST["status"] === "approved") {
    $notification = "Congratulations, you can now promote your services";
} else {
    $notification = "Sorry, your subscription have been declined";
}
$request = $_POST["status"];
$userid = $_POST["userid"];
$subsid = $_POST["subsid"];

$sql = "UPDATE subscription SET status = '$request', subscription_date = CURRENT_DATE(), subscription_exp = date_add(CURRENT_DATE(), INTERVAL $exp) WHERE user_id = '$userid' AND subscription_id = '$subsid'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$stmt = null;

$sql = "INSERT INTO notification(sender_id, receiver_id, notification, status, notification_type) VALUES ('Admin', '$userid','$notification', 0, 'Subscription')";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
header("Location: /../OOP/admin/proof.php");

// }
// echo "<script>alert('$exp')</script>";
