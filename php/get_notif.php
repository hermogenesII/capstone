<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT TIMESTAMPDIFF(SECOND, notification.date, NOW()) as second, TIMESTAMPDIFF(MINUTE, notification.date, NOW()) as minute, TIMESTAMPDIFF(HOUR, notification.date, NOW()) as hour, TIMESTAMPDIFF(DAY, notification.date, NOW()) as day, TIMESTAMPDIFF(WEEK, notification.date, NOW()) as week, TIMESTAMPDIFF(MONTH, notification.date, NOW()) as month, TIMESTAMPDIFF(YEAR, notification.date, NOW()) as year, user.user_id, CONCAT(user.fname, ' ', user.lname) AS name ,notification.*, images.image_filename FROM user RIGHT JOIN notification ON user.user_id=notification.sender_id LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile' WHERE notification.receiver_id ='$id' ORDER BY notification_id DESC LIMIT 15;";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$notifList = "";
$more = "";

if ($stmt->rowCount() == 0) {
    $notifList .= "No notification yet";
} else {
    while ($notif = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $notifImg = $notif['image_filename'] == null ? "default.png" : $notif['image_filename'];
        if ($notif["second"] < 3600) {
            $interval = $notif["minute"] . " minutes ago";
        } elseif ($notif["second"] >= 3600 and $notif["second"] < 7200) {
            $interval = $notif["hour"] . " hour ago";
        } elseif ($notif["second"] >= 7200 and $notif["second"] < 86400) {
            $interval = $notif["hour"] . " hours ago";
        } elseif ($notif["second"] >= 3600 and $notif["second"] < 86400) {
            $interval = $notif["hour"] . " hours ago";
        } else {
            $interval = "a week ago";
        }
        if ($notif["notification_type"] == "Hire") {
            $notifList .= '
            <li>
            <a href="/../OOP/pages/service-provider.php?userid=' . $notif["user_id"] . '">
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="hire"><i class="fa-solid fa-hand-dots"></i></h2>
            </a>
            <div>
            <a href="/../OOP/practice/user-account/includes/request-SP.php"><p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p></a>
            <p class="date">' . $interval . '</p>
            </div>
        </li>
                            ';
        } elseif ($notif["notification_type"] == "Message") {
            $notifList .= '
            <li>
            <a href="/../OOP/pages/service-provider.php?userid=' . $notif["user_id"] . '">

            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="sent"><i class="fa-solid fa-paper-plane"></i></h2>
            </a>
        <div>
            <a href="/../OOP/pages/message.php"><p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p></a>
            <p class="date">' . $interval . '</p>
            </div>
        </li>
                            ';
        } elseif ($notif["notification_type"] == "Cancel") {
            $notifList .= '
            <li>
            <a href="/../OOP/pages/service-provider.php?userid=' . $notif["user_id"] . '">

            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="cancel"><i class="fa-solid fa-ban"></i></h2>
            </a>
        <div>
            <a href="/../OOP/practice/user-account/includes/history-SP.php"><p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p></a>
            <p class="date">' . $interval . '</p>
            </div>
        </li>
                            ';
        } elseif ($notif["notification_type"] == "Rate") {
            $notifList .= '
            <li>
            <a href="/../OOP/pages/service-provider.php?userid=' . $notif["user_id"] . '">

        <img src="/../OOP/images/photo/' . $notifImg . '">
        <h2 class="rate"><i class="fa-solid fa-star"></i></h2>
        </a>
        <div>
            <a href="/../OOP/pages/service-provider.php?userid=' . $id . '"><p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p></a>
            <p class="date">' . $interval . '</p>
            </div>
</li>
                            ';
        } elseif ($notif["notification_type"] == "Update") {
            $notifList .= '
            <li>
            <a href="/../OOP/pages/service-provider.php?userid=' . $notif["user_id"] . '">
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
            </a>
            <div>
            <a href="/../OOP/practice/user-account/includes/monitor.php"><p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p></a>
            <p class="date">' . $interval . '</p>
            </div>

        </li>

                            ';
        } elseif ($notif["notification_type"] == "Subscription") {
            $notifList .= '
            <li>
            <a href="#">
            <img src="/../OOP/admin/images/admin.jpeg">
            <h2 class="accept"><i class="fa-regular fa-square-check"></i></h2>
            </a>
            <div>
            <a href="/../OOP/practice/user-account/includes/promote.php"><p>' . $notif["notification"] . '</p></a>
            <p class="date">' . $interval . '</p>
            </div>
        </li>
                            ';
        } elseif ($notif["notification_type"] == "Accept") {
            $notifList .= '
            <li>
            <a href="/../OOP/pages/service-provider.php?userid=' . $notif["user_id"] . '">
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="accept"><i class="fa-regular fa-square-check"></i></h2>
            </a>
            <div>
            <a href="/../OOP/practice/user-account/includes/monitor.php"><p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p></a>
            <p class="date">' . $interval . '</p>
            </div>
        </li>
                            ';
        } else {
            $notifList .= '
            <li>
            <a href="/../OOP/pages/service-provider.php?userid=' . $notif["user_id"] . '">
            <img src="/../OOP/images/photo/' . $notifImg . '">
            <h2 class="comment"><i class="fa-solid fa-comment"></i></h2>
            </a>
            <div>
            <a href="/../OOP/pages/message.php"><p><b>' . $notif["name"] . '  ' . '</b> ' . $notif["notification"] . '</p></a>
            <p class="date">' . $interval . '</p>
            </div>
        </li>
        ';
        }
    }
    $more .= '<div class="see-more"><a href="/../OOP/pages/notification.php" > See more</a></div>';
}
echo $notifList;
echo $more;
