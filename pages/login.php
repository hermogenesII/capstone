<?php session_start()?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <link rel="stylesheet" href="../css/login/login.css">

  <style>
    body {
      background-image: linear-gradient(rgba(234, 237, 244, 0.381),
          rgba(232, 180, 106, 0.551),
          rgba(76, 128, 201, 0.6)),
        url(../images/background/login-background.jpg);
    }
  </style>
  <title>Log in</title>
</head>

<body>
  <div class="login-container">
    <h1>Servi-Seek</h1>
    <h3>Marinduque's Marketplace of Services</h3>
    <div class="sign-in">
      <h2><i class="fa-solid fa-user-astronaut"></i> Login</h2>
      <form class="POST" action="../php/include/login.inc.php" method="post" autocomplete="off">
        <?php if (isset($_SESSION['error'])) {?>
          <p class="error"><?php echo $_SESSION['error'];
    unset($_SESSION["error"]);
    ?></p>
        <?php }?>
        <div class="text">
          <input type="text" name="usernameemail" value="<?php echo $username = isset($_SESSION['username']) ? htmlentities($_SESSION['username']) : "";unset($_SESSION["username"]); ?>" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : "" ?>">
          <span></span>
          <label for=""><i class="fa-solid fa-user-large"></i> Username or Email: </label>
        </div>
        <div class="text">
          <input type="password" name="password" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : "";unset($_SESSION["require"]); ?>">
          <span></span>
          <label for=""><i class="fa-solid fa-key"></i> Password: </label>
          <i class="fas fa-eye"></i>
        </div>
        <div class="log">
          <input type="submit" name="submit" value="Log In">
        </div>
        <div class="login">
          Don't have any account?<a href="./registration.php"> Sign Up</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    pswrdField = document.querySelector("input[type='password']"),
      toggleBtn = document.querySelector(".fa-eye");

    toggleBtn.onclick = () => {
      if (pswrdField.type == "password") {
        pswrdField.type = "text";
      } else {
        pswrdField.type = "password";
      }
    }
  </script>

</body>

</html>