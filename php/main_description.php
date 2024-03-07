<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';

if (isset($_POST['submit'])) {

    $description = $_POST['main-description'];
    $userID = $_SESSION['user_id'];
    $availability = $_POST["availability"] ?? 0;
    $sunday = $_POST["sunday"] ?? 0;
    $monday = $_POST["monday"] ?? 0;
    $tuesday = $_POST["tuesday"] ?? 0;
    $wednesday = $_POST["wednesday"] ?? 0;
    $thursday = $_POST["thursday"] ?? 0;
    $friday = $_POST["friday"] ?? 0;
    $saturday = $_POST["saturday"] ?? 0;
    $sundayIn = $_POST["sundayIn"];
    $sundayOut = $_POST["sundayOut"];
    $mondayIn = $_POST["mondayIn"];
    $mondayOut = $_POST["mondayOut"];
    $tuesdayIn = $_POST["tuesdayIn"];
    $tuesdayOut = $_POST["tuesdayOut"];
    $wednesdayIn = $_POST["wednesdayIn"];
    $wednesdayOut = $_POST["wednesdayOut"];
    $thursdayIn = $_POST["thursdayIn"];
    $thursdayOut = $_POST["thursdayOut"];
    $fridayIn = $_POST["fridayIn"];
    $fridayOut = $_POST["fridayOut"];
    $saturdayIn = $_POST["saturdayIn"];
    $saturdayOut = $_POST["saturdayOut"];

    $sql = "SELECT * from provider_description WHERE user_id = '$userID'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    if ($stmt->rowCount() == 0) {
        $sql = "INSERT INTO provider_description (user_id, description) VALUES ('$userID', '$description')";
        $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute();
        $stmt = null;
    } else {
        $sql = "UPDATE provider_description SET description = '$description' WHERE user_id = '$userID'";
        $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute();
        $stmt = null;
    }

    $sql1 = "SELECT * from availability WHERE user_id = '$userID'";
    $stmt1 = $conn->prepare($sql1, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt1->execute();
    if ($stmt1->rowCount() == 0) {
        $sql1 = "INSERT INTO availability (user_id, sunday, monday, tuesday, wednesday, thursday, friday,saturday, sundayIn, sundayOut, mondayIn, mondayOut, tuesdayIn, tuesdayOut, wednesdayIn, wednesdayOut, thursdayIn, thursdayOut, fridayIn, fridayOut, saturdayIn, saturdayOut, availability) VALUES ('$userID', '$sunday', '$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sundayIn', '$sundayOut', '$mondayIn', '$mondayOut', '$tuesdayIn', '$tuesdayOut', '$wednesdayIn', '$wednesdayOut', '$thursdayIn', '$thursdayOut', '$fridayIn', '$fridayOut', '$saturdayIn', '$saturdayOut', '$availability')";
        $stmt1 = $conn->prepare($sql1, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt1->execute();
        $stmt1 = null;
    } else {
        $sql1 = "UPDATE availability SET availability = '$availability', sunday = '$sunday', monday = '$monday', tuesday = '$tuesday', wednesday = '$wednesday', thursday = '$thursday', friday = '$friday', saturday = '$saturday', sundayIn = '$sundayIn', sundayOut = '$sundayOut', mondayIn = '$mondayIn', mondayOut = '$mondayOut', tuesdayIn = '$tuesdayIn', tuesdayOut = '$tuesdayOut', wednesdayIn = '$wednesdayIn', wednesdayOut = '$wednesdayOut', thursdayIn = '$thursdayIn', thursdayOut = '$thursdayOut', fridayIn = '$fridayIn', fridayOut = '$fridayOut', saturdayIn = '$saturdayIn', saturdayOut = '$saturdayOut' WHERE user_id = '$userID'";
        $stmt1 = $conn->prepare($sql1, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt1->execute();
        $stmt1 = null;
    }

    header("Location: /../OOP/practice/user-account/includes/promote.php");
}
