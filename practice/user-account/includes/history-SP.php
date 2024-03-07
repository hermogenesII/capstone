<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/service.css">
    <link rel="stylesheet" href="../css/account-sidebar.css">
    <title>History</title>
</head>
<body>
<?php
include '../account-sidebar.php';
?>
<section class="myaccount-tabcontent" id="my-history-SP">
  <h1><i class="fa-sharp fa-solid fa-people-arrows"></i> History</h1>
  <p>View the status of your services request.
  </p>
  <hr>
  <div class="proof-container">
    <h2><i class="fa-sharp fa-solid fa-table-list"></i> History</h2>
    <table class="content-table">
      <thead>
        <tr>
          <th style="width: 80px;"><i class="fa-sharp fa-solid fa-calendar-days"></i> Date</th>
          <th style="width: 55px;"><i class="fa-sharp fa-solid fa-clock"></i></i> Time</th>
          <!-- <th style="width: 130px;"><i class="fa-sharp fa-solid fa-file-invoice"></i> Service Number</th> -->
          <th style="width: 115px;"><i class="fa-sharp fa-solid fa-handshake"></i> Service Type</th>
          <th style="width: 140px;"><i class="fa-sharp fa-solid fa-phone-volume"></i> Contact Number</th>
          <th style="width: 285px;"><i class="fa-sharp fa-solid fa-map-location-dot"></i> Address</th>
          <th style="width: 80px;"><i class="fa-sharp fa-solid fa-circle-check"></i> Status</th>
          <th style="width: 175px;"><i class="fa-sharp fa-solid fa-user-tie"></i> Customer</th>
        </tr>
      </thead>
      <tbody id="service_history">
        <tr>
          <td>16 - 21 - 2010</td>
          <td>02 : 23</td>
          <td>005</td>
          <td>Beauty Services</td>
          <td>09456123984</td>
          <td>Caigangan, Buenavista, Marinduque</td>
          <td>Cancelled</td>
          <td>Dwynw Stephen Sager</td>
        </tr>
      </tbody>
    </table>
  </div>

</section>

<script src="/../OOP/js/service_history.js"></script>
</body>
</html>