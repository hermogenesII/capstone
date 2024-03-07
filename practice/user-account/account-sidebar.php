<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
?>
<!DOCTYPE html>

<html lang="en">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="stylesheet" href="./css/account-sidebar.css" />
  <!-- <script> window.onload="openMyAccount(event, 'my-services')"</script> -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <title>My Account</title>
</head>

<body>
<div class="sidebar-btn"><i id="sidebar-btn" class="fa-solid fa-bars"></i></div>
  <aside class="myaccount-container">
    <div class="system-title">
      <a href="/../OOP/index.php"><img src="../dd.png" alt="" /></a>
    </div>
    <nav class="myaccount-tabs">
      <div>
        <a href="../includes/account.php">
          <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-profile')">
          <i class="fa-solid fa-user"></i> Account
          </button>
        </a>
        <a href="../includes/password.php">
          <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-password')">
          <i class="fa-solid fa-key"></i> Password
          </button>
        </a>
        <!-- <button class="myaccount-tablinks" onclick="openMyAccount(event, 'my-message')">
          <p><i class="fa-solid fa-message"></i> Message</p>
        </button> -->
        <div class="sidebar">
          <div class="menu">

              <button id="btn" class="sample">
              <i class="fa-regular fa-rectangle-list"></i> Monitor<p></p>
              </button>

            <div class="acquired-services-dropdown">
              <a href="../includes/monitor.php">
                <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-status-SS')" >
                <i class="fa-brands fa-creative-commons-by"></i> Status
                </button>
              </a>
              <a href="../includes/request-SS.php">
                <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-request-SS')">
                <i class="fa-solid fa-code-pull-request"></i> Request
                </button>
              </a>
              <a href="../includes/history-SS.php">
                <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-history-SS')" >
                <i class="fa-solid fa-list"></i> History
                </button>
              </a>
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
            <a href="../includes/my-services.php">
              <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-services')">
              <i class="fa-sharp fa-solid fa-briefcase"></i> My Services
              </button>
            </a>
            <?php } else {?>
              <button id="btn" class="sample">
              <i class="fa-brands fa-servicestack"></i> Services
              </button>
            <?php }?>
            <div class="acquired-services-dropdown">
              <a href="../includes/status-SP.php">
                <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-status-SP')">
                <i class="fa-brands fa-creative-commons-by"></i> Status
                </button>
              </a>
              <a href="../includes/request-SP.php">
                <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-request-SP')">
                <i class="fa-solid fa-code-pull-request"></i> Request
                </button>
              </a>
              <a href="../includes/promote.php">
                <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'promote-table')">
                <i class="fa-solid fa-plus"></i> Promote
                </button>
              </a>
              <a href="../includes/history-SP.php">
                <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-history-SP')">
                <i class="fa-solid fa-list"></i>  History
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="myaccount-tabs-push">
        <a href="../includes/subscription.php">
          <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-subscription')">
          <i class="fa-sharp fa-solid fa-receipt"></i> Subscription
          </button>
        </a>
        <a href="../includes/logout.php">
          <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-logout')">
          <i class="fa-sharp fa-solid fa-right-from-bracket"></i> Logout
          </button>
        </a>
        <a href="../includes/delete-account.php">
          <button id="btn" class="myaccount-tablinks" onclick="openMyAccount(event, 'my-delete-account')">
          <i class="fa-sharp fa-solid fa-trash"></i> Delete-account
          </button>
        </a>
      </div>
    </nav>
  </aside>

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

    const buttons = document.querySelectorAll('.myaccount-tablinks');

    buttons.onmouseover = function(){
      const p = document.querySelectorAll('p');


    }


  </script>

  <script src="/../OOP/js/user-account.js"></script>
</body>
</html>