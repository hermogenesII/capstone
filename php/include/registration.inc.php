<?php
// include './autoloader.inc.php';

$fname = $_POST['firstname'];
$mname = $_POST['middlename'];
$lname = $_POST['lastname'];
$dob = $_POST['dateob'];
$contact = $_POST['contact'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$province = $_POST['province'];
$municipality = $_POST['municipality'];
$barangay = $_POST['barangay'];
$terms = $_POST['terms'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordRepeat = $_POST['confirm-password'];

// $imageCount = count($_FILES["valid-id"]["name"]);
// for ($i = 0; $i < $imageCount; $i++) {
//     $imageName = $_FILES["valid-id"]["name"];
// }
$imageName = $_FILES["valid-id"]["name"];
$imageSize = $_FILES["valid-id"]["size"];
$tmpName = $_FILES["valid-id"]["tmp_name"];

// print_r($imageName);
// print_r($imageSize);
// print_r($tmpName);

include "../classes/dbConn.php";
include "../classes/registration/registration.class.php";
include "../classes/registration/registration-cntrl.class.php";
$register = new RegistrationCntrl($fname, $mname, $lname, $dob, $contact, $gender, $country, $province, $municipality, $barangay, $terms, $username, $email, $password, $passwordRepeat, $imageName, $tmpName, $imageSize);

$register->registerUser();
$register->insertID();

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

$mail->addAddress($email);

$mail->isHTML(true);

$mail->Subject = 'Information under reviewed by administrator';
$mail->Body = "You've successfully fill-up registration.. \r\nPlease wait for the confirmation";

$mail->send();

// header("Location: /../OOP/pages/login.php");
echo "<script>
window.setTimeout(function(){
window.location.href = '/../OOP/pages/login.php';});</script>";
echo "<script> alert('Your registration is under review by the administrator. Please, wait for the confirmation through your provided email address');</script>";
