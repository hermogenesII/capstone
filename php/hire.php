<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';

if (isset($_POST['submit'])) {

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $name = $_SESSION['user_fname'] . ' ' . $_SESSION['user_lname'];
    }
    if (isset($_POST['barangay']) && !empty($_POST['barangay'])) {
        $location = $_POST['barangay'];
    } else {
        $location = $_SESSION['user_barangay'];
    }
    if (isset($_POST['contact']) && !empty($_POST['contact'])) {
        $contact = $_POST['contact'];
    } else {
        $contact = $_SESSION['user_contact'];
    }

    $seekerID = $_SESSION['user_id'];
    $providerID = $_POST['providerID'];
    $service = $_POST['service'];
    $mos = $_POST['mos'];
    $time = $_POST["preferred-time"];
    $mop = $_POST['mop'];
    $description = $_POST['description'];
    $dos = $_POST['dos'];

    $sql = "INSERT INTO services(seeker_id, provider_id, name, location, contact, service, mode, mop, description, scheduleDate, preferred_time, status) VALUES ('$seekerID', '$providerID', '$name', '$location', '$contact', '$service', '$mos', '$mop', '$description', '$dos', '$time', 'Sent')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $stmt = null;

    $notification = "sent you a request";

    $sql = "INSERT INTO notification(sender_id, receiver_id, notification, status, notification_type) VALUES ('$seekerID', '$providerID','$notification', 0, 'Hire')";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    echo "<script>
    window.setTimeout(function(){
    window.location.href = '/../OOP/practice/user-account/includes/request-SS.php';});</script>";
    echo "<script> alert('Application been sent to Provider');</script>";
}
