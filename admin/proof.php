<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <link rel="stylesheet" href="./css/proof.css" />
  <link rel="stylesheet" href="./css/sidebar.css" />

  <title>Subscription</title>
</head>

<body>
  <?php
include '../admin/sidebar.php';
?>
  <section class="myaccount-tabcontent" id="proof">
    <h1><i class="fa-sharp fa-solid fa-receipt"></i> Subscription</h1>
    <p class="paragraph">View the status of your services request.</p>
    <hr>
    <div class="proof-container">
      <table class="content-table">
        <thead>
          <tr>
            <th> Name</th>
            <th> Duration</th>
            <th> Reference No.</th>
            <th> Receipt</th>
            <th> Validation</th>
            <th> Update</th>
          </tr>
        </thead>
        <tbody id="proof-js">
          <?php
include '/../xampp/htdocs/OOP/config/db_conn.php';

$sql1 = "SELECT subscription.*, CONCAT(user.fname, ' ', user.lname) AS name FROM subscription INNER JOIN user ON subscription.user_id=user.user_id WHERE subscription.status = 'pending' ORDER BY subscription.subscription_id DESC";
$stmt1 = $conn->prepare($sql1, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt1->execute();

if ($stmt1->rowCount() == 0) {?>
            <td>No Subscription Request</td>
            <?php } else {
    while ($request1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {?>
              <tr>
                <td><?php echo $request1['name']; ?></td>
                <td><?php echo $request1['subscription_type']; ?></td>
                <td><?php echo $request1['reference']; ?></td>
                <td> <img class="referenceImg" id="image" src="/../OOP/practice/user-account/includes/reference/<?php echo $request1['reference_img']; ?>" alt=""></td>
                <td>
                  <form action="/../OOP/admin/php/update_subscription.php" method="post" id="form-proof">
                    <input type="hidden" name="userid" value="<?php echo $request1['user_id']; ?>">
                    <input type="hidden" name="type" value="<?php echo $request1['subscription_type']; ?>">
                    <input type="hidden" name="subsid" value="<?php echo $request1['subscription_id']; ?>">
                    <select name="status" id="status">
                      <option value="approved">Accept</option>
                      <option value="disapproved">Decline</option>
                    </select>
                    <!-- <button type="submit" name="submit" value="approved" class="accept"><i class="fa-sharp fa-solid fa-circle-check"></i></button> -->
                  </form>
                </td>
                <td>
                    <button type="submit" name="submit" class="update-btn" onclick="document.getElementById('form-proof').submit()">Update</button>
                </td>
              </tr>
          <?php }
}?>

          <!-- <tr>
          <td>00003</td>
          <td>Annually</td>
          <td>12323456578</td>
          <td>2912789456_370449802345_176435_n</td>
          <td>
            <button class="accept"><i class="fa-sharp fa-solid fa-circle-check"></i></button>
          </td>
          <td>
            <button><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
          </td>
        </tr> -->
        </tbody>
      </table>
    </div>
  </section>

  <!-- <script src="/../OOP/js/proof.js"></script> -->
</body>

</html>