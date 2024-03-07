<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/monitor.css">
  <link rel="stylesheet" href="/../OOP/practice/user-account/css/account-sidebar.css">
  <title>History</title>
</head>
<body>
<?php
include '../account-sidebar.php';
?>

<section class="myaccount-tabcontent" id="my-history-SS">
  <h1><i class="fa-sharp fa-solid fa-list"></i> History</h1>
  <p>Review your previous activity here.
  </p>
  <hr>
  <div class="proof-container">
    <h2><i class="fa-sharp fa-solid fa-table-list"></i> History</h2>
    <table class="content-table">
      <thead>
        <tr>
          <th style="width: 80px;"> Date</th>
          <th style="width: 80px;"> Time</th>
          <!-- <th> Service Number</th> -->
          <th style="width: 110px;"> Service Type</th>
          <th style="width: 140px;"> Contact Number</th>
          <th style="width: 220px;"> Address</th>
          <th style="width: 100px;"> Status</th>
          <th> Service Provider</th>
          <th> Rate</th>
        </tr>
      </thead>
      <tbody id="monitor_history">
        <tr>
          <td>16 - 21 - 2010</td>
          <td>02 : 23</td>
          <td>Beauty Services</td>
          <td>005</td>
          <td>09456123984</td>
          <td>Caigangan, Buenavista, Marinduque</td>
          <td>Cancelled</td>
          <td>Dwynw Stephen Sager</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<script src="/../OOP/js/monitor_history.js"></script>
</body>
</html>


