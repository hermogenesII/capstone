<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/logout.css">
    <link rel="stylesheet" href="../css/account-sidebar.css">
    <title>Logout</title>
</head>
<body>
<?php
include '../account-sidebar.php';
?>
  <section class="myaccount-tabcontent" id="my-logout">
    <h1><i class="fa-solid fa-right-from-bracket"></i> Logout</h1>
    <p>Confirm Logout</p>
    <hr>
    <form method="POST" action="/../OOP/php/include/logout.inc.php" class="logout">
      <img src="../sure.png" alt="Insert picture here">
      <p>Are you sure you want to logout? </p>
      <div class="bont">
      <input type="submit" name="cancel" value="Cancel">
      <input type="submit" name="confirm" value="Confirm">
      </div>
    </form>
  </section>

  <!-- <script src="/../OOP/js/services.js"></script> -->
</body>
</html>
