<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST['submit'])) {
    $id = $_SESSION['user_id'];

    $sql = "INSERT INTO subscription (user_id, subscription_type, reference, reference_img, subscription_date, subscription_exp, status) VALUES ('$id', 'Monthly', '', '', CURRENT_DATE(), date_add( CURRENT_DATE(), INTERVAL 30 DAY), 'free')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    echo "<script>
          window.setTimeout(function(){
          window.location.href = '/../OOP/practice/user-account/includes/account.php';});</script>";
    echo "<script> alert('Your Free Subscription is now Active');</script>";
}
