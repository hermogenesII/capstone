<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST["cancel"])) {
    header("Location: /../OOP/practice/user-account/includes/account.php");
} elseif (isset($_POST["confirm"])) {

    $id = $_SESSION['user_id'];
    $sql = "UPDATE user SET status = 'Offline' WHERE user_id = '$id'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    session_unset();
    session_destroy();
    header("Location: /../OOP/pages/login.php");
}
