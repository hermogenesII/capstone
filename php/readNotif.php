<?php

include '/xampp/htdocs/OOP/config/db_conn.php';

$sql = "UPDATE notification SET status = '1' ";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Failed";
}
