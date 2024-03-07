<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST["submit"])) {
    $spID = $_POST['spID'];

    $sql = "DELETE FROM user_provider WHERE SP_id = '$spID'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    header("Location: /../OOP/practice/user-account/includes/promote.php");

}
