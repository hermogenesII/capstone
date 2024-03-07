<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/account-sidebar.css">
    <title>Account</title>

  <script src="/../OOP/js/address.js"></script>

</head>
<body>

<?php
include '../account-sidebar.php';
?>
    <section class="myaccount-tabcontent" id="my-profile-edit">
    <div class="my-profile-info">
      <h1><i class="fa-solid fa-user"></i> My Profile</h1>
      <p>Edit your account</p>
      <hr />
    </div>
      <div class="container">
      <form id="profile-form" action="/../OOP/php/include/profile.inc.php" method="post" enctype="multipart/form-data">

        <?php
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM images WHERE user_id = '$user_id' AND image_type = 'profile'";
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
        <div class="profile-btn">
          <button id="select" name="profile-pic" type="submit"> Select Image</button>
          <input type="file" name="profile-pic" id="profile-pic" accept=".jpg, jpeg, .png">
        </div>
      </form>
      <form id="profile-info-form" action="/../OOP/php/include/user_info.php" method="post">
        <li>
          <label for="username"><i class="fa-solid fa-user"></i> Username:</label>
          <input type="text" class="e-username" name="username" value="<?php echo $_SESSION["username"]; ?>" />
        </li>
        <li>
          <label for="email"><i class="fa-solid fa-envelope"></i> Email:</label>
          <input type="email" class="e-email" name="email" value="<?php echo $_SESSION["user_email"]; ?>">
        </li>
        <li>
          <label for="phone"><i class="fa-solid fa-phone"></i> Phone no.:</label>
          <input type="number" class="e-phone" name="phone" value="<?php echo $_SESSION["user_contact"]; ?>" />
        </li>
        <li>
          <label for="address"><i class="fa-solid fa-location-dot"></i> Address:</label>
          <div class="addresses"> <!-- Added a div for css design and responsive -->
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
          </div>
        </li>
        <li>
          <a href="/../OOP/practice/user-account/includes/account.php"><input type="button" class="cancel-btn" value="Cancel"></a>
          <input type="submit" name="submit" class="save-btn" value="Save" />

        </li>
      </form>
    </div>
  </section>

</body>
</html>