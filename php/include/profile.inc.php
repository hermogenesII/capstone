<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST["profile-pic"])) {
    $id = $_SESSION['user_id'];
    $name = $_SESSION['username'];

    $imageName = $_FILES["profile-pic"]["name"];
    $imageSize = $_FILES["profile-pic"]["size"];
    $tmpName = $_FILES["profile-pic"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)) {
        echo "<script>
        window.setTimeout(function(){
        window.location.href = '/../OOP/practice/user-account/includes/account.php';});</script>";
        echo "<script> alert('Invalid Image Extension');</script>";

    } else {
        $sql = "SELECT * FROM images WHERE user_id = '$id' AND image_type = 'profile'";
        $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $newImageName = $name;
        $newImageName .= '.' . $imageExtension;
        $folder = 'C:\xampp\htdocs\OOP\images\photo\\';
        if ($stmt->rowCount() == 0) {
            move_uploaded_file($tmpName, $folder . $newImageName);
            // echo "<script> alert('Files Moved')</script>";
            $sql = "INSERT INTO images (user_id, image_filename, date_upload, image_type) VALUES ('$id', '$newImageName', CURRENT_DATE(), 'profile')";
            $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute();
            echo "<script>
            window.setTimeout(function(){
            window.location.href = '/../OOP/practice/user-account/includes/account.php';});</script>";
            echo "<script> alert('Display Picture updated successfully');</script>";
        } else {
            $old_pic = $_POST['old-pic'];
            unlink($folder . $old_pic);
            move_uploaded_file($tmpName, $folder . $newImageName);
            $sql = "UPDATE images SET date_upload = CURRENT_DATE(), image_filename = '$newImageName' WHERE user_id = '$id' AND image_type = 'profile'";
            $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute();
            echo "<script>
            window.setTimeout(function(){
            window.location.href = '/../OOP/practice/user-account/includes/account.php';});</script>";
            echo "<script> alert('Display Picture updated successfully');</script>";
        }

    }

}
