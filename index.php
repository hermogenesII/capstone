<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <link rel="stylesheet" href="./css/general.css">
  <link rel="stylesheet" href="./css/include/header.css">
  <link rel="stylesheet" href="./css/include/footer.css">
  <link rel="stylesheet" href="./css/index/front-section.css">
  <link rel="stylesheet" href="./css/index/categories-section.css">
  <link rel="stylesheet" href="./css/index/importance-section.css">
  <link rel="stylesheet" href="./css/index/service-provider-section.css">
  <link rel="stylesheet" href="./css/index/about-us-section.css">

  <style>
    .service-provider {
      background-image: url(./images/background/service-provider-background.jpg);
    }
  </style>

  <title>Servi-Seek</title>
</head>

<body>
  <?php
include './includes/header.php';
?>

  <main>

    <!-- FrontPage -->
    <section id="front-page" class="main-section" style="background-image: url('./images/background/front-cover.png');">
      <div class="content">
        <h1 class="title">SERVI - SEEK</h1>
        <p class="sub-title">
          An online platform for efficiently and decisively finding specialized
          skilled workers without wasting time, effort, and energy.
        </p>
        <div class="front-btn">
          <!-- <button class="button1" type="button">
            <span></span> LEARN MORE
          </button> -->
          <button class="button1" type="button"><span></span> SUBSCRIBE</button>
        </div>
      </div>
    </section>

    <!-- Categories -->
    <section id="categories-page" class="main-section">
      <h1 class="categories-title">Categories</h1>
      <div class="categories-grid">
<?php $sql = "SELECT * FROM category";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
    <div class="category-border">
          <div class="category">
            <img src="./images/background/<?php echo $category["Category_Img"]; ?>">
            <div class="layer">
              <h3 style="text-transform: uppercase;"><?php echo $category["Category"]; ?></h3>
            </div>
          </div>
          <div class="category-description">
            <h4 style="text-transform: uppercase;"><?php echo $category["Category"]; ?></h4>
            <p><?php echo $category["Category_Description"]; ?>
          </div>
        </div>
<?php }?>

        <!-- <div class="category-border">
          <div class="category">
            <img src="./images/background/electric.jpg">
            <div class="layer">
              <h3>ELECTRONIC DEVICES</h3>
            </div>
          </div>
          <div class="category-description">
            <h4>ELECTRONIC DEVICES</h4>
            <p>Electronics technicians design electronic components,
              and repair, install, service, and update existing electronic
              systems.
            </p>
          </div>
        </div>
        <div class="category-border">
          <div class="category">
            <img src="./images/background/mechanic.jpg">
            <div class="layer">
              <h3>MECHANIC</h3>
            </div>
          </div>
          <div class="category-description">
            <h4>MECHANIC</h4>
            <p>Auto Mechanic fixes vehicles and replaces their parts
              for customers. Their duties include repairing the vehicle's
              mechanical components, diagnosing problems with cars/
              trucks and performing maintenance work on them as well.
            </p>
          </div>
        </div>
        <div class="category-border">
          <div class="category">
            <img src="./images/background/garments.jpg">
            <div class="layer">
              <h3>GARMENTS</h3>
            </div>
          </div>
          <div class="category-description">
            <h4>GARMENTS</h4>
            <p>Tailors are responsible for constructing, altering,
              repairing, or modifying garments for customers based on
              their specifications, needs, and preferences.
            </p>
          </div>
        </div>
        <div class="category-border">
          <div class="category">
            <img src="./images/background/furniture.jpg">
            <div class="layer">
              <h3>FURNITURE</h3>
            </div>
          </div>
          <div class="category-description">
            <h4>FURNITURE</h4>
            <p>A furniture maker is responsible for the design, building,
              and restoration of pieces of furniture like cabinets,
              tables, chairs, bed frames, shelves, armoires, and more.
              Their duties as a furniture maker depend on your employer.
            </p>
          </div>
        </div>
        <div class="category-border">
          <div class="category">
            <img src="./images/background/printing.jpg">
            <div class="layer">
              <h3>DIGITAL PRINTING</h3>
            </div>
          </div>
          <div class="category-description">
            <h4>DIGITAL PRINTING</h4>
            <p>Digital printing is a method of printing from a digital-based
              image directly to a variety of media. It usually refers to
              professional printing where small-run jobs from desktop
              publishing and other digital sources are printed using
              large-format and/or high-volume laser or inkjet printers.
            </p>
          </div>
        </div>
        <div class="category-border">
          <div class="category">
            <img src="./images/background/salon.jpg">
            <div class="layer">
              <h3>BEAUTY SERVICES</h3>
            </div>
          </div>
          <div class="category-description">
            <h4>BEAUTY SERVICES</h4>
            <p>Beauty salons provide comprehensive services related to skin
              health, facial aesthetics, foot care, nail manicures, and
              aromatherapy. They also offer meditation, oxygen therapy,
              mud baths, and many other treatments.
            </p>
          </div>
        </div>
        <div class="category-border">
          <div class="category">
            <img src="./images/background/others.jpg">
            <div class="layer">
              <h3>OTHERS</h3>
            </div>
          </div>
          <div class="category-description">
            <h4>OTHERS</h4>
            <p>Please click here to see a list of additional services.
            </p>
          </div>
        </div> -->
      </div>
    </section>

    <!--Importance Page-->
    <section class="importance" id="importance">
      <h1>IMPORTANCE OF SERVICES</h1>
      <div class="line"></div>
      <div class="importance-container">
        <div class="content-col">
          <p>Skilled workers have advanced theoretical
            and practical knowledge, making it easier
            for them to overcome issues and highlight
            inconsistencies within your business practices.
            They have the confidence to do what is necessary,
            and the ability to solve problems as they arise
            instead will benefit your entire team.
          </p>
          <!-- <a href="#" class="ctn">Learn More</a> -->
        </div>
        <div class="image-col">
          <div class="image-gallery">
            <img src="./images/background/importance1.jpg" alt="">
            <img src="./images/background/importance2.jpg" alt="">
            <img src="./images/background/importance3.jpg" alt="">
            <img src="./images/background/importance4.jpg" alt="">
          </div>
        </div>
      </div>
    </section>
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
        <select name="category" id="category" >
          <!-- <option value="" hidden>Category</option> -->
          <option value="">All Categories</option>
          <option value="Utility">Utility</option>
          <option value="Electronic">Electronic device</option>
          <option value="Mechanic">Mechanic</option>
          <option value="garment">Garment</option>
          <option value="Furniture">Furniture</option>
          <option value="beauty-services">Beauty Services</option>
          <option value="other">Other</option>
        </select>

        <!-- <select name="specific-service" id="specific-service" onclick="csload(2); this.onclick=null;">
          <option value="" hidden>Specific-Service</option>
        </select> -->
        </div>
      </div>
      <div class="service-provider-container">
      <?php
// include './php/classes/dbConn.php';
include './config/db_conn.php';

include '/xampp/htdocs/OOP/js/index.class.php';
$providers = getAllCategory();
foreach ($providers as $providers) {
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
<?php }?>
        <!-- <?php
require './config/db_conn.php';

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
      </div><?php
$count = count($providers);
//echo "<script>alert($count)</script>";
if (count($providers) >= 3) {?>
      <div class="service-provider-more"><a href="/../OOP/pages/provider-page.php"><button>See more</button></a></div>
     <?php }?>
    </section>

    <!--About Us-->
    <section class="about-us-section" id="about-us-section">
      <div class="image-col">
        <img src="./images/background/about-us-photo.jpg" alt="">
      </div>
      <div class="content-cols">
        <h1>Servi-Seek can make your life easier.</h1>
        <div class="lines"></div>
        <p>When life becomes busy, you don't have to face it alone.
          Recapture your time for what you enjoy without breaking the bank.
          Schedule it when it is convenient for you — as early as today.
          One platform allows you to chat, pay, tip, and review.
        </p>
        <!-- <a href="#" class="ctn">Learn More</a> -->
      </div>
    </section>

  </main>

  <?php
include './includes/footer.php';
?>

<script src="/../OOP/js/categories.js"></script>
<script src="/../OOP/js/header.js"></script>
<script src="/../OOP/js/category.js"></script>

</body>

</html>