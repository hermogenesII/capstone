<?php

$sql = "SELECT fname, mname, lname, username, email, contact, address, dob, gender FROM user WHERE user_id = :user_id";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
