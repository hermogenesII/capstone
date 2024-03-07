<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/description.css">
    <link rel="stylesheet" href="../css/account-sidebar.css">
    <title>Promote</title>
</head>
<body>
<?php
include '../account-sidebar.php';
?>
<section class="myaccount-tabcontent" id="my-description">
    <h1><i class="fa-solid fa-receipt"></i> Your Descripiton</h1>
    <p>Inserting your job description here will help you in being
      easily recognized by service seekers and in promoting
      and advertising your services.</p>
    <hr>
    <div class="app-container">
      <h2><i class="fa-solid fa-circle-exclamation"></i> Please enter your description here.</h2>
      <img src="../receipt.png" alt="image to be insert!!!">
      <div class="app-dropdown">
      <form action="/../OOP/php/upgradeAccount_function.php" method="POST">
        <select name="category" id="category" onclick="csload(1); this.onclick=null;">
          <option value="" hidden>Category</option>
        </select>

        <select name="specific-service" id="specific-service" onclick="csload(2); this.onclick=null;">
          <option value="" hidden>Sub-Category</option>
        </select>
      </div>
      <textarea type="text" name="upgrade-account-description" class="description-box" placeholder="Write your description here."></textarea>
      <input type="submit" value="Proceed" class="spass">
      </form>
    </div>
</section>

<script src="/../OOP/js/category.js"></script>
</body>
</html>