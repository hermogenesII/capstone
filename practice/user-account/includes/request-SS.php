<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/monitor.css">
  <link rel="stylesheet" href="../css/account-sidebar.css">
  <title>My Request</title>
</head>

<body>
  <?php
include '../account-sidebar.php';

include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$current_time = time();
$sql1 = "SELECT services.*, CONVERT(services.date, time) AS time, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, images.image_filename, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name FROM services INNER JOIN barangay ON services.location=barangay.barangay_code
INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
INNER JOIN province ON barangay.province_code=province.province_code
INNER JOIN country ON barangay.country_code=country.country_code INNER JOIN user ON services.provider_id=user.user_id LEFT JOIN images ON services.provider_id=images.user_id AND images.image_type='profile' WHERE services.seeker_id = '$id' AND services.status = 'Sent' AND services.preferred_time = '00:00:00' ORDER BY services.service_id DESC";
$stmt1 = $conn->prepare($sql1, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt1->execute();

$sql2 = "SELECT services.*, CONVERT(services.date, time) AS time, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, images.image_filename, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name FROM services INNER JOIN barangay ON services.location=barangay.barangay_code
INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
INNER JOIN province ON barangay.province_code=province.province_code
INNER JOIN country ON barangay.country_code=country.country_code INNER JOIN user ON services.provider_id=user.user_id LEFT JOIN images ON services.provider_id=images.user_id AND images.image_type='profile' WHERE services.seeker_id = '$id' AND services.status = 'Sent' AND services.preferred_time != '00:00:00' ORDER BY services.service_id DESC";
$stmt2 = $conn->prepare($sql2, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt2->execute();
?>

  <section class="myaccount-tabcontent" id="my-request-SS">
    <h1><i class="fa-solid fa-screwdriver-wrench"></i> My Request Service</h1>
    <!-- <div class="parag"> -->
    <p>View and manage all of the services you've purchased.</p>
    <!-- </div> -->
    <hr>
    <h2>Rush</h2>
    <div id="monitor_request" class="inquiry-grid">
      <?php
if ($stmt2->rowCount() == 0) {
    echo "<p>No Request </p>";
} else {
    while ($request2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $profile = $request2['image_filename'] == null ? "default.png" : $request2['image_filename'];?>
          <div class="inquiry">
            <div class="inquiry-account-profile">
              <img src="/../OOP/images/photo/<?php echo $profile; ?> " />
              <h2><?php echo $request2["providerName"]; ?></h2>
            </div>
            <div class="inquiry-basic-information">
              <hr>
              <ul>
                <li>
                  <p class="info"><i class="fa-solid fa-user"></i> Name:</p>
                  <label for="info"><?php echo $request2["name"]; ?></label>
                </li>
                <li>
                  <p class="info"><i class="fa-solid fa-location-dot"></i> Location:</p>
                  <label for="info"><?php echo $request2["barangay_name"] . ' ' . $request2["municipality_name"] . ' ' . $request2["province_name"] . ' ' . $request2["country_name"]; ?> </label>
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
                  <label for="info"><?php echo $request2["mode"]; ?></label>
                </li>
                <li>
                  <p class="info"><i class="fa-solid fa-plus"></i> Other Description/Issue:</p>
                  <label class="des-info" for="info">
                    <div class="description-info">
                      <p><?php echo $request2["description"]; ?></p>
                    </div>
                  </label>
                </li>
              </ul>
            </div>
            <div class="btns">
              <a href="/../OOP/pages/service-provider.php?userid=<?php echo $request2['provider_id']; ?>"><button id="pindot"><i class="fa-solid fa-user"></i> View Profile</button></a>
              <form class="POST" action="/../OOP/php/request_cancel.php" method="post">
                <input type="hidden" name="serviceID" value="<?php echo $request2["service_id"]; ?>" />
                <input type="hidden" name="providerID" value="<?php echo $request2["provider_id"]; ?>" />
                <!-- Accept -->
                <?php if (((strtotime($request2["time"]) - $current_time)) >= 18000) {?>
                <label for="acceptBtn<?php echo $request2["service_id"]; ?>"><i class="fa-solid fa-ban"></i> Cancel</label> <?php } else {?>
                  <a href="/../OOP/pages/service-provider.php?userid=<?php echo $request2['provider_id']; ?>"><button id="pindot"><i class="fa-solid fa-paper-plane"></i> Message</button></a>
                  <?php }?>
                <input type="checkbox" class="acceptBtn" id="acceptBtn<?php echo $request2["service_id"]; ?>">
                <div class="accept-container">
                  <div class="accept-prompt">
                    <h1>Are you sure you want to cancel?</h1>
                    <div>
                      <button type="button" id="back2" class="back2"><i class="fa-solid fa-ban"></i> Cancel</button>
                      <button type="submit" name="submit"><i class="fa-solid fa-check"></i> Yes</button>
                    </div>
                  </div>
                </div>


            </div>
            </form>
          </div>
      <?php
// echo "<script>alert(" . strtotime($request1['time']) . ");</script>";
//         echo "<script>alert($current_time);</script>";
        // echo var_dump(($request1['time']));
        // echo var_dump(strtotime($request1['time']) - $current_time);
        // echo var_dump($current_time - strtotime($request1['time']));
    }
}
?>
    </div>
    <h2>Not Rush</h2>

    <div id="monitor_request1" class="inquiry-grid">
      <?php
if ($stmt1->rowCount() == 0) {
    echo "<p>No Request </p>";
} else {
    while ($request1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $profile = $request1['image_filename'] == null ? "default.png" : $request1['image_filename'];?>
          <div class="inquiry">
            <div class="inquiry-account-profile">
              <img src="/../OOP/images/photo/<?php echo $profile; ?> " />
              <h2><?php echo $request1["providerName"]; ?></h2>
            </div>
            <div class="inquiry-basic-information">
              <hr>
              <ul>
                <li>
                  <p class="info"><i class="fa-solid fa-user"></i> Name:</p>
                  <label for="info"><?php echo $request1["name"]; ?></label>
                </li>
                <li>
                  <p class="info"><i class="fa-solid fa-location-dot"></i> Location:</p>
                  <label for="info"><?php echo $request1["barangay_name"] . ' ' . $request1["municipality_name"] . ' ' . $request1["province_name"] . ' ' . $request1["country_name"]; ?> </label>
                </li>
                <li>
                  <p class="info"><i class="fa-solid fa-phone"></i> Contact Number:</p>
                  <label for="info"><?php echo $request1["contact"]; ?></label>
                </li>
                <li>
                  <p class="info"><i class="fa-solid fa-screwdriver-wrench"></i> Service Request:</p>
                  <label for="info"><?php echo $request1["service"]; ?></label>
                </li>
                <li>
                  <p class="info"><i class="fa-solid fa-calendar-days"></i> Date Schedule:</p>
                  <label for="info"><?php echo $request1["scheduleDate"]; ?></label>
                </li>
                <li>
                  <p class="info"><i class="fa-solid fa-hand-holding-dollar"></i> Mode of Service:</p>
                  <label for="info"><?php echo $request1["mode"]; ?></label>
                </li>
                <li>
                  <p class="info"><i class="fa-solid fa-plus"></i> Other Description/Issue:</p>
                  <label class="des-info" for="info">
                    <div class="description-info">
                      <p><?php echo $request1["description"]; ?></p>
                    </div>
                  </label>
                </li>
              </ul>
            </div>
            <div class="btns">
              <a href="/../OOP/pages/service-provider.php?userid=<?php echo $request1['provider_id']; ?>"><button id="pindot"><i class="fa-solid fa-user"></i> View Profile</button></a>
              <form class="POST" action="/../OOP/php/request_cancel.php" method="post">
                <input type="hidden" name="serviceID" value="<?php echo $request1["service_id"]; ?>" />
                <input type="hidden" name="providerID" value="<?php echo $request1["provider_id"]; ?>" />
                <!-- Accept -->
                <?php if (((strtotime($request1["time"]) - $current_time)) >= 18000) {?>
                <label for="acceptBtn<?php echo $request1["service_id"]; ?>"><i class="fa-solid fa-ban"></i> Cancel</label> <?php } else {?>
                  <a href="/../OOP/pages/service-provider.php?userid=<?php echo $request1['provider_id']; ?>"><button id="pindot"><i class="fa-solid fa-paper-plane"></i> Message</button></a>
                  <?php }?>
                <input type="checkbox" class="acceptBtn" id="acceptBtn<?php echo $request1["service_id"]; ?>">
                <div class="accept-container">
                  <div class="accept-prompt">
                    <h1>Are you sure you want to cancel?</h1>
                    <div>
                      <button type="button" id="back2" class="back2"><i class="fa-solid fa-ban"></i> Cancel</button>
                      <button type="submit" name="submit"><i class="fa-solid fa-check"></i> Yes</button>
                    </div>
                  </div>
                </div>


            </div>
            </form>
          </div>
      <?php
// echo "<script>alert(" . strtotime($request1['time']) . ");</script>";
//         echo "<script>alert($current_time);</script>";
        // echo var_dump(($request1['time']));
        // echo var_dump(strtotime($request1['time']) - $current_time);
        // echo var_dump($current_time - strtotime($request1['time']));
    }
}
?>
    </div>
  </section>

  <!-- <script src="/../OOP/js/monitor_request.js"></script> -->
  <script>
    let acceptBtn = document.querySelectorAll('.acceptBtn'); // Select all accept buttons
let acceptContainers = document.querySelectorAll('.accept-container'); // Select all accept containers

acceptBtn.forEach(function(button, index) {
  button.addEventListener('click', function() {
    acceptContainers[index].style.visibility = 'visible'; // Show the accept container div
  });
});

// let declineBtn = document.querySelectorAll('.declineBtn'); // Select all decline buttons
// let declineContainers = document.querySelectorAll('.decline-container'); // Select all decline containers

// declineBtn.forEach(function(button, index) {
//   button.addEventListener('click', function() {
//     declineContainers[index].style.visibility = 'visible';
//     // Show the decline container div
//   });
// });


    // const checkbox = document.querySelector('#checkbox');
    // let button1 = document.querySelectorAll('.back1');
    let button2 = document.querySelectorAll('.back2');

//     button1.forEach(function(button, index) {
//   button.addEventListener('click', function() {
//     declineContainers[index].style.visibility = 'hidden';
//     // Show the decline container div
//   });
// });

button2.forEach(function(button, index) {
  button.addEventListener('click', function() {
    acceptContainers[index].style.visibility = 'hidden';
    // Show the decline container div
  });
});
  </script>
</body>

</html>


<!-- <div class="inquiry">
      <div class="inquiry-account-profile">
        <img src="./4.png" />
        <h2>Hermogenes II Pelaez-Magsino</h2>
      </div>
      <div class="inquiry-basic-information">
        <hr>
        <ul>
          <li>
            <p class="info"><i class="fa-solid fa-user"></i> Name:</p>
            <label for="info">Erwin Jardeleza</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-location-dot"></i> Location:</p>
            <label for="info"> Caigangan, Buenavista, Marinduque </label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-phone"></i> Contact Number:</p>
            <label for="info">09466732135</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-screwdriver-wrench"></i> Service Request:</p>
            <label for="info">Cellphone Repair</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-calendar-days"></i> Date Schedule:</p>
            <label for="info">06/14/2022</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-hand-holding-dollar"></i> Mode of Service:</p>
            <label for="info">Walk In</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-plus"></i> Other Description/Issue:</p>
            <label for="info">
              <div class="description-info">Magapa ayos ng nasirang puso</div>
            </label>
          </li>
        </ul>
      </div>
      <button id="pindot"><i class="fa-solid fa-paper-plane"></i> Send Message</button>
      <button><i class="fa-sharp fa-solid fa-ban"></i> Cancel</button>
    </div> -->