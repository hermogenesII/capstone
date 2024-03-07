<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';

// if (isset($_POST['submit'])) {
if (!empty($_POST['subCategoryName'])) {

    $name = $_POST['subCategoryName'];
    $cat = $_POST['Category_id'];

    $sql = "INSERT INTO subcategory (Category_id, Subcategory) VALUES ('$cat', '$name')";
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
    echo "<script> alert('Sub Category Successfully Added');</script>";
} else {
    echo "<script>
        window.setTimeout(function(){
        window.location.href = '/../OOP/admin/categories.php';});</script>";
    echo "<script> alert('Empty Field');</script>";
}
// }
