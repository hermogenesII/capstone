<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <!-- <link rel="stylesheet" href=".admin/css/sidebar.css" /> -->


  <title>Dashboard</title>
</head>

<body>
  <aside class="myaccount-container">
    <div class="system-title">
      <a href="#"><img src="../admin/images/dd.png" alt="" /></a>
    </div>
    <nav class="myaccount-tabs">
      <div class="sidebar-menu"></div>
      <div>
        <a class="myaccount-tablinks" href="./admin.php" onclick="openMyAccount(event, 'dashboard')" id="dashboard">
          <i class="fa-sharp fa-solid fa-file-contract"></i> Dashboard
        </a>
        <a class="myaccount-tablinks" href="./manage-admin.php" onclick="openMyAccount(event, 'manageadmin')">
          <i class="fa-solid fa-user-plus"></i> Manage Admin
        </a>
        <a class="myaccount-tablinks" href="./userrequest.php" onclick="openMyAccount(event, 'userrequest')" >
          <i class="fa-sharp fa-solid fa-users-gear"></i> User Request
        </a>
        <a class="myaccount-tablinks" href="./categories.php" onclick="openMyAccount(event, 'categories')" >
          <i class="fa-sharp fa-solid fa-list"></i> Categories
        </a>
        <!-- <a class="myaccount-tablinks" href="./service-provider.php" onclick="openMyAccount(event, 'service-provider')" >
          <i class="fa-sharp fa-solid fa-trowel-bricks"></i> Service Provider
        </a> -->
        <a class="myaccount-tablinks" href="./proof.php" onclick="openMyAccount(event, 'proof')" >
          <i class="fa-sharp fa-solid fa-receipt"></i> Subscription
        </a>
        <a class="myaccount-tablinks" href="./history.php" onclick="openMyAccount(event, 'history')" >
          <i class="fa-solid fa-book-bookmark"></i> Activity Log
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
</body>

</html>
