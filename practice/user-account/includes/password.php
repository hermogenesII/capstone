<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/password.css">
  <link rel="stylesheet" href="../css/account-sidebar.css">
  <title>Password</title>
</head>

<body>
  <?php
include '../account-sidebar.php';
?>
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
        <h4>Change your password here.</h4>
        <img src="../seccs.png" alt="" />
      </div>
      <div class="form-input">
        <?php if (isset($_SESSION['error'])) {?>
          <p class="error"><?php echo $_SESSION['error'];
    unset($_SESSION["error"]);
    ?></p>
        <?php }?>
        <div class="inputs">
          <label for="epassword">Current Password: </label>
          <div>
            <input type="password" name="oldPass" class="password" />
            <i class="fa-solid fa-eye"></i>
          </div>
        </div>
        <div class="inputs">
          <label for="npassword">New Password: </label>
          <div>
            <input type="password" name="newPass" class="password" />
            <i class="fa-solid fa-eye"></i>
          </div>
        </div>
        <div class="inputs">
          <label for="cpassword">Confirm Password: </label>
          <div>
            <input type="password" name="confirmPass" class="password" />
            <i class="fa-solid fa-eye"></i>
          </div>
        </div>
      </div>
      <a href="#"><u>Forget Password?</u></a>
      <hr />
      <input type="submit" name="save" value="Save Changes" class="spass" />
      <input type="submit" name="cancel" value="Close" class="cpass" />
    </form>
  </section>

  <script>
    const passwordFields = document.querySelectorAll('.password');
    const toggleButtons = document.querySelectorAll('.fa-eye');

    passwordFields.forEach((passwordField, index) => {
      toggleButtons[index].onclick = () => {
        toggleButtons[index].classList.toggle('fa-eye-slash');
        if (passwordField.type == "password") {
          passwordField.type = "text";
        } else {
          passwordField.type = "password";
        }
      }
    });
  </script>

</body>

</html>