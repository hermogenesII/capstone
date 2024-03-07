<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST["submit"])) {
    $id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['barangay'];

    $sql = "UPDATE user SET username = '$username', email = '$email', contact = '$phone', address = '$address' WHERE user_id = '$id'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    unset($_SESSION["username"]);
    unset($_SESSION["user_email"]);
    unset($_SESSION["user_contact"]);
    unset($_SESSION["user_address"]);

    $sql = "SELECT user.*, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name FROM user
    INNER JOIN barangay ON user.address=barangay.barangay_code
    INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
    INNER JOIN province ON barangay.province_code=province.province_code
    INNER JOIN country ON barangay.country_code=country.country_code
    WHERE user.user_id = '$id';";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION["username"] = $_POST['username'];
    $_SESSION["user_email"] = $_POST['email'];
    $_SESSION["user_contact"] = $_POST['phone'];
    $_SESSION["user_address"] = $user[0]["barangay_name"] . ", " . $user[0]["municipality_name"] . ", " . $user[0]["province_name"] . ", " . $user[0]["country_name"];

    echo "<script>
    window.setTimeout(function(){
    window.location.href = '/../OOP/practice/user-account/includes/account.php';});</script>";
    echo "<script> alert('Information updated successfully');</script>";

}
