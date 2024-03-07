<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT notification.* FROM notification LEFT JOIN user ON user.user_id=notification.sender_id WHERE notification.receiver_id ='$id' AND notification.status = '0'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$notifCount = "";

if ($stmt->rowCount() == 0) {
    $notifCount .= "";
} else {
    $notifCount .= '
        <span class="notif-count">' . $stmt->rowCount() . '</span>
                        ';
}
echo $notifCount;
