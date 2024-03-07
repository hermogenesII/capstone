<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/my-services.css">
    <link rel="stylesheet" href="../css/account-sidebar.css">
    <title>My Serivces</title>
</head>
<body>
<?php
include '../account-sidebar.php';
?>
<section class="myaccount-tabcontent" id="my-services">
  <h1><i class="fa-sharp fa-solid fa-file-invoice"></i> My Services</h1>
  <p> Upgrade your account to take your experience to the next level.</p>
  <hr>
  <div class="service-container">
    <h3>Upgrade to a Service Provider account and access exclusive features.</h4>
      <img src="../subs.png" alt="picture to insert!!!!">
      <p>Hello, Erwin! You cannot access these features if you
        are a service seeker. Please subscribe or update your
        payment if you want to use these features.</p>
      <?php
$userid = $_SESSION['user_id'];
$sql = "SELECT subscription_id FROM subscription WHERE user_id = '$userid' ";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
if ($stmt->rowCount() == 0) {
    ?>
        <form action="/../OOP/php/subscription_free.php" method="post">
          <button type="submit" name="submit">Start Free Trial</button>
        </form>
      <?php }?>
      <!-- <input type="button" value="Upgrade" class="spass"> -->
      <a href="/../OOP/practice/user-account/includes/subscription.php"><input type="button" class="save-btn" value="Upgrade" onclick="openMyAccount(event, 'my-subscription')" /></a>
      <!-- <input type="button" value="Upgrade" class="spass"> -->
  </div>
</section>

<script src="/../OOP/js/services.js"></script>
</body>
</html>
