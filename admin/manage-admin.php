<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <link rel="stylesheet" href="./css/manageadmin.css" />
  <link rel="stylesheet" href="./css/sidebar.css" />

  <title>Manage Admin</title>
</head>
</body>
<?php
include '../admin/sidebar.php';
?>
<section class="myaccount-tabcontent" id="manageadmin">
    <h1><i class="fa-solid fa-user-plus"></i> Manage Admin</h1>
    <p class="paragraph">The administrator has the privilege to add, delete and edit other admin members.
    </p>
    <hr>
    <div class="proof-container">
        <table class="content-table">
          <thead>
            <tr>
              <th> Name</th>
              <th> Username</th>
              <th> Password</th>
              <th> Role</th>
              <th><p> Remove</p></th>
              <th><p> Edit</p></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>00001</td>
              <td>Kurapika</td>
              <td>Kurapika123</td>
              <td>Admin</td>
              <td>
                <button class="accept">Remove</button>
              </td>
              <td>
                <button>Edit</button>
              </td>
            </tr>
            <tr>
              <td>00002</td>
              <td>Kilua Zoldyck</td>
              <td>kilua09</td>
              <td>Co-Admin</td>
              <td>
                <button class="accept">Remove</button>
              </td>
              <td>
                <button>Edit</button>
              </td>
            <tr>
              <td>00003</td>
              <td>Gon Freecss</td>
              <td>gon1010</td>
              <td>Admin</td>
              <td>
                <button class="accept">Remove</button>
              </td>
              <td>
                <button>Edit</button>
              </td>
            </tr>
            <tr>
            <td>00004</td>
              <td>Hisoka Morow</td>
              <td>hisoka111</td>
              <td>Co-Admin</td>
              <td>
                <button class="accept">Remove</button>
              </td>
              <td>
                <button>Edit</button>
              </td>
            <tr>
            <td>00005</td>
              <td>Biscuit Krueger</td>
              <td>biscuit5050</td>
              <td>Co-Admin</td>
              <td>
                <button class="accept">Remove</button>
              </td>
              <td>
                <button>Edit</button>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
    <div class="but">
        <button>Add</button>

    </div>
  </section>
  </section>
</html>
