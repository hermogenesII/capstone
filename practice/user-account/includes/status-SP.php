<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/service.css">
    <link rel="stylesheet" href="../css/account-sidebar.css">
    <title>Update Status</title>
</head>
<body>
<?php
include '../account-sidebar.php';
?>
<section class="myaccount-tabcontent" id="my-status-SP">
  <h1><i class="fa-sharp fa-solid fa-people-arrows"></i> Update Status</h1>
  <p>Update the status of your services that you provide.
  </p>
  <hr>
  <div class="proof-container">
    <h2><i class="fa-sharp fa-solid fa-table-list"></i> Update Status</h2>
      <table class="content-table">
        <thead>
          <tr>
            <th style="width: 230px;"><i class="fa-solid fa-hashtag"></i> Service Provider</th>
            <th style="width: 150px;"><i class="fa-sharp fa-solid fa-handshake"></i> Service Type</th>
            <th style="width: 150px;"><i class="fa-sharp fa-solid fa-phone-volume"></i> Contact Number</th>
            <th style="width: 160px;"><i class="fa-solid fa-hand-holding-dollar"></i> Mode Of Payment</th>
            <th style="width: 140px;"><i class="fa-sharp fa-solid fa-circle-check"></i> Status</th>
            <th style="width: 145px;"><i class="fa-sharp fa-solid fa-circle-check"></i> Update</th>
          </tr>
        </thead>
        <tbody id="service_status">
        <?php
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT services.*, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, images.image_filename FROM services INNER JOIN user ON services.seeker_id=user.user_id LEFT JOIN images ON services.seeker_id=images.user_id AND image_filename = 'profile' WHERE services.provider_id = '$id' AND (services.status = 'Pending' OR services.status = 'On-process') ORDER BY services.service_id DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$monitorRequest = "";

if ($stmt->rowCount() == 0) {
    echo "<td>No Services Request</td>";
} else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
          <tr>
          <td style="width: 230px;"><a href="/../OOP/pages/message.php?userid=<?php echo $request["provider_id"] ?>"> <?php echo $request["providerName"] ?></a></td>
          <td style="width: 150px;"><?php echo $request["service"] ?></td>
          <td style="width: 150px;"><?php echo $request["contact"] ?></td>
          <td style="width: 160px;"><?php echo $request["mop"] ?></td>
          <td style="width: 140px;">
          <form action="/../OOP/php/update_status.php" method="post" id="update_status<?php echo $request['service_id'] ?>">
          <select class="select" name="status">
          <option selected><?php echo $request["status"] ?></option>
          <?php //if ($request["mode"] == "pick-up") {?>
          <option value="On-process">On-process</option>
      <?php //}
        ?>
          <option value="Finished">Finished</option>
      </select>
      <input type="hidden" name="serviceID" value="<?php echo $request['service_id'] ?>">
          <input type="hidden" name="receiverID" value="<?php echo $request['seeker_id'] ?>">
      </form>
          </td>
          <td style="width: 145px;">
            <button class="update-btn" name="submit" type="submit" form="update_status<?php echo $request['service_id'] ?>">Update</button>
          </td>
      </tr>
      <?php }
}?>
        </tbody>
      </table>
  </div>
</section>

<!-- <script src="/../OOP/js/services.js"></script> -->
</body>
</html>