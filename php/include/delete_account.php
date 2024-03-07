<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST["confirm"])) {
    $id = $_SESSION['user_id'];
    $confirm = $_POST['delete'];

    if ($confirm == "DELETE") {
        $sql = "DELETE FROM user WHERE user_id = '$id'";
        $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute();
        header("Location: /../OOP/index.php");
        session_unset();
        session_destroy();
    } else {
        echo "<script>alert('Enter DELETE')</script>";
        // header("Location: /../OOP/index.php");
    }
}
