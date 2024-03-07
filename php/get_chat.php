<?php

session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$outgoing_id = $_POST["outgoing_id"];
$incoming_id = $_POST["incoming_id"];
$output = "";

$sql = "SELECT * FROM message WHERE (receiver_id = '$incoming_id' && sender_id = $outgoing_id) OR (receiver_id = '$outgoing_id' && sender_id = $incoming_id) ORDER BY message_id DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['sender_id'] === $outgoing_id) {
            $output .= '<div class=" chat outgoing">
                          <div class="details">
                            <p>' . htmlentities($row["message"]) . '</p>
                          </div>
                        </div>';
        } else {
            $output .= '<div class=" chat incoming">
                        <img src="/../OOP/images/photo/default.png" alt="">
                          <div class="details">
                            <p> ' . htmlentities($row["message"]) . ' </p>
                          </div>
                        </div>';
        }
    }
    echo $output;
} else {
    echo "<script> alert('error')</script>";
}
