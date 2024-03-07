<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT CONCAT(user.fname, ' ', user.lname) AS name ,notification.*, images.image_filename FROM user INNER JOIN notification ON user.user_id=notification.sender_id LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile' WHERE notification.receiver_id ='$id' ORDER BY notification_id DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$notifList = "";

if ($stmt->rowCount() == 0) {
    $notifList .= "No users are available to chat";
} else {
    while ($notif = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $notifImg = $notif['image_filename'] == null ? "default.png" : $notif['image_filename'];
        if ($notif["notification_type"] == "Hire") {
            $notifList .= '
            <li>
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="hire"><i class="fa-solid fa-hand-dots"></i></h2>
            <p><b><b>' . $notif["name"] . '  ' . '</b> ' . '</b> ' . $notif["notification"] . '</p>
        </li>
                            ';
        } elseif ($notif["notification_type"] == "Message") {
            $notifList .= '
            <li>
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="sent"><i class="fa-solid fa-paper-plane"></i></h2>
            <p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p>
        </li>
                            ';
        } elseif ($notif["notification_type"] == "Cancel") {
            $notifList .= '
            <li>
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="cancel"><i class="fa-solid fa-ban"></i></h2>
            <p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p>
        </li>
                            ';
        } elseif ($notif["notification_type"] == "Rate") {
            $notifList .= '
            <li>
        <img src="/../OOP/images/photo/' . $notifImg . '">
        <h2 class="rate"><i class="fa-solid fa-star"></i></h2>
        <p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p>
</li>
                            ';
        } elseif ($notif["notification_type"] == "Request") {
            $notifList .= '
            <li>
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="comment"><i class="fa-solid fa-comment"></i></h2>
            <p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p>
        </li>
</li>
                            ';
        } elseif ($notif["notification_type"] == "Request") {
            $notifList .= '
            <li>
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="accept"><i class="fa-regular fa-square-check"></i></h2>
            <p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p>
        </li>
                            ';
        } else {
            $notifList .= '

            <li>
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
            <p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p>
        </li>
        ';
        }
    }
}
echo $notifList;
