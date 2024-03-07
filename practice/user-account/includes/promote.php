<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/service.css">
  <link rel="stylesheet" href="../css/account-sidebar.css">
  <title>Promote</title>
</head>

<body>
  <?php
include '../account-sidebar.php';
?>
  <section class="myaccount-tabcontent" id="promote-table">
    <h1><i class="fa-sharp fa-solid fa-list"></i> Promote</h1>
    <p>Use this feature to advertise and promote your services
      in order to increase your income and grow your
      business or services.
    </p>
    <hr>
    <div class="proof-container">
      <table class="content-table">
        <thead>
          <tr>
            <th style="width: 200px;"><i class="fa-sharp fa-solid fa-list"></i> Category</th>
            <th style="width: 300px;"><i class="fa-sharp fa-solid fa-circle-info"></i> Sub-Category</th>
            <th style="width: 400px;"><i class="fa-sharp fa-solid fa-image"></i> Description</th>
            <th style="width: 200px;"><i class="fa-solid fa-trash"></i> Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
include '/../xampp/htdocs/OOP/config/db_conn.php';
$id = $_SESSION["user_id"];
$sql = "SELECT user_provider.*, category.Category, subcategory.Subcategory from user_provider INNER JOIN subcategory ON user_provider.Subcategory_id=subcategory.Subcategory_id INNER JOIN category ON subcategory.Category_id=category.Category_id WHERE user_provider.user_id = '$id' ";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
while ($service = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
            <tr>
              <td style="width: 200px;"><?php echo $service["Category"] ?></td>
              <td style="width: 300px;">
                <p>
                  <?php echo $service["Subcategory"] ?>
                </p>
              </td>
              <td style="width: 400px;"><?php echo $service["Service_description"] ?></td>
              <td style="width: 200px;">
                <form action="/../OOP/php/delete_promote.php" method="POST">
                  <input type="hidden" name="spID" value="<?php echo $service["SP_id"] ?>">
                  <button type="submit" name="submit" class="edit">Delete</button>
                </form>
              </td>
            </tr>

          <?php }?>
          <!-- <tr>
          <td>Furniture</td>
          <td>Wood Curving</td>
          <td>
            <p>
              Kami po ay gumagawa ng ibatibang kagamitan sa bahay,
              tulad ng bangko, lamesa, aparador at iba pa.
            </p>
          </td>
          <td>
            <button>Edit</button>
          </td>
        </tr> -->
        </tbody>
      </table>
    </div>
    <div class="but">
      <a href="/../OOP/practice/user-account/includes/description.php">
        <button class="edit" onclick="openMyAccount(event, 'my-description')">Add</button>
      </a>
      <a href="/../OOP/pages/service-provider.php?userid= <?php echo $id; ?>">
        <button class="view">View Profile</button>
      </a>
    </div>
    <form action="/../OOP/php/main_description.php" method="post">
      <div class="main-description">
        <h2>Allow us to assist you in promoting and advertising your services
          and business by simply putting your Service description here to boost your customers.</h2>
        <div class="edit-promote-description">
          <?php
$userID = $_SESSION['user_id'];
$sql = "SELECT * from provider_description WHERE user_id = '$userID'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$sql2 = "SELECT * from availability WHERE user_id = '$userID'";
$stmt2 = $conn->prepare($sql2, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt2->execute();
$availability = $stmt2->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() != 0) {
    $description = $stmt->fetch(PDO::FETCH_ASSOC);?>
            <input class="description" type="text" name="main-description" id="main-description" value="<?php echo $description["description"] ?>">
          <?php } else {?>
            <input class="description" type="text" name="main-description" id="main-description" value="MAIN DESCRIPTION HERE">
          <?php }?>
          <div class="availability-container">
            <div class="availability">
              <ul class="day">
                <li>
                  <h3>Work Day</h3>
                </li>
                <li><input type="checkbox" id="sunday" name="sunday" value="1" <?php if ($stmt2->rowCount() != 0) {
    echo $checked = $availability["sunday"] == 0 ? "" : " checked";
}?>>
                  <label for="sunday">Sunday</label>
                </li>
                <li><input type="checkbox" id="monday" name="monday" value="1" <?php if ($stmt2->rowCount() != 0) {
    echo $checked = $availability["monday"] == 0 ? "" : " checked";
}?>>
                  <label for="monday"> Monday</label>
                </li>
                <li><input type="checkbox" id="tuesday" name="tuesday" value="1" <?php if ($stmt2->rowCount() != 0) {
    echo $checked = $availability["tuesday"] == 0 ? "" : " checked";
}?>>
                  <label for="tuesday"> Tuesday</label>
                </li>
                <li><input type="checkbox" id="thursday" name="thursday" value="1" <?php if ($stmt2->rowCount() != 0) {
    echo $checked = $availability["wednesday"] == 0 ? "" : " checked";
}?>>
                  <label for="thursday"> Thursday</label>
                </li>
                <li><input type="checkbox" id="wednesday" name="wednesday" value="1" <?php if ($stmt2->rowCount() != 0) {
    echo $checked = $availability["thursday"] == 0 ? "" : " checked";
}?>>
                  <label for="wednesday"> Wednesday</label>
                </li>
                <li><input type="checkbox" id="friday" name="friday" value="1" <?php if ($stmt2->rowCount() != 0) {
    echo $checked = $availability["friday"] == 0 ? "" : " checked";
}?>>
                  <label for="friday"> Friday</label>
                </li>
                <li><input type="checkbox" id="saturday" name="saturday" value="1" <?php if ($stmt2->rowCount() != 0) {
    echo $checked = $availability["saturday"] == 0 ? "" : " checked";
}?>>
                  <label for="saturday"> Saturday</label>
                </li>
              </ul>
              <ul class="time">
                <li>
                  <h3>Work Time</h3>
                </li>
                <li>
                  <input type="time" name="sundayIn" id="sundayIn" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["sundayIn"] == '00:00:00' ? "" : 'value=' . $availability["sundayIn"];
}?>>
                  <input type="time" name="sundayOut" id="sundayOut" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["sundayOut"] == '00:00:00' ? "" : 'value=' . $availability["sundayOut"];
}?>>
                </li>
                <li>
                  <input type="time" name="mondayIn" id="mondayIn" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["mondayIn"] == '00:00:00' ? "" : 'value=' . $availability["mondayIn"];
}?>>
                  <input type="time" name="mondayOut" id="mondayOut" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["mondayOut"] == '00:00:00' ? "" : 'value=' . $availability["mondayOut"];
}?>>
                </li>
                <li>
                  <input type="time" name="tuesdayIn" id="tuesdayIn" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["tuesdayIn"] == '00:00:00' ? "" : 'value=' . $availability["tuesdayIn"];
}?>>
                  <input type="time" name="tuesdayOut" id="tuesdayOut" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["tuesdayOut"] == '00:00:00' ? "" : 'value=' . $availability["tuesdayOut"];
}?>>
                </li>
                <li>
                  <input type="time" name="wednesdayIn" id="wednesdayIn" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["wednesdayIn"] == '00:00:00' ? "" : 'value=' . $availability["wednesdayIn"];
}?>>
                  <input type="time" name="wednesdayOut" id="wednesdayOut" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["wednesdayOut"] == '00:00:00' ? "" : 'value=' . $availability["wednesdayOut"];
}?>>
                </li>
                <li>
                  <input type="time" name="thursdayIn" id="thursdayIn" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["thursdayIn"] == '00:00:00' ? "" : 'value=' . $availability["thursdayIn"];
}?>>
                  <input type="time" name="thursdayOut" id="thursdayOut" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["thursdayOut"] == '00:00:00' ? "" : 'value=' . $availability["thursdayOut"];
}?>>
                </li>
                <li>
                  <input type="time" name="fridayIn" id="fridayIn" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["fridayIn"] == '00:00:00' ? "" : 'value=' . $availability["fridayIn"];
}?>>
                  <input type="time" name="fridayOut" id="fridayOut" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["fridayOut"] == '00:00:00' ? "" : 'value=' . $availability["fridayOut"];
}?>>
                </li>
                <li>
                  <input type="time" name="saturdayIn" id="saturdayIn" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["saturdayIn"] == '00:00:00' ? "" : 'value=' . $availability["saturdayIn"];
}?>>
                  <input type="time" name="saturdayOut" id="saturdayOut" <?php if ($stmt2->rowCount() != 0) {
    echo $time = $availability["saturdayOut"] == '00:00:00' ? "" : 'value=' . $availability["saturdayOut"];
}?>>
                </li>
              </ul>
              <ul>
                <li>
                  <h3>Availability</h3>

              </li>
              <li>
                <div class="switch">

                  <input type="checkbox" name="availability" id="switch" value="1" <?php if ($stmt2->rowCount() != 0) {
    echo $checked = $availability["availability"] == 0 ? "" : " checked";
}?>>
                  <label for="switch" class="slider"></label>
                </div>
              </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="btnns">
        <!-- <button>Edit</button> -->
        <input class="submmit" name="submit" type="submit" value="Save">
      </div>
      </div>
    </form>
  </section>


  <!-- <script src="/../OOP/js/services.js"></script> -->
</body>

</html>