<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT services.*, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, images.image_filename FROM services INNER JOIN user ON services.seeker_id=user.user_id LEFT JOIN images ON services.seeker_id=images.user_id AND image.image_type = 'profile' WHERE services.provider_id = '$id' AND (services.status = 'Pending' OR services.status = 'On-process')";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$monitorRequest = "";

if ($stmt->rowCount() == 0) {
    $monitorRequest .= "No pending Status";
} else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($request["mode"] == "pick-up") {
            echo '  <option value="On-process">On Process</option>
                    <option value="Finished">Finished</option>';
        } else {
            echo '<option value="Finished">Finished</option>';
        }

        $monitorRequest .= '<tr>
                                <td>' . $request["service_id"] . '</td>
                                <td><a href="/../OOP/pages/message.php?userid=' . $request["provider_id"] . '">' . $request["providerName"] . '</a></td>
                                <td>' . $request["service"] . '</td>
                                <td>' . $request["contact"] . '</td>
                                <td>
                                <select class="select">
                                <option disabled selected>' . $request["status"] . '</option>
                                <option value="On-process">On Process</option>
                                <option value="Finished">Finished</option>
                            </select>
                                </td>
                            </tr>
        ';
    }
}
echo $monitorRequest;
