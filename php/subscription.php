<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';

// if (isset($_POST['submit'])) {
// if (isset($_POST['duration']) == "Monthly") {
//     $type = "monthly";
// } elseif (isset($_POST['duration']) == "Quarterly") {
//     $type = "quarterly";
// } else {
//     $type = "annually";
// }
$type = $_POST['duration'];

$id = $_SESSION['user_id'];
// $type = $_POST['subscription'];
$reference = $_POST['referenceNum'];
$imageName = $_FILES["referenceImg"]["name"];
$imageSize = $_FILES["referenceImg"]["size"];
$tmpName = $_FILES["referenceImg"]["tmp_name"];

$validImageExtension = ['jpg', 'jpeg', 'png'];
$imageExtension = explode('.', $imageName);
$imageExtension = strtolower(end($imageExtension));
if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script>
        window.setTimeout(function(){
        window.location.href = '/../OOP/practice/user-account/includes/subscription.php';});</script>";
    echo "<script> alert('Invalid Image Extension');</script>";
} else {
    $folder = 'C:\xampp\htdocs\OOP\practice\user-account\includes\reference\\';
    move_uploaded_file($tmpName, $folder . $imageName);
    $sql = "INSERT INTO subscription (user_id, subscription_type, reference, reference_img, subscription_date, subscription_exp, status) VALUES ('$id', '$type', '$reference', '$imageName', CURRENT_DATE(), CURRENT_DATE(), 'pending')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    echo "<script>
        window.setTimeout(function(){
        window.location.href = '/../OOP/practice/user-account/includes/account.php';});</script>";
    echo "<script> alert('Subscription has been sent to Admin');</script>";
}
// }
