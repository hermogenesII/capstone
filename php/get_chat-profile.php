<?php

session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$outgoing_id = $_POST["outgoing_id"];
$incoming_id = $_POST["incoming_id"];
$output = "";

$sql = "SELECT user.*, images.image_filename FROM user LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile' WHERE user.user_id = '$incoming_id'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $chatImg = $row['image_filename'] == null ? "default.png" : $row['image_filename'];
        $status = $row['status'] == 'Active Now' ? "fa-circle" : "fa-mobile-screen";
        $output .= '
        <h1><img src="/../OOP/images/photo/' . $chatImg . '" alt="" /></h1> <h2>' . $row["fname"] . ' ' . $row["lname"] . '</h2>
        <p class="status"><i class="fa-solid ' . $status . '"></i>' . $row['status'] . '</p>
        ';
    }
    echo $output;
} else {
    echo "<script> alert('error)</script>";
}
