<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';

if (isset($_POST['submit'])) {

    $user_id = $_SESSION['user_id'];
    $userID = $_POST['userID'];
    $rate = $_POST['rate'];
    $feedback = $_POST['review'];

    if (isset($_FILES["reviewImg"]) && !empty($_FILES["reviewImg"]["name"])) {
        if (is_uploaded_file($_FILES["reviewImg"]["tmp_name"]) && $_FILES["reviewImg"]["error"] === 0) {
            $imageName = $_FILES["reviewImg"]["name"];
            $imageSize = $_FILES["reviewImg"]["size"];
            $tmpName = $_FILES["reviewImg"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)) {
                echo "<script>
                window.setTimeout(function(){
                window.location.href = '/../OOP/pages/review.php';});</script>";
                echo "<script> alert('Invalid Image Extension');</script>";
            } else {
                $folder = 'C:\xampp\htdocs\OOP\images\feedback\\';
                move_uploaded_file($tmpName, $folder . $imageName);
            }
        } else {
            $imageName = null;
        }
    } else {
        $imageName = null;
    }

    $sql = "INSERT INTO feedback (seeker_id, provider_id, rating, feedback, feedback_img, date) VALUES ('$user_id', '$userID', '$rate', '$feedback', '$imageName', CURRENT_DATE())";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;

    $notification = "commented on your profile";

    $sql = "INSERT INTO notification(sender_id, receiver_id, notification, status, notification_type) VALUES ('$user_id', '$userID','$notification', 0, 'Rate')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    echo "<script>
        window.setTimeout(function(){
        window.location.href = '/../OOP/practice/user-account/includes/history-SS.php';});</script>";
    echo "<script> alert('Thanks for your feedback');</script>";
}
