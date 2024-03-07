<?php
// include './autoloader.inc.php';

if (isset($_POST['submit'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $_SESSION['username'] = validate($_POST['usernameemail']);
    $username = $_SESSION['username'];
    $password = validate($_POST['password']);

    include "../classes/dbConn.php";
    include "../classes/login/login.class.php";
    include "../classes/login/login-cntrl.class.php";
    $login = new LoginCntrl($username, $password);

    $login->loginUser();
    if ($_SESSION["role"] == "admin") {
        header("Location: /../OOP/admin/admin.php");

    } elseif ($_SESSION["role"] == "user") {
        header("Location: /../OOP/index.php");

    }
}
