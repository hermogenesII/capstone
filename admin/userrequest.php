<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <link rel="stylesheet" href="./css/userrequest.css" />
  <link rel="stylesheet" href="./css/sidebar.css" />

  <title>User Request</title>
</head>
<body>
<?php
include '../admin/sidebar.php';
?>
<section class="myaccount-tabcontent" id="userrequest">
    <h1><i class="fa-sharp fa-solid fa-users"></i> User Request</h1>
    <p>Review and Verify the registration request of the user. Admin has
      the privilege to accept and decline user requests.
    </p>
    <hr>
    <div class="proof-container">
        <table class="content-table">
          <thead>
            <tr>
              <th> Date</th>
              <th> Time</th>
              <th> Email</th>
              <th> Address</th>
              <th> Name</th>
              <th> Information</th>
            </tr>
          </thead>
          <tbody id="user-request">
            <tr>
              <td>11 - 29 - 2017</td>
              <td>12 : 23</td>
              <td>charlesangeles@gmail.com</td>
              <td>Tanza, Boac, Marinduque</td>
              <td>Charles Angeles</td>
              <td>
                <button>View More</button>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
  </section>

<script src="/../OOP/js/user_request.js"></script>
</body>
</html>
