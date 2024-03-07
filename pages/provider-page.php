<?php

session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<link rel="stylesheet" href="/../OOP/css/provider-page.css">
<link rel="stylesheet" href="/../OOP/css/include//header.css">

<style>
    .service-provider {
      background-image: url(../images/background/service-provider-background.jpg);
    }
  </style>

  <title>Service Provider</title>
</head>

<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


<header id="header" role="banner">
  <div class="header_middle_section">
    <!-- <i id="search-btn" class="fa fa-magnifying-glass"></i>
    <div class="search-bar">
      <form action="" method="get" id="search-form">
        <div class="input-div">
          <input id="search" type="text" name="search" class="search_area" placeholder="Search..." />
        </div>
        <div id="result-div" style="display: none;">
          <ul id="live-result">
            <li><a href="#"></a></li>
          </ul>
        </div>
      </form>
    </div> -->
  </div>
  <div class="header_right_section">
    <div class="navigation">
      <ul>
        <li>
          <a href="/../OOP/index.php">
            <button class="drop-down-categories-btn">
              <i class="fa-solid fa-home"> </i> Home
            </button>
          </a>
        </li>
        <!-- <li>
          <a href="/../OOP/pages/provider-page.php"><i class="fa-solid fa-map"></i> Services</a>
        </li> -->
      </ul>
    </div>
    <div class="profile">
      <?php if (isset($_SESSION["user_id"])) {?>
        <a href="/../OOP/pages/message.php"><i class="fa-solid fa-message"></i> My Message
        </a>
        <nav class="notification-bell">
          <ul>
            <li>
              <a href="#" id="notif-count"><label for="check"><i class="fa-solid fa-bell" aria-hidden="true"></i>
                </label>
                <p id="notifCount"></p>
              </a>
              <input type="checkbox" class="dropdown-check" id="check">
              <ul class="class-dropdown" id="notifList">
                <li>
                  <img src="#">
                  <h2 class="hire"><i class="fa-solid fa-hand-dots"></i></h2>
                  <p>Hermogenes Magsino Send you an application request.</p>
                </li>
                <li>
                  <img src="#">
                  <h2 class="sent"><i class="fa-solid fa-paper-plane"></i></h2>
                  <p>Eudichael Jardeleza Sent you a message.</p>
                </li>
                <li>
                  <img src="#">
                  <h2 class="cancel"><i class="fa-solid fa-ban"></i></h2>
                  <p>Erwin Andrade cancel his/her Request.</p>
                </li>
                <li>
                  <img src="#">
                  <h2 class="rate"><i class="fa-solid fa-star"></i></h2>
                  <p>Eudichael Jardeleza Rate on your Profile.</p>
                </li>
                <li>
                  <img src="#">
                  <h2 class="comment"><i class="fa-solid fa-comment"></i></h2>
                  <p>Eudichael Jardeleza Commented on your profile.</p>
                </li>
                <li>
                  <img src="#">
                  <h2 class="accept"><i class="fa-regular fa-square-check"></i></h2>
                  <p>Erwin Andrade Accept your application request.</p>
                </li>
                <li>
                  <img src="#">
                  <h2 class="accept"><i class="fa-regular fa-square-check"></i></h2>
                  <p>Erwin Andrade Accept your application request.</p>
                </li>
                <li>
                  <img src="#">
                  <h2 class="accept"><i class="fa-regular fa-square-check"></i></h2>
                  <p>Erwin Andrade Accept your application request.</p>
                </li>
                <li>
                  <img src="#">
                  <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
                  <p>Erwin Andrade update your service status.</p>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <a href="/../OOP/practice/user-account/includes/account.php">
          <?php echo $_SESSION["username"]; ?>
        </a>
        <?php
$user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM images WHERE user_id = '$user_id'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() == 0) {?>
          <a href="/../OOP/practice/user-account/includes/account.php"><img src='/../OOP/images/photo/default.png' /></a>
        <?php
} else {?>
          <a href="/../OOP/practice/user-account/includes/account.php"><img src="/../OOP/images/photo/<?php echo $row['image_filename']; ?>" /></a>
        <?php }?>
        <!-- <a href="/../OOP/practice/user-account/user-account.php\"><img src="/../OOP/images/photo/profile.png" /></a> -->
      <?php } else {?>
        <a href="/../OOP/pages/login.php"><i class="fa-solid fa-right-to-bracket"></i> Login/Register</a>
      <?php }?>

    </div>

    <i id="menu-btn" class="fa-solid fa-bars"></i>
  </div>
</header>

        <!--Service Provider-->
    <section id="service-provider-page" class="main-section">
      <div class="service-provider-title">
        <h1><i class="fa-solid fa-user-tie"></i> Service Provider</h1>

        <!-- <select name="categories" id="categories">
          <option value="">All Categories</option>
          <option value="utility">Utility</option>
          <option value="e-device">Electronic device</option>
          <option value="mechanic">Mechanic</option>
          <option value="garment">Garment</option>
          <option value="furniture">Furniture</option>
          <option value="beauty-services">Beauty Services</option>
          <option value="other">Other</option>
        </select> -->
        <!-- <select name="category" id="category" > -->
          <!-- <option value="" hidden>Category</option> -->
          <!-- <option value="">All Categories</option>
          <option value="Utility">Utility</option>
          <option value="Electronic Device">Electronic device</option>
          <option value="Mechanic">Mechanic</option>
          <option value="garment">Garment</option>
          <option value="Furniture">Furniture</option>
          <option value="beauty-services">Beauty Services</option>
          <option value="other">Other</option>
        </select> -->

        <select name="category" id="category" onclick="csload(1); this.onclick=null;">
          <option value=""> All Categories</option>
        </select>

        <select name="specific-service" id="specific-service" onclick="csload(2); this.onclick=null;" style="display: none;">
          <option value="" hidden>Sub-Category</option>
        </select>

        <!-- <select name="specific-service" id="specific-service" onclick="csload(2); this.onclick=null;">
          <option value="" hidden>Specific-Service</option>
        </select> -->
        <!-- <select name="location" id="location" onclick="csload(2); this.onclick=null;"> -->
        <select name="location" id="location">
          <option value="">All Location</option>
          <option value="Boac">Boac</option>
          <option value="Buenavista">Buenavista</option>
          <option value="Mogpog">Mogpog</option>
          <option value="Gasan">Gasan</option>
          <option value="Sta Cruz">Sta Cruz</option>
          <option value="Torijjos">Torijjos</option>
        </select>
        </div>
      </div>
      <div class="service-provider-container">

      <?php
// include '/../OOP/php/classes/dbConn.php';
// include '/../OOP/config/db_conn.php';

include '/xampp/htdocs/OOP/js/index.class.php';
$provider = getAllCategory();
if (count($provider) > 0) {

    foreach ($provider as $providers) {
        $chatImg = $providers['image_filename'] === null ? "default.png" : $providers['image_filename'];
        ?>

<div class="service-provider">
<!-- <i class="fa-solid fa-bars"></i>
<i class="fa-solid fa-gear"></i> -->
<img class="profile-pic" src="/../OOP/images/photo/<?php echo $chatImg; ?>" alt="profile-pic" />
<h4><?php echo htmlentities($providers["fname"]) . " " . htmlentities($providers["lname"]); ?></h4>
<p><br><?php echo $providers["description"]; ?><br></p>
<div class="social-media">
  <br>
  <!-- <i class="fa-brands fa-facebook"></i>
  <i class="fa-brands fa-twitter"></i>
  <i class="fa-brands fa-youtube"></i> -->
</div>
<!-- <?php //if (isset($_SESSION["user_id"])) {?> -->
<div class="buttons">
  <a class="follow-btn" href="/../OOP/pages/hire.php?userid=<?php echo $providers['user_id']; ?>"> Hire</a>
  <a class="follow-btn" href="/../OOP/pages/message.php?userid=<?php echo $providers['user_id']; ?>"> Message</a>
</div>
<!-- <?php //}?> -->
<div class="profile-bottom">
<a href="/../OOP/pages/service-provider.php?userid=<?php echo $providers['user_id']; ?>">
  <p>Learn More About My Profile</p>
  <i class="fa-solid fa-arrow-down"></i>
  </a>
</div>
</div>
<?php }
} else {?>
<p class="none">Sorry there is no service provider on this category</p>
<?php }?>

        <!-- <?php
require '/xampp/htdocs/OOP/config/db_conn.php';

$sql = "SELECT user_provider.SP_id, user.fname, user.mname, user.lname, user_provider.Service_description FROM user_provider  INNER JOIN user ON user_provider.user_id=user.user_id";

//$stmt = $conn->prepare($sql);
//$stmt->execute();
//while ($providers = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
          <div class="service-provider">
            <i class="fa-solid fa-bars"></i>
            <i class="fa-solid fa-gear"></i>
            <img class="profile-pic" src="./images/photo/profile.png" alt="profile-pic" />
            <h4><?php //echo htmlentities($providers["fname"]) . " " . htmlentities($providers["mname"]) . " " . htmlentities($providers["lname"]) ?></h4>
            <p><br><?php //echo $providers["Service_description"] ?><br></p>
            <div class="social-media">
              <br><i class="fa-brands fa-facebook"></i>
              <i class="fa-brands fa-twitter"></i>
              <i class="fa-brands fa-youtube"></i>
            </div>
            <div class="buttons">
              <button class="follow-btn">Hire</button>
              <button class="follow-btn">Message</button>
            </div>
            <div class="profile-bottom">
              <p>Learn More About My Profile</p>
              <i class="fa-solid fa-arrow-down"></i>
            </div>
          </div>
        <?php //}?> -->
      </div>
      <!-- <div class="service-provider-more"><button>See more</button></div> -->
    </section>

    <script src="/../OOP/js/categories.js"></script>
<script src="/../OOP/js/header.js"></script>
<script src="/../OOP/js/category.js"></script>

</body>

</html>