<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT services.*, CONVERT(services.date, date) AS date, CONVERT(services.date, time) AS time, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, images.image_filename, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name  FROM services INNER JOIN barangay ON services.location=barangay.barangay_code
INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
INNER JOIN province ON barangay.province_code=province.province_code
INNER JOIN country ON barangay.country_code=country.country_code INNER JOIN user ON services.provider_id=user.user_id LEFT JOIN images ON services.provider_id=images.user_id AND images.image_type = 'profile' WHERE services.seeker_id = '$id' AND (services.status = 'Finished' OR services.status = 'Cancelled' OR services.status = 'Declined') ORDER BY services.service_id DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$monitorRequest = "";

if ($stmt->rowCount() == 0) {
    $monitorRequest .= "<p>No History yet</p>";
} else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $profile = $request['image_filename'] == null ? "default.png" : $request['image_filename'];
        $rate = "";
        if ($request["status"] == "Finished") {
            $rate = "<a class='rate'href=\'/../OOP/pages/review.php?userid=" . $request["provider_id"] . "\'>Rate</a>";
        } else {
            $rate = "<button class='rate'>Not Available</button>";
        }
        $monitorRequest .= '  <tr>
                                <td style="width: 80px;">' . $request["date"] . '</td>
                                <td style="width: 80px;">' . $request["time"] . '</td>
                                <td style="width: 110px;">' . $request["service"] . '</td>
                                <td style="width: 140px;">' . $request["contact"] . '</td>
                                <td style="width: 220px;">' . $request["barangay_name"] . ' ' . $request["municipality_name"] . ' ' . $request["province_name"] . ' ' . $request["country_name"] . '</td>
                                <td style="width: 100px;"> <p>' . $request["status"] . '</p></td>
                                <td><a href="/../OOP/pages/message.php?userid=' . $request["provider_id"] . '">' . $request["providerName"] . '</a></td>
                                <td>' . $rate . '</td>
                            </tr>
        ';
    }
}
echo $monitorRequest;
