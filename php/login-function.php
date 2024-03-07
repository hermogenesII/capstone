<?php
session_start();
include '../config/db_conn.php';

if (isset($_POST['usernameemail']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$uname = validate($_POST['usernameemail']);
$pass = validate($_POST['password']);

if (empty($uname)) {
    header("Location: ../pages/login.php?error=Username is required");
    exit();
} else if (empty($pass)) {
    header("Location: ../pages/login.php?error=Password is required");
    exit();
}

$sql = "SELECT user_id, username,email, password FROM user WHERE (username= :username  OR email= :username)   AND password = :password";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute([':username' => $uname, ':password' => $pass]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($row);

if ($row === false) {

    header("Location: ../pages/login.php?error=Incorrect Username or Password");
    exit();
} else {
    if (($row['username'] === $uname && $row['password'] === $pass) || $row['email'] === $uname && $row['password'] === $pass) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../pages/login.php");
        exit();
    }
}
