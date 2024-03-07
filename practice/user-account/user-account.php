<?php
session_start();
include '../db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <link rel="stylesheet" href="./css/user-account.css" />
  <link rel="stylesheet" href="./css/profile.css" />
  <link rel="stylesheet" href="./css/password.css" />
  <link rel="stylesheet" href="./css/message.css" />
  <link rel="stylesheet" href="./css/monitor.css" />
  <link rel="stylesheet" href="./css/subscription.css" />
  <link rel="stylesheet" href="./css/my-services.css">
  <link rel="stylesheet" href="./css/service.css" />
  <link rel="stylesheet" href="./css/logout.css" />
  <link rel="stylesheet" href="./css/delete-account.css" />
  <!-- <script> window.onload="openMyAccount(event, 'my-services')"</script> -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <title>My Account</title>
</head>

<body>
<div class="sidebar-btn"><i id="sidebar-btn" class="fa-solid fa-bars"></i></div>
  <aside class="myaccount-container">
    <div class="system-title">
      <a href="/../OOP/index.php"><img src="dd.png" alt="" /></a>
    </div>
    <nav class="myaccount-tabs">
      <div>
        <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-profile')"id="defaultOpen" >
          <p><i class="fa-solid fa-user"></i> Account</p>
        </button>
        <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-password')">
          <p><i class="fa-solid fa-key"></i> Password</p>
        </button>
        <!-- <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-message')">
          <p><i class="fa-solid fa-message"></i> Message</p>
        </button> -->
        <div class="sidebar">
          <div class="menu">
            <button class="sample">
              <p><i class="fa-solid fa-user"></i> Monitor</p>
            </button>
            <div class="acquired-services-dropdown">
              <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-status-SS')" >
                <p><i class="fa-brands fa-creative-commons-by"></i>Status</p>
              </button>
              <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-request-SS')">
                <p><i class="fa-solid fa-code-pull-request"></i>Request</p>
              </button>
              <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-history-SS')" >
                <p><i class="fa-solid fa-list"></i> History</p>
              </button>
            </div>
          </div>
        </div>
        <div class="sidebar">
          <div class="menu">
            <?php
$id = $_SESSION["user_id"];

$sql = "UPDATE subscription SET status = 'expired' WHERE subscription_exp <= CURRENT_DATE() AND status != 'pending'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$stmt = null;

$sql = "SELECT subscription_id FROM subscription WHERE user_id = '$id' AND (status ='approved' OR status = 'free')";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    ?>
              <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-services')">
                <p><i class="fa-solid fa-lock"></i> My Services</p>
              </button>
            <?php } else {?>
              <button class="sample">
                <p><i class="fa-brands fa-servicestack"></i> Services</p>
              </button>
            <?php }?>
            <div class="acquired-services-dropdown">
              <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-status-SP')">
                <p><i class="fa-brands fa-creative-commons-by"></i> Status</p>
              </button>
              <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-request-SP')">
                <p><i class="fa-solid fa-code-pull-request"></i> Request</p>
              </button>
              <button class="myaccount-tablinks" onclick="openMyAccount(event, 'promote-table')">
                <p><i class="fa-solid fa-plus"></i> Promote</p>
              </button>
              <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-history-SP')">
                <p><i class="fa-solid fa-list"></i> History</p>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="myaccount-tabs-push">

        <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-subscription')" >
          <p><i class="fa-solid fa-lock"></i> Subscription</p>
        </button>
        <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-logout')" >
          <p><i class="fa-solid fa-lock"></i>Logout</p>
        </button>
        <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-delete-account')" >
          <p><i class="fa-solid fa-trash"></i> Delete-account</p>
        </button>
      </div>
    </nav>
  </aside>

  <!-- Profile -->
  <section class="myaccount-tabcontent" id="my-profile">
    <div class="my-profile-info">
      <h1><i class="fa-solid fa-user"></i> My Profile</h1>
      <p>Manage and Protect your account</p>
      <hr />
      <form id="profile-form" action="/../OOP/php/include/profile.inc.php" method="post" enctype="multipart/form-data">

        <?php
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM images WHERE user_id = '$user_id'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($stmt->rowCount() == 0) {
    ?><img src="/../OOP/images/photo/default.png" />
        <?php } else {?>
          <img src="/../OOP/images/photo/<?php echo $row['image_filename']; ?>" />
          <input type="hidden" name="old-pic" value="<?php echo $row['image_filename']; ?>">
        <?php }?>
        <button id="select" name="profile-pic" type="submit"> Select Image</button>
        <input type="file" name="profile-pic" id="profile-pic" accept=".jpg, jpeg, .png">
      </form>
      <ul>
        <li>
          <label for="username"><i class="fa-solid fa-user"></i> Username:</label>
          <input type="text" class="username" placeholder="<?php echo $_SESSION["username"]; ?>" />
        </li>
        <li>
          <label for="name"><i class="fa-solid fa-user"></i> Name:</label>
          <input type="text" class="name" placeholder="<?php echo $_SESSION["user_fname"] . " " . $_SESSION["user_mname"] . " " . $_SESSION["user_lname"]; ?>" />
        </li>
        <li>
          <label for="email"><i class="fa-solid fa-envelope"></i> Email:</label>
          <input type="email" class="email" value="<?php echo $_SESSION["user_email"]; ?>" readonly>
        </li>
        <li>
          <label for="phone"><i class="fa-solid fa-phone"></i> Phone no.:</label>
          <input type="number" class="phone" value="<?php echo $_SESSION["user_contact"]; ?>" readonly />
        </li>
        <li>
          <label for="address"><i class="fa-solid fa-location-dot"></i> Address:</label>
          <input type="text" class="address" value="<?php echo $_SESSION["user_address"]; ?>" readonly />
        </li>
        <li>
          <label for="gender"><i class="fa-solid fa-venus-mars"></i> Gender:</label>
          <input type="text" class="gender" value="<?php echo $_SESSION["user_gender"]; ?>" readonly />
        </li>
        <li>
          <label for="dateob"><i class="fa-solid fa-calendar-days"></i> Date of Birth:</label>
          <input type="text" class="dob" value="<?php echo $_SESSION["user_dob"]; ?>" readonly />
        </li>
        <li>
          <input type="button" class="save-btn" value="Edit" onclick="openMyAccount(event, 'my-profile-edit')" />
        </li>
      </ul>
    </div>
  </section>

  <section class="myaccount-tabcontent" id="my-profile-edit">
    <div class="my-profile-info">
      <h1><i class="fa-solid fa-user"></i> My Profile</h1>
      <p>Edit your account</p>
      <hr />
      <form id="profile-form" action="/../OOP/php/include/profile.inc.php" method="post" enctype="multipart/form-data">

        <?php
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM images WHERE user_id = '$user_id'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() == 0) {?>
          <img src='/../OOP/images/photo/default.png' />
        <?php
} else {?>
          <img src="/../OOP/images/photo/<?php echo $row['image_filename']; ?>" />
          <input type="hidden" name="old-pic" value="<?php echo $row['image_filename']; ?>">
        <?php }?>
        <button id="select" name="profile-pic" type="submit"> Select Image</button>
        <div class="editprofile">
        <input type="file" name="profile-pic" id="profile-pic" accept=".jpg, jpeg, .png">
        </div>
      </form>
      <form id="profile-info-form" action="/../OOP/php/include/user_info.php" method="post">
        <li>
          <label for="username"><i class="fa-solid fa-user"></i> Username:</label>
          <input type="text" class="username" name="username" value="<?php echo $_SESSION["username"]; ?>" />
        </li>
        <li>
          <label for="email"><i class="fa-solid fa-envelope"></i> Email:</label>
          <input type="email" class="email" name="email" value="<?php echo $_SESSION["user_email"]; ?>">
        </li>
        <li>
          <label for="phone"><i class="fa-solid fa-phone"></i> Phone no.:</label>
          <input type="number" class="phone" name="phone" value="<?php echo $_SESSION["user_contact"]; ?>" />
        </li>
        <li>
          <label for="address"><i class="fa-solid fa-location-dot"></i> Address:</label>
          <select name="country" id="country" onclick="csload(1); this.onclick=null;">
            <option value="" hidden>Country</option>
          </select>
          <select name="province" id="province" onclick="csload(2); this.onclick=null;">
            <option value="" hidden>Province</option>
          </select>
          <select name="municipality" id="municipality" onclick="csload(3); this.onclick=null;">
            <option value="" hidden>Municipality</option>
          </select>
          <select name="barangay" id="barangay" onclick="csload(4); this.onclick=null;">
            <option value="" hidden>Barangay</option>
          </select>
        </li>
        <li>
          <input type="button" class="cancel-btn" value="Cancel" onclick="openMyAccount(event, 'my-profile')" />
          <input type="submit" name="submit" class="save-btn" value="Save" />
        </li>
      </form>
    </div>
  </section>

  <!--Password-->
  <section class="myaccount-tabcontent" id="my-password">
    <h1><i class="fa-solid fa-key"></i> Password</h1>
    <h3>Change password</h3>
    <p>
      It's a good idea to use a strong password that you're not using
      elsewhere
    </p>
    <hr />
    <form method="POST" action="/../OOP/php/include/password.inc.php">
      <div class="image">
        <img src="seccs.png" alt="" />
      </div>
      <div>
        <?php if (isset($_SESSION['error'])) {?>
          <p class="error"><?php echo $_SESSION['error'];
    unset($_SESSION["error"]);
    ?></p>
        <?php }?>
        <label for="epassword">Current Password: </label>
        <input type="text" name="oldPass" class="epassword" />
        <label for="npassword">New Password: </label>
        <input type="text" name="newPass" class="npassword" />
        <label for="cpassword">Confirm Password:
        </label><input type="text" name="confirmPass" class="cpassword" />
      </div>
      <a href="#"><u>Forget Password?</u></a>
      <hr />
      <input type="submit" name="save" value="Save Changes" class="spass" />
      <input type="submit" name="cancel" value="Close" class="cpass" />
    </form>
  </section>

  <!-- Messages -->
  <!-- <?php //include './includes/messages.php';
?> -->

  <!-- Monitor -->
  <?php include './includes/monitor.php';?>

  <!-- Services -->
  <?php include './includes/services.php';?>

  <!-- Subscription -->
  <?php include './includes/subscription.php';?>

  <!-- Logout -->
  <?php include './includes/logout.php';?>

  <!-- Delete Account -->
  <?php include './includes/delete-account.php';?>

  <script>
    function openMyAccount(evt, accountTab) {
      var i, tabcontent, tablinks;

      tabcontent = document.getElementsByClassName("myaccount-tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      tablinks = document.getElementsByClassName("myaccount-tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      document.getElementById(accountTab).style.display = "block";
      evt.currentTarget.className += " active";
    }

    document.getElementById("defaultOpen").click();

    var nav_dropdown = document.getElementsByClassName("sample");
    var i;

    for (i = 0; i < nav_dropdown.length; i++) {
      nav_dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        dropdownContent.style.marginLeft = "30px"
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
  </script>
  <script src="/../OOP/js/address.js"></script>
  <script src="/../OOP/js/user-account.js"></script>
  <script src="/../OOP/js/category.js"></script>
</body>

</html>