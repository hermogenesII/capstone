<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST["cancel"])) {
    header("Location: /../OOP/practice/user-account/includes/account.php");
} elseif (isset($_POST["save"])) {

    $user = $_SESSION['user_id'];
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $confirmPass = $_POST['confirmPass'];

    include "../classes/dbConn.php";
    include "../classes/password/password.class.php";
    include "../classes/password/password-cntrl.class.php";
    $password = new PasswordCntrl($user, $oldPass, $newPass, $confirmPass);

    $password->changePassword();
    echo "<script>
    window.setTimeout(function(){
    window.location.href = '/../OOP/practice/user-account/includes/account.php';});</script>";
    echo "<script> alert('Password updated successfully') </script>";
    // header("Location: /../OOP/practice/user-account/user-account.php");
}
