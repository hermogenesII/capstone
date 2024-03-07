<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';

// if (isset($_POST['submit'])) {
if (
    !empty($_POST['categoryName']) &&
    !empty($_POST['categoryDescription'])
) {

    $name = $_POST['categoryName'];
    $description = $_POST['categoryDescription'];

    if (isset($_FILES["categoryImg"]) && !empty($_FILES["categoryImg"]["name"])) {
        if (is_uploaded_file($_FILES["categoryImg"]["tmp_name"]) && $_FILES["categoryImg"]["error"] === 0) {
            $imageName = $_FILES["categoryImg"]["name"];
            $imageSize = $_FILES["categoryImg"]["size"];
            $tmpName = $_FILES["categoryImg"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)) {
                echo "<script>
                window.setTimeout(function(){
                window.location.href = '/../OOP/admin/categories.php';});</script>";
                echo "<script> alert('Invalid Image Extension');</script>";
            } else {
                $newImageName = $name;
                $newImageName .= '.' . $imageExtension;
                $folder = 'C:\xampp\htdocs\OOP\images\background\\';
                move_uploaded_file($tmpName, $folder . $newImageName);
            }

            $sql = "INSERT INTO category (Category, Category_Description, Category_Img) VALUES ('$name', '$description', '$newImageName')";
            $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute();
            $stmt = null;

            // $notification = "commented on your profile";

            // $sql = "INSERT INTO notification(sender_id, receiver_id, notification, status, notification_type) VALUES ('$user_id', '$userID','$notification', 0, 'Rate')";
            // $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            // $stmt->execute();
            echo "<script>
                window.setTimeout(function(){
                window.location.href = '/../OOP/admin/categories.php';});</script>";
            echo "<script> alert('Category Successfully Added');</script>";
        } else {
            $imageName = null;
        }
    } else {
        echo "<script>
        window.setTimeout(function(){
        window.location.href = '/../OOP/admin/categories.php';});</script>";
        echo "<script> alert('Set Background Image');</script>";
    }
} else {
    echo "<script>
        window.setTimeout(function(){
        window.location.href = '/../OOP/admin/categories.php';});</script>";
    echo "<script> alert('Empty Field');</script>";
}
// }
