<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT services.*, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, images.image_filename, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name FROM services INNER JOIN barangay ON services.location=barangay.barangay_code
INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
INNER JOIN province ON barangay.province_code=province.province_code
INNER JOIN country ON barangay.country_code=country.country_code INNER JOIN user ON services.provider_id=user.user_id LEFT JOIN images ON services.provider_id=images.user_id AND images.image_type='profile' WHERE services.seeker_id = '$id' AND services.status = 'Sent' ORDER BY services.service_id DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$monitorRequest = "";

if ($stmt->rowCount() == 0) {
    $monitorRequest .= "<p>No Request </p>";
} else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $profile = $request['image_filename'] == null ? "default.png" : $request['image_filename'];
        $monitorRequest .= '  <div class="inquiry">
                    <div class="inquiry-account-profile">
                    <img src="/../OOP/images/photo/' . $profile . '" />
                    <h2>' . $request["providerName"] . '</h2>
                    </div>
                    <div class="inquiry-basic-information">
                    <hr>
                    <ul>
                        <li>
                        <p class="info"><i class="fa-solid fa-user"></i> Name:</p>
                        <label for="info">' . $request["name"] . '</label>
                        </li>
                        <li>
                        <p class="info"><i class="fa-solid fa-location-dot"></i> Location:</p>
                        <label for="info"> ' . $request["barangay_name"] . ' ' . $request["municipality_name"] . ' ' . $request["province_name"] . ' ' . $request["country_name"] . ' </label>
                        </li>
                        <li>
                        <p class="info"><i class="fa-solid fa-phone"></i> Contact Number:</p>
                        <label for="info">' . $request["contact"] . '</label>
                        </li>
                        <li>
                        <p class="info"><i class="fa-solid fa-screwdriver-wrench"></i> Service Request:</p>
                        <label for="info">' . $request["service"] . '</label>
                        </li>
                        <li>
                        <p class="info"><i class="fa-solid fa-calendar-days"></i> Date Schedule:</p>
                        <label for="info">' . $request["scheduleDate"] . '</label>
                        </li>
                        <li>
                        <p class="info"><i class="fa-solid fa-hand-holding-dollar"></i> Mode of Service:</p>
                        <label for="info">' . $request["mode"] . '</label>
                        </li>
                        <li>
                        <p class="info"><i class="fa-solid fa-plus"></i> Other Description/Issue:</p>
                        <label class="des-info" for="info">
                            <div class="description-info"><p>' . $request["description"] . '</p></div>
                        </label>
                        </li>
                    </ul>
                    </div>
                        <div class="btns">
                        <a href="/../OOP/pages/service-provider.php?userid=' . $request["provider_id"] . '"><button id="pindot"><i class="fa-solid fa-paper-plane"></i> View Profile</button></a>
                        <form class="POST" action="/../OOP/php/request_cancel.php" method="post">
                        <input type="hidden" name="serviceID" value="' . $request["service_id"] . '" />
                        <input type="hidden" name="providerID" value="' . $request["provider_id"] . '" />
                        <button type="submit" name="submit"><i class="fa-sharp fa-solid fa-ban"></i> Cancel</button>
                        </div>
                    </form>
                    </div>

        ';
    }
}
echo $monitorRequest;
