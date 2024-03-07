<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/delete-account.css">
  <link rel="stylesheet" href="../css/account-sidebar.css">
  <title>Status</title>
</head>
<body>
<?php
include '../account-sidebar.php';
?>
<section class="myaccount-tabcontent" id="my-delete-account">
    <h1><i class="fa-solid fa-trash"></i> Delete Account</h1>
    <p>
      Deleting your account will remove all your information from our
      database. These cannot be undone.
    </p>
    <hr>
    <div class="delete-container">
      <div class="confirmation">
        <h3>
          <i class="fa-solid fa-triangle-exclamation"></i> Confirm Account
          Deletion.
        </h3>
      </div>
      <div class="letter">
        <img src="../warning.png" />
        <p>
          We're sorry to see you go. Once your account is deleted, all of your
          content will be permanently gone, including your profile, stories,
          publication, and responses. Deleting your account will not delete
          any stripe account you have connected to your Medium account.
        </p>
      </div>
      <div class="conclusion">
        <p>
          To confirm deletion, type "<span style="color: rgb(193, 8, 8)">DELETE</span>".
        </p>
        <form action="/../OOP/php/include/delete_account.php" method="post">
        <input type="text" name="delete" id="deletion" placeholder="Input here..." required />
      </div>
      <div class="buttons">
        <input type="button" name="cancel" value="Cancel" class="spass1" />
        <input type="submit" name="confirm" value="DELETE" class="cpass1" />
      </div>
      </form>
    </div>
  </section>

  <script src="/../OOP/js/services.js"></script>
</body>
</html>
