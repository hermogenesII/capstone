<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT DISTINCT user.user_id, CONCAT(user.fname, ' ', user.lname) AS name, user.status, images.image_filename, MAX(message.message_id) AS latest_message
FROM user RIGHT JOIN `message` ON (user.user_id=message.sender_id OR user.user_id=message.receiver_id)
LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile'
WHERE user.user_id != '$id' AND user.reviewed=1 AND ('$id'=message.sender_id OR '$id'=message.receiver_id)
GROUP BY user.user_id
ORDER BY latest_message DESC;";
// $sql = "SELECT DISTINCT user.user_id, CONCAT(user.fname, ' ', user.lname) AS name, user.status, message.message_id, images.image_filename FROM user RIGHT JOIN `message` ON (user_id=message.sender_id OR user_id=message.receiver_id) LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile' WHERE user.user_id != '$id' AND user.reviewed=1 AND ('$id'=message.sender_id OR '$id'=message.receiver_id) GROUP BY user.user_id ORDER BY message.message_id DESC;";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$chatList = "";

if ($stmt->rowCount() == 0) {
    $chatList .= "No users are available to chat";
} else {
    while ($chat = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $chatName = $chat['image_filename'] == null ? "default.png" : $chat['image_filename'];
        $status = $chat['status'] == 'Active Now' ? "fa-circle" : "fa-mobile-screen";
        $chatList .= '
                        <a href="/../OOP/pages/message.php?userid=' . $chat['user_id'] . '">
                        <img src="/../OOP/images/photo/' . $chatName . '" alt="" />
                        <p>' . $chat['name'] . '</p> <i class="fa-solid ' . $status . '"></i>
                        </a>
                        ';
    }
}
echo $chatList;
