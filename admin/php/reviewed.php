<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
$userid = $_POST["userid"];

$sql = "SELECT email FROM user WHERE user_id = '$userid'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

use PHPMailer\PHPMailer\PHPMailer;

require '/../xampp/htdocs/OOP/phpmailer/src/Exception.php';
require '/../xampp/htdocs/OOP/phpmailer/src/PHPMailer.php';
require '/../xampp/htdocs/OOP/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'serviseek81@gmail.com';
$mail->Password = 'txiewiaywmvjobeu';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('serviseek81@gmail.com');

$mail->addAddress($user["email"]);

$mail->isHTML(true);

$stmt = null;

if (isset($_POST["accept"])) {

    $mail->Subject = 'Registration Successfully';
    $mail->Body = "Congratulation, you can now enjoy browsing multiple Service Provider. \r\nWe\'ll make your finding specified skilled worker easy";

    $mail->send();

    $sql = "UPDATE user SET reviewed = 1 WHERE user_id = '$userid'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;
    header("Location: /../OOP/admin/userrequest.php");
} else {
    $mail->Subject = 'Registration Failed';
    $mail->Body = "Sorry, we cannot validate your registration request. \r\nPlease submit a valid information and avoid using photocopy/invalid Identification Card";

    $mail->send();

    $sql = "DELETE FROM user WHERE user_id = '$userid'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;

    header("Location: /../OOP/admin/userrequest.php");
}

// echo "<script>alert('$reviewed')</script>";
// $email = $user["email"];
// $msg = "Sorry, we cannot validate your registration request. \nPlease submit a valid information and avoid using photocopy/invalid Identification Card";
// $header = "From: serviseek81@gmail.com";
// $msg = wordwrap($msg, 70);
// mail("hermogenes.magsino2@gmail.com", "Registration Failed", $msg, $header);
