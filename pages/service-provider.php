<?php
// session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
$userid = $_GET['userid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <link rel="stylesheet" href="../css/include/header.css">
  <link rel="stylesheet" href="../css/service-provider/service-provider.css">

  <title>Servi-Seek</title>

</head>

<body>

  <?php include '../includes/header.php';?>
  <div class="page_container">
    <h1><i class="fa-solid fa-user-secret"></i> <?php
$sql1 = "SELECT user_provider.Service_description, subcategory.Subcategory FROM user_provider
    LEFT JOIN subcategory ON subcategory.Subcategory_id=user_provider.Subcategory_id
    WHERE user_provider.user_id = '$userid'";
$stmt1 = $conn->prepare($sql1, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt1->execute();
if ($stmt1->rowCount() > 0) {?> Service Provider <?php } else {?> Service Seeker <?php }?></h1>
    <div class="container">
      <div class="service-provider">
        <section class="basic-info">
          <?php
// $sql = "SELECT user.*, user_provider.Service_description, subcategory.Subcategory, barangay.*, images.image_filename FROM user
//           LEFT JOIN user_provider ON user.user_id=user_provider.user_id
//             LEFT JOIN subcategory ON subcategory.Subcategory_id=user_provider.Subcategory_id
//             LEFT JOIN images ON user.user_id=images.user_id
//             LEFT JOIN barangay ON user.address=barangay.barangay_code
//           INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
//             INNER JOIN province ON province.province_code=barangay.province_code
//             INNER JOIN country ON barangay.country_code=country.country_code WHERE user.user_id = '$userid;"

$sql = "SELECT user.*, barangay.barangay_name, municipality.municipality_name, province.province_name, country.country_name, images.image_filename FROM user
LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile'
LEFT JOIN barangay ON user.address=barangay.barangay_code
INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
INNER JOIN province ON province.province_code=barangay.province_code
INNER JOIN country ON barangay.country_code=country.country_code WHERE user.user_id = '$userid'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$info = $stmt->fetch(PDO::FETCH_ASSOC);
// $stmt = null;

$sql2 = "SELECT user_provider.Service_description, subcategory.Subcategory FROM user_provider
          LEFT JOIN subcategory ON subcategory.Subcategory_id=user_provider.Subcategory_id
          WHERE user_provider.user_id = '$userid'";
$stmt2 = $conn->prepare($sql2, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt2->execute();

?>
          <div class="basic-info-top">
            <?php $infoImg = $info['image_filename'] === null ? "default.png" : $info['image_filename'];?>
            <img src="/../OOP/images/photo/<?php echo $infoImg; ?>" alt="" />
            <div class="service-provider-btn">
              <?php if ($stmt2->rowCount() > 0) {?>
                <button><i class="fa-solid fa-square-minus"></i><a href="/../OOP/pages/hire.php?userid=<?php echo $info['user_id'] ?>">Hire</a> </button>
              <?php }?>
              <button><i class="fa-solid fa-message"></i><a href="/../OOP/pages/message.php?userid=<?php echo $info['user_id'] ?>">Message</a> </button>
            </div>
          </div>
          <div class="basic-info-bot">
            <hr>
            <ul>
              <li>
                <p class="info"><i class="fa-solid fa-user"></i> Name:</p>
                <label for="info"> <?php echo $info['fname'] . " " . $info['mname'] . " " . $info['lname'] ?></label>
              </li>
              <li>
                <p class="info"><i class="fa-solid fa-location-dot"></i> Address:</p>
                <a href="/../OOP/pages/map.php?location=<?php echo $info['address']; ?>">
                  <label for="info"><?php echo $info['barangay_name'] . " " . $info['municipality_name'] . " " . $info['province_name'] . " " . $info['country_name'] ?> <i class="fa-solid fa-location-dot"></i></label></a>
              </li>
              <li>
                <p class="info"><i class="fa-solid fa-phone"></i> Mobile Number:</p>
                <label for="info">
                  <label for="info"><?php echo $info['contact'] ?></label>
              </li>
              <li>
                <p class="info"><i class="fa-solid fa-envelope"></i> Email Address:</p>
                <label for="info"><?php echo $info['email'] ?></label>
              </li>
              <?php
if ($stmt2->rowCount() > 0) {?>

                <li>
                  <p class="info"><i class="fa-solid fa-screwdriver-wrench"></i> Service Offered:</p>
                  <label for="info">
                    <div class="services">
                      <?php
$stmt2->execute();
    while ($services = $stmt2->fetch(PDO::FETCH_ASSOC)) {?>
                        <h3 class="subcategory"> <?php echo $services['Subcategory']; ?></h3>
                        <p class="description"> <?php echo $services['Service_description']; ?></p>
                      <?php }?>
                    </div>

                  </label>
                </li>
                <!-- <li>
                <p class="info"><i class="fa-solid fa-circle-info"></i> Description:</p>
                <label for="info">
                  <div class="description-info"> <?php
$stmt2->execute();
    while ($services = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        echo $services['Service_description'] . "<br>";
    }?> </div>
                </label>
              </li> -->
                <?php }
$sql4 = "SELECT * FROM availability WHERE user_id = '$userid'";
$stmt4 = $conn->prepare($sql4, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt4->execute();
if ($stmt2->rowCount() > 0) {
    while ($schedule = $stmt4->fetch(PDO::FETCH_ASSOC)) {
        if ($schedule['availability'] == 1) {
            if ($schedule['sunday'] == 1) {
                ?>
                      <li>
                        <p class="info"><i class="fa-sharp fa-solid fa-calendar"></i> Sunday:</p>
                        <label for="schedule"><?php echo date('h:i a', strtotime($schedule['sundayIn'])) . " - " . date('h:i a', strtotime($schedule['sundayOut'])) ?></label>
                      </li>
                    <?php }
            if ($schedule['monday'] == 1) {
                ?>
                      <li>
                        <p class="info"><i class="fa-sharp fa-solid fa-calendar"></i> Monday:</p>
                        <label for="schedule"><?php echo date('h:i a', strtotime($schedule['mondayIn'])) . " - " . date('h:i a', strtotime($schedule['mondayOut'])) ?></label>
                      </li>
                    <?php }
            if ($schedule['tuesday'] == 1) {
                ?>
                      <li>
                        <p class="info"><i class="fa-sharp fa-solid fa-calendar"></i> Tuesday:</p>
                        <label for="schedule"><?php echo date('h:i a', strtotime($schedule['tuesdayIn'])) . " - " . date('h:i a', strtotime($schedule['tuesdayOut'])) ?></label>
                      </li>
                    <?php }
            if ($schedule['wednesday'] == 1) {
                ?>
                      <li>
                        <p class="info"><i class="fa-sharp fa-solid fa-calendar"></i> Wednesday:</p>
                        <label for="schedule"><?php echo date('h:i a', strtotime($schedule['wednesdayIn'])) . " - " . date('h:i a', strtotime($schedule['wednesdayOut'])) ?></label>
                      </li>
                    <?php }
            if ($schedule['thursday'] == 1) {
                ?>
                      <li>
                        <p class="info"><i class="fa-sharp fa-solid fa-calendar"></i> Thursday:</p>
                        <label for="schedule"><?php echo date('h:i a', strtotime($schedule['thursdayIn'])) . " - " . date('h:i a', strtotime($schedule['thursdayOut'])) ?></label>
                      </li>
                    <?php }
            if ($schedule['friday'] == 1) {
                ?>
                      <li>
                        <p class="info"><i class="fa-sharp fa-solid fa-calendar"></i> Friday:</p>
                        <label for="schedule"><?php echo date('h:i a', strtotime($schedule['fridayIn'])) . " - " . date('h:i a', strtotime($schedule['fridayOut'])) ?></label>
                      </li>
                    <?php }
            if ($schedule['saturday'] == 1) {
                ?>
                      <li>
                        <p class="info"><i class="fa-sharp fa-solid fa-calendar"></i> Saturday:</p>
                        <label for="schedule"><?php echo date('h:i a', strtotime($schedule['saturdayIn'])) . " - " . date('h:i a', strtotime($schedule['saturdayOut'])) ?></label>
                      </li>
                  <?php }
        }?>
              <?php
}
}

?>



              <?php
$sql3 = "SELECT SUM(status='Finished') as finished, SUM(status='Pending') as pending, SUM(status='On-process') as on_process
FROM services
WHERE provider_id = '$userid' ";
$stmt3 = $conn->prepare($sql3, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt3->execute();
$accomplishment = $stmt3->fetch(PDO::FETCH_ASSOC);
?> <div class="accomplishment">
                <span> Accomplishment</span>
                <p><i class="fa-sharp fa-solid fa-circle-check"></i> <?php echo $accomplishment["finished"]; ?> Finished</p>
                <p><i class="fa-sharp fa-solid fa-thumbtack"></i> <?php echo $accomplishment["pending"]; ?> Pending</p>
                <p><i class="fa-sharp fa-solid fa-toolbox"></i> <?php echo $accomplishment["on_process"]; ?> On-Process</p>
              </div>
            </ul>
          </div>
        </section>

        <hr class="hr">
        <?php
if ($stmt2->rowCount() > 0) {?>
          <section class="rating-and-reviews-page">
            <?php $sql = "SELECT ROUND(AVG(feedback.rating), 1) AS avgRating FROM feedback WHERE provider_id = '$userid';";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $feedback = $stmt->fetch(PDO::FETCH_ASSOC)?>
            <h2> <i class="fa-regular fa-star"></i> Rating and Reviews</h2><br>
            <h4><?php echo $feedback["avgRating"] ?>/5.0</h4>
            <div class="rating-and-review-container" id="rating-and-review-container">
              <?php
$sql = "SELECT DATE_FORMAT(feedback.date, '%M %d, %Y') AS Date, feedback.*, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS seekerName, images.image_filename FROM feedback
LEFT JOIN user ON user.user_id=feedback.seeker_id
            LEFT JOIN images ON images.user_id=feedback.seeker_id AND images.image_type = 'profile'
WHERE feedback.provider_id = '$userid' ORDER BY feedback.feedback_id DESC;";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    $feedback = "";

    if ($stmt->rowCount() == 0) {
        echo "<p>No ratings yet</p>";
    } else {
        while ($feedback = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $profile = $feedback['image_filename'] == null ? "default.png" : $feedback['image_filename'];
            $name = $feedback['seekerName'] == null ? "Not Available" : $feedback['seekerName'];
            ?>
                  <div class="rating-and-reviews">
                    <div class="rating-and-reviews-info">
                      <img src="/../OOP/images/photo/<?php echo $profile; ?>">
                      <div class="name-and-date">
                        <h4><?php echo $name ?></h4>
                        <p><?php echo $feedback["Date"]; ?></p>
                      </div>
                    </div>
                    <div class="rating-and-comments">
                      <h4>Rate:
                        <?php for ($x = 0; $x < $feedback["rating"]; $x++) {?>
                          <span class="star">&#9733</span>
                        <?php }
            ?>
                        <?php for ($x = $feedback["rating"]; $x < 5; $x++) {?>
                          <span class="star">&#9734</span>
                        <?php }
            ?>

                        <!-- <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-regular fa-star"></i> -->
                      </h4>
                      <div class="comments">
                        <p><?php echo $feedback["feedback"] ?></p>

                      </div>
                    </div>
                    <div class="gallery"> <?php
if ($feedback["feedback_img"] != null) {?>
                        <img src="/../OOP/images/feedback/<?php echo $feedback["feedback_img"]; ?>">
                      <?php }?>
                    </div>
                  </div>
                  <hr>
              <?php }
    }?>
            </div>
          </section>
        <?php }?>
      </div>
    </div>
  </div>

  <script>
    window.onscroll = function() {
      scrollFunction()
    };

    function scrollFunction() {
      if (document.body.scrollTop > -80 || document.documentElement.scrollTop > 80) {
        document.getElementById("header").style.padding = "10px 0";
        document.getElementById("header").style.backgroundColor = "#598392";
        // document.getElementById("logo").style.fontSize = "25px";
      } else {
        document.getElementById("header").style.padding = "25px 0";
        document.getElementById("header").style.backgroundColor = "transparent";
        // document.getElementById("logo").style.fontSize = "35px";
      }
    }
  </script>
  <!-- <script src="/../OOP/js/get_feedback.js"></script> -->

</body>

</html>