<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/../OOP/css/include/header.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="/../OOP/css/notif.css" />
  <title>Notification</title>
</head>

<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


<header id="header" role="banner">
  <div class="header_middle_section">
    <i id="search-btn" class="fa fa-magnifying-glass"></i>
    <div class="search-bar">
      <form action="" method="get" id="search-form">
        <div class="input-div">
          <input id="search" type="text" name="search" class="search_area" placeholder="Search..." />
        </div>
        <div id="result-div" style="display: none;">
          <ul id="live-result">
            <!-- <li><a href="#"></a></li> -->
          </ul>
        </div>
      </form>
    </div>
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
        <li>
          <a href="/../OOP/pages/provider-page.php"><i class="fa-solid fa-map"></i> Services</a>
        </li>
      </ul>
    </div>
    <div class="profile">
      <?php if (isset($_SESSION["user_id"])) {?>
        <a href="/../OOP/pages/message.php"><i class="fa-solid fa-message"></i> My Message
        </a>
        <!-- <nav class="notification-bell">
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
        </nav> -->
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
<h2><i class="fa-solid fa-bell"></i> Notification</h2>

  <div class="notification">
    <div class="notif-content">
      <h2><i class="fa-solid fa-bell"></i> Notification</h2>
    </div>
    <div class="notification-content">
      <ul id="notifFullList">
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
          <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
          <p>Erwin Andrade update your service status.</p>
        </li>
        <li>
          <img src="#">
          <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
          <p>Erwin Andrade update your service status.</p>
        </li>
        <li>
          <img src="#">
          <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
          <p>Erwin Andrade update your service status.</p>
        </li>
        <li>
          <img src="#">
          <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
          <p>Erwin Andrade update your service status.</p>
        </li>
        <li>
          <img src="#">
          <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
          <p>Erwin Andrade update your service status.</p>
        </li>
        <li>
          <img src="#">
          <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
          <p>Erwin Andrade update your service status.</p>
        </li>
        <li>
          <img src="#">
          <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
          <p>Erwin Andrade update your service status.</p>
        </li>
        <li>
          <img src="#">
          <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
          <p>Erwin Andrade update your service status.</p>
        </li>
    </ul>
    </div>
  </div>
<script src="/../OOP/js/get_notifFull.js"></script>

</body>

</html>
