<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_POST["submit"])) {
    $serviceID = $_POST['serviceID'];
    $declineReason = $_POST['decline-reason'];
    $senderID = $_SESSION['user_id'];
    $receiverID = $_POST['receiverID'];

    // $sql = "SELECT services.*, DATE_FORMAT(services.date, '%M %d, %Y') AS date, TIME_FORMAT(services.date, '%h:%i %p') AS time, CONCAT(user.fname, ' ', user.lname ) AS seekerName, images.image_filename, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name FROM services INNER JOIN barangay ON services.location=barangay.barangay_code
    // INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
    // INNER JOIN province ON barangay.province_code=province.province_code
    // INNER JOIN country ON barangay.country_code=country.country_code INNER JOIN user ON services.seeker_id=user.user_id LEFT JOIN images ON services.seeker_id=images.user_id AND images.image_type='profile' WHERE services.provider_id = '$id' AND services.status = 'Sent' AND services.preferred_time != '00:00:00' ORDER BY services.service_id DESC";
    // $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    // $stmt->execute();
    // $request = $stmt->fetch(PDO::FETCH_ASSOC);
    $message = "SORRY YOUR REQUEST HAS BEEN DECLINED \n
    Service Provider: Hermogenes Magsino II\n
Service Type: Cellphone Repair\n
Location: Dolores Sta. Cruz Marinduue\n
Date: February 9, 2023\n
Time: 10:30 AM\n
Reason:\n
Ito na yung reason na atype nung service provider"
    ;
    $formattedMessage = nl2br($message);
    $stmt = null;

    $sql = "UPDATE services SET status = 'Declined' WHERE service_id = '$serviceID'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;

    $sql = "INSERT INTO message(sender_id, receiver_id, message) VALUES ('$senderID', '$receiverID','$formattedMessage')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;

    $notification = "decline your request";

    $sql = "INSERT INTO notification(sender_id, receiver_id, notification, status, notification_type) VALUES ('$senderID', '$receiverID','$notification', 0, 'Decline')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    echo "<script>
    window.setTimeout(function(){
    window.location.href = '/../OOP/practice/user-account/includes/request-SP.php';});</script>";
    echo "<script> alert('Successfully decline request');</script>";
    // header("Location: /../OOP/practice/user-account/user-account.php");

    // header("Location: /../OOP/practice/user-account/includes/request-SP.php");

}
