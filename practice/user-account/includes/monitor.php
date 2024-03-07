<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/monitor.css">
  <link rel="stylesheet" href="../css/account-sidebar.css">
  <title>Monitor Status</title>
</head>
<body>
<?php
include '../account-sidebar.php';
?>
<section class="myaccount-tabcontent" id="my-status-SS">
  <h1><i class="fa-sharp fa-solid fa-people-arrows"></i> Monitor Status</h1>
  <p>View the status of your services request.</p>
  <hr>
  <div class="proof-container">
    <h2><i class="fa-sharp fa-solid fa-table-list"></i> Monitor Status</h2>
    <table class="content-table">
      <thead>
        <tr>
          <!-- <th><i class="fa-sharp fa-solid fa-file-invoice"></i> Service Number</th> -->
          <th style="width: 200px;"><i class="fa-solid fa-user"></i> Service Provider</th>
          <th style="width: 140px;"><i class="fa-sharp fa-solid fa-handshake"></i> Service Type</th>
          <th style="width: 170px;"><i class="fa-sharp fa-solid fa-phone-volume"></i> Contact Number</th>
          <th style="width: 150px;"><i class="fa-solid fa-credit-card"></i> Mode of Payment</th>
          <th style="width: 120px;"><i class="fa-sharp fa-solid fa-circle-check"></i> Status</th>
        </tr>
      </thead>
      <tbody id="monitor_status">
        <tr>
          <td>001</td>
          <td><a href="/../OOP/pages/message.php?userid=">Hermogenes</a></td>
          <td>Furniture</td>
          <td>0951515151</td>
          <td>
            <p>Pending</p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>


<script src="/../OOP/js/monitor_status.js"></script>
</body>
</html>


