<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/service.css">
  <link rel="stylesheet" href="../css/account-sidebar.css">
  <title>Request</title>
</head>

<body></body>
  <?php
include '../account-sidebar.php';
?>
  <section class="myaccount-tabcontent" id="my-request-SP">
    <h1><i class="fa-solid fa-screwdriver-wrench"></i> Service Seeker Request</h1>
    <div class="parag">
      <p>Keep track of and manage service seeker requests.</p>
    </div>
    <hr>
    <div id="service_request">
      <h3>Rush</h3>
      <div class="inquiry-grid">
        <?php

include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sq2 = "SELECT services.*, DATE_FORMAT(services.date, '%M %d, %Y') AS date, TIME_FORMAT(services.date, '%h:%i %p') AS time, CONCAT(user.fname, ' ', user.lname ) AS seekerName, images.image_filename, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name FROM services INNER JOIN barangay ON services.location=barangay.barangay_code
INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
INNER JOIN province ON barangay.province_code=province.province_code
INNER JOIN country ON barangay.country_code=country.country_code INNER JOIN user ON services.seeker_id=user.user_id LEFT JOIN images ON services.seeker_id=images.user_id AND images.image_type='profile' WHERE services.provider_id = '$id' AND services.status = 'Sent' AND services.preferred_time != '00:00:00' ORDER BY services.service_id DESC";
$stmt2 = $conn->prepare($sq2, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt2->execute();

// $monitorRequest = "";

if ($stmt2->rowCount() == 0) {?>
          <p>You haven't yet sent a request.</p>
          <?php } else {
    while ($request2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $profile = $request2['image_filename'] == null ? "default.png" : $request2['image_filename'];?>
            <!-- $monitorRequest .= ' -->
            <div class="inquiry">
              <div class="inquiry-account-profile">
                <img src="/../OOP/images/photo/<?php echo $profile; ?>" />
                <h2><?php echo $request2["seekerName"]; ?>
                <p><?php echo $request2["date"]; ?></p>
                <p><?php echo $request2["time"]; ?></p>
              </h2>

              </div>
              <div class="inquiry-basic-information">
                <hr>
                <ul>
                <?php if ($request2["name"] != $request2["seekerName"]) {?>
                  <li>
                    <p class="info"><i class="fa-solid fa-user"></i> Name:</p>
                    <label for="info"><?php echo $request2["name"]; ?></label>
                  </li>
                  <?php }?>
                  <li>
                    <p class="info"><i class="fa-solid fa-location-dot"></i> Location:</p>
                    <a href="/../OOP/pages/map.php?location=<?php echo $request2['location']; ?>">
                    <label for="info"><?php echo $request2["barangay_name"] . ' ' . $request2["municipality_name"] . ' ' . $request2["province_name"] . ' ' . $request2["country_name"]; ?></label>  <i class="fa-solid fa-location-dot"></i></a>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-phone"></i> Contact Number:</p>
                    <label for="info"><?php echo $request2["contact"]; ?></label>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-screwdriver-wrench"></i> Service Request:</p>
                    <label for="info"><?php echo $request2["service"]; ?></label>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-calendar-days"></i> Date Schedule:</p>
                    <label for="info"><?php echo $request2["scheduleDate"]; ?></label>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-hand-holding-dollar"></i> Mode of Service:</p>
                    <label for="info">Walk In</label>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-plus"></i> Other Description/Issue:</p>
                    <label for="info">
                      <div class="description-info"><?php echo $request2["description"]; ?></div>
                    </label>
                  </li>
                </ul>
              </div>
              <div class="btns">
              <a href="/../OOP/pages/service-provider.php?userid=<?php echo $request2["seeker_id"]; ?>">
                <button class="view"><i class="fa-solid fa-paper-plane"></i> View Profile</button>
              </a>

                <form class="POST" action="/../OOP/php/request_accept.php" method="post">
                  <!-- Accept -->
                  <label for="acceptBtn<?php echo $request2["service_id"]; ?>"><i class="fa-solid fa-check" aria-hidden="true"></i> Accept</label>
                  <input type="checkbox" class="acceptBtn" id="acceptBtn<?php echo $request2["service_id"]; ?>">
                  <div class="accept-container">
                    <div class="accept-prompt">
                      <h1>Are you sure you want to Accept it?</h1>
                      <input type="hidden" name="serviceID" value="<?php echo $request2["service_id"]; ?>" />
                      <input type="hidden" name="receiverID" value="<?php echo $request2["seeker_id"]; ?>" />
                      <div>
                        <button type="button" id="back2" class="back2">Cancel</button>
                        <button type="submit" name="submit" value="Accept" class="accept">OK</button>
                      </div>
                    </div>
                  </div>
                  <!-- <button type="submit" name="submit"><i class="fa-solid fa-square-check"></i> Accept</button> -->
                </form>

                <form class="POST" action="/../OOP/php/request_decline.php" method="post">

                  <!-- Decline -->
                  <label for="declineBtn<?php echo $request2["service_id"]; ?>"><i class="fa-solid fa-times" aria-hidden="true"></i> Decline</label>
                  <input type="checkbox" class="declineBtn" id="declineBtn<?php echo $request2["service_id"]; ?>">
                  <div class="decline-container">
                    <div class="decline-prompt">
                      <h1>Are you sure you want to decline it?</h1>
                      <h3>Please explain why you are declining the request here.</h3>
                      <input type="hidden" name="serviceID" value="<?php echo $request2["service_id"]; ?>" />
                      <input type="hidden" name="receiverID" value="<?php echo $request2["seeker_id"]; ?>" />
                      <!-- <input type="text" class="reason" name="decline-reason" required /> -->
                      <textarea name="decline-reason" class="reason" required></textarea>
                      <div>
                        <button type="button" id="back1" class="back1">Cancel</button>
                        <button type="submit" name="submit" value="Accept" class="accept" style="pointer-events: auto;">OK</button>
                      </div>
                    </div>
                  </div>

                  <!-- <button type="submit" name="submit"><i class="fa-sharp fa-solid fa-ban"></i> Decline</button> -->
                </form>
              </div>
            </div>
        <?php }
}?>
      </div>

    <h3>Not Rush</h3>
    <div class="inquiry-grid">


        <?php

include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT services.*, DATE_FORMAT(services.date, '%M %d, %Y') AS date, TIME_FORMAT(services.date, '%h:%i %p') AS time, CONCAT(user.fname, ' ', user.lname ) AS seekerName, images.image_filename, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name FROM services INNER JOIN barangay ON services.location=barangay.barangay_code
INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
INNER JOIN province ON barangay.province_code=province.province_code
INNER JOIN country ON barangay.country_code=country.country_code INNER JOIN user ON services.seeker_id=user.user_id LEFT JOIN images ON services.seeker_id=images.user_id AND images.image_type='profile' WHERE services.provider_id = '$id' AND services.status = 'Sent' AND services.preferred_time = '00:00:00' ORDER BY services.service_id DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

// $monitorRequest = "";

if ($stmt->rowCount() == 0) {?>
          <p>You haven't yet sent a request.</p>
          <?php } else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $profile = $request['image_filename'] == null ? "default.png" : $request['image_filename'];?>
            <!-- $monitorRequest .= ' -->
            <div class="inquiry">
              <div class="inquiry-account-profile">
                <img src="/../OOP/images/photo/<?php echo $profile; ?>" />
                <h2><?php echo $request["seekerName"]; ?>
                <p><?php echo $request["date"]; ?></p>
                <p><?php echo $request["time"]; ?></p>
              </h2>

              </div>
              <div class="inquiry-basic-information">
                <hr>
                <ul>
                <?php if ($request["name"] != $request["seekerName"]) {?>
                  <li>
                    <p class="info"><i class="fa-solid fa-user"></i> Name:</p>
                    <label for="info"><?php echo $request["name"]; ?></label>
                  </li>
                  <?php }?>
                  <li>
                    <p class="info"><i class="fa-solid fa-location-dot"></i> Location:</p>
                    <a href="/../OOP/pages/map.php?location=<?php echo $request['location']; ?>">
                    <label for="info"><?php echo $request["barangay_name"] . ' ' . $request["municipality_name"] . ' ' . $request["province_name"] . ' ' . $request["country_name"]; ?></label>  <i class="fa-solid fa-location-dot"></i></a>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-phone"></i> Contact Number:</p>
                    <label for="info"><?php echo $request["contact"]; ?></label>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-screwdriver-wrench"></i> Service Request:</p>
                    <label for="info"><?php echo $request["service"]; ?></label>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-calendar-days"></i> Date Schedule:</p>
                    <label for="info"><?php echo $request["scheduleDate"]; ?></label>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-hand-holding-dollar"></i> Mode of Service:</p>
                    <label for="info">Walk In</label>
                  </li>
                  <li>
                    <p class="info"><i class="fa-solid fa-plus"></i> Other Description/Issue:</p>
                    <label for="info">
                      <div class="description-info"><?php echo $request["description"]; ?></div>
                    </label>
                  </li>
                </ul>
              </div>
              <div class="btns">
              <a href="/../OOP/pages/service-provider.php?userid=<?php echo $request["seeker_id"]; ?>">
                <button class="view"><i class="fa-solid fa-paper-plane"></i> View Profile</button>
              </a>

                <form class="POST" action="/../OOP/php/request_accept.php" method="post">
                  <!-- Accept -->
                  <label for="acceptBtn<?php echo $request["service_id"]; ?>"><i class="fa-solid fa-check" aria-hidden="true"></i> Accept</label>
                  <input type="checkbox" class="acceptBtn" id="acceptBtn<?php echo $request["service_id"]; ?>">
                  <div class="accept-container">
                    <div class="accept-prompt">
                      <h1>Are you sure you want to Accept it?</h1>
                      <input type="hidden" name="serviceID" value="<?php echo $request["service_id"]; ?>" />
                      <input type="hidden" name="receiverID" value="<?php echo $request["seeker_id"]; ?>" />
                      <div>
                        <button type="button" id="back2" class="back2">Cancel</button>
                        <button type="submit" name="submit" value="Accept" class="accept">OK</button>
                      </div>
                    </div>
                  </div>
                  <!-- <button type="submit" name="submit"><i class="fa-solid fa-square-check"></i> Accept</button> -->
                </form>

                <form class="POST" action="/../OOP/php/request_decline.php" method="post">

                  <!-- Decline -->
                  <label for="declineBtn<?php echo $request["service_id"]; ?>"><i class="fa-solid fa-times" aria-hidden="true"></i> Decline</label>
                  <input type="checkbox" class="declineBtn" id="declineBtn<?php echo $request["service_id"]; ?>">
                  <div class="decline-container">
                    <div class="decline-prompt">
                      <h1>Are you sure you want to decline it?</h1>
                      <h3>Please explain why you are declining the request here.</h3>
                      <input type="hidden" name="serviceID" value="<?php echo $request["service_id"]; ?>" />
                      <input type="hidden" name="receiverID" value="<?php echo $request["seeker_id"]; ?>" />
                      <!-- <input type="text" class="reason" name="decline-reason" required /> -->
                      <textarea name="decline-reason" class="reason" required></textarea>
                      <div>
                        <button type="button" id="back1" class="back1">Cancel</button>
                        <button type="submit" name="submit" value="Accept" class="accept" style="pointer-events: auto;">OK</button>
                      </div>
                    </div>
                  </div>

                  <!-- <button type="submit" name="submit"><i class="fa-sharp fa-solid fa-ban"></i> Decline</button> -->
                </form>
              </div>
            </div>
        <?php }
}?>
      </div>

    </div>

  </section>


  <!-- <script src="/../OOP/js/service_request.js"></script> -->
  <script>
    let acceptBtn = document.querySelectorAll('.acceptBtn'); // Select all accept buttons
let acceptContainers = document.querySelectorAll('.accept-container'); // Select all accept containers

acceptBtn.forEach(function(button, index) {
  button.addEventListener('click', function() {
    acceptContainers[index].style.visibility = 'visible'; // Show the accept container div
  });
});

let declineBtn = document.querySelectorAll('.declineBtn'); // Select all decline buttons
let declineContainers = document.querySelectorAll('.decline-container'); // Select all decline containers

declineBtn.forEach(function(button, index) {
  button.addEventListener('click', function() {
    declineContainers[index].style.visibility = 'visible';
    // Show the decline container div
  });
});


    // const checkbox = document.querySelector('#checkbox');
    let button1 = document.querySelectorAll('.back1');
    let button2 = document.querySelectorAll('.back2');

    button1.forEach(function(button, index) {
  button.addEventListener('click', function() {
    declineContainers[index].style.visibility = 'hidden';
    // Show the decline container div
  });
});

button2.forEach(function(button, index) {
  button.addEventListener('click', function() {
    acceptContainers[index].style.visibility = 'hidden';
    // Show the decline container div
  });
});
  </script>
</body>

</html>