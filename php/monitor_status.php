<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT services.*, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, images.image_filename FROM services INNER JOIN user ON services.provider_id=user.user_id LEFT JOIN images ON services.provider_id=images.user_id AND images.image_type = 'profile' WHERE services.seeker_id = '$id' AND (services.status = 'Pending' OR services.status = 'On-Process') ORDER BY services.service_id DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$monitorRequest = "";

if ($stmt->rowCount() == 0) {
    $monitorRequest .= "<p>No Services </p>";
} else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // $profile = $request['image_filename'] == null ? "default.png" : $request['image_filename'];
        $monitorRequest .= '<tr>

                                <td style="width: 200px;"><a href="/../OOP/pages/message.php?userid=' . $request["provider_id"] . '">' . $request["providerName"] . '</a></td>
                                <td style="width: 140px;">' . $request["service"] . '</td>
                                <td style="width: 170px;">' . $request["contact"] . '</td>
                                <td style="width: 150px;">' . $request["mop"] . '</td>
                                <td style="width: 120px;">
                                <p>' . $request["status"] . '</p>
                                </td>
                            </tr>
        ';
    }
}
echo $monitorRequest;
