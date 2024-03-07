<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT services.*, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS seekerName, images.image_filename FROM services INNER JOIN user ON services.seeker_id=user.user_id LEFT JOIN images ON services.seeker_id=images.user_id AND images.image_type='profile' WHERE services.provider_id = '$id' AND services.status = 'Sent'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$monitorRequest = "";

if ($stmt->rowCount() == 0) {
    $monitorRequest .= "No Subscription Request";
} else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $profile = $request['image_filename'] == null ? "default.png" : $request['image_filename'];
        $monitorRequest .= '       <div class="inquiry">
        <div class="inquiry-account-profile">
          <img src="/../OOP/images/photo/' . $profile . '" />
          <h2>' . $request["seekerName"] . '</h2>
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
              <label for="info"> ' . $request["location"] . ' </label>
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
              <label for="info">Walk In</label>
            </li>
            <li>
              <p class="info"><i class="fa-solid fa-plus"></i> Other Description/Issue:</p>
              <label for="info">
                <div class="description-info">' . $request["description"] . '</div>
              </label>
            </li>
          </ul>
        </div>
        <div class="btns">
        <button><i class="fa-solid fa-paper-plane"></i> <a href="/../OOP/pages/service-provider.php?userid=' . $request["seeker_id"] . '">View Profile</a></button>
        <form class="POST" action="/../OOP/php/request_accept.php" method="post">
        <input type="hidden" name="serviceID" value="' . $request["service_id"] . '" />
        <input type="hidden" name="receiverID" value="' . $request["seeker_id"] . '" />
        <button type="submit" name="submit"><i class="fa-solid fa-square-check"></i> Accept</button>
        </form>
        <form class="POST" action="/../OOP/php/request_decline.php" method="post">
        <input type="hidden" name="serviceID" value="' . $request["service_id"] . '" />
        <input type="hidden" name="receiverID" value="' . $request["seeker_id"] . '" />
        <button type="submit" name="submit"><i class="fa-sharp fa-solid fa-ban"></i> Decline</button>
        </form>
      </div>
      </div>
        ';
    }
}
echo $monitorRequest;
