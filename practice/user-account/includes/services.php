<section class="myaccount-tabcontent" id="my-status-SP">
  <h1><i class="fa-sharp fa-solid fa-people-arrows"></i> Request Status</h1>
  <p>Update the status of your services that you provide.
  </p>
  <hr>
  <div class="proof-container">
    <h2><i class="fa-sharp fa-solid fa-table-list"></i> Request Status</h2>
    <table class="content-table">
      <thead>
        <tr>
          <th><i class="fa-sharp fa-solid fa-phone-volume"></i> Contact Number</th>
          <th><i class="fa-solid fa-hashtag"></i> Service Provider</th>
          <th><i class="fa-sharp fa-solid fa-handshake"></i> Service Type</th>
          <th><i class="fa-sharp fa-solid fa-phone-volume"></i> Contact Number</th>
          <th><i class="fa-sharp fa-solid fa-circle-check"></i> Status</th>
          <th><i class="fa-sharp fa-solid fa-circle-check"></i> Update</th>
        </tr>
      </thead>
      <tbody id="service_status">
      <?php
include '/../xampp/htdocs/OOP/config/db_conn.php';

$id = $_SESSION["user_id"];
$sql = "SELECT services.*, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, images.image_filename FROM services INNER JOIN user ON services.seeker_id=user.user_id LEFT JOIN images ON services.seeker_id=images.user_id WHERE services.provider_id = '$id' AND services.status = 'Pending'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$monitorRequest = "";

if ($stmt->rowCount() == 0) {
    $monitorRequest .= "No Subscription Request";
} else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
        <tr>
        <td><?php echo $request["service_id"] ?></td>
        <td><a href="/../OOP/pages/message.php?userid=<?php echo $request["provider_id"] ?>"> <?php echo $request["providerName"] ?></a></td>
        <td><?php echo $request["service"] ?></td>
        <td><?php echo $request["contact"] ?></td>
        <td>
        <form action="/../OOP/php/update_status.php" method="post" id="update_status">
        <select class="select" name="status">
        <option disabled selected><?php echo $request["status"] ?></option>
        <option value="pending">Pending</option>
        <option value="on-process">On Process</option>
        <option value="finished">Finished</option>
        <input type="hidden" name="serviceID" value="<?php echo $request['service_id'] ?>">
    </select>
    </form>
        </td>
        <td>
          <button name="submit" type="submit" form="update_status">Update</button>
        </td>
    </tr>
    <?php }
}?>
      </tbody>
    </table>
  </div>
</section>

<section class="myaccount-tabcontent" id="my-request-SP">
  <h1><i class="fa-solid fa-screwdriver-wrench"></i> Service Provider Request</h1>
  <div class="parag">
    <p>Hello, Erwin! You cannot access these features if you
      are a service seeker. Please subscribe or update your
      payment if you want to use these features.</p>
  </div>
  <hr>
  <div id="service_request" class="inquiry-grid">
    <div class="inquiry">
      <div class="inquiry-account-profile">
        <img src="4.png" />
        <h2>Hermogenes II Pelaez-Magsino</h2>
      </div>
      <div class="inquiry-basic-information">
        <hr>
        <ul>
          <li>
            <p class="info"><i class="fa-solid fa-user"></i> Name:</p>
            <label for="info">Erwin Jardeleza</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-location-dot"></i> Location:</p>
            <label for="info"> Caigangan, Buenavista, Marinduque </label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-phone"></i> Contact Number:</p>
            <label for="info">09466732135</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-screwdriver-wrench"></i> Service Request:</p>
            <label for="info">Cellphone Repair</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-calendar-days"></i> Date Schedule:</p>
            <label for="info">06/14/2022</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-hand-holding-dollar"></i> Mode of Service:</p>
            <label for="info">Walk In</label>
          </li>
          <li>
            <p class="info"><i class="fa-solid fa-plus"></i> Other Description/Issue:</p>
            <label for="info">
              <div class="description-info">Magapa ayos ng nasirang puso</div>
            </label>
          </li>
        </ul>
      </div>
      <div class="btns">
        <button><i class="fa-solid fa-paper-plane"></i> Message</button>
        <button><i class="fa-solid fa-square-check"></i> Accept</button>
        <button><i class="fa-sharp fa-solid fa-ban"></i> Decline</button>
      </div>
    </div>
  </div>
</section>

<section class="myaccount-tabcontent" id="promote-table">
  <h1><i class="fa-sharp fa-solid fa-list"></i> Promote</h1>
  <p>View the status of your services request.
  </p>
  <hr>
  <div class="proof-container">
    <table class="content-table">
      <thead>
        <tr>
          <th><i class="fa-sharp fa-solid fa-list"></i> Category</th>
          <th><i class="fa-sharp fa-solid fa-circle-info"></i> Sub-Category</th>
          <th><i class="fa-sharp fa-solid fa-image"></i> Description</th>
          <th><i class="fa-solid fa-trash"></i> Delete</th>
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
          <td><?php echo $service["Category"] ?></td>
          <td>
            <p>
            <?php echo $service["Subcategory"] ?>
            </p>
          </td>
          <td><?php echo $service["Service_description"] ?></td>
          <td> <form action="/../OOP/php/delete_promote.php" method="POST">
            <input type="hidden" name="spID" value="<?php echo $service["SP_id"] ?>">
            <button type="submit" name="submit" class="edit">Delete</button>
            </form></td>

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
    <button class="edit" onclick="openMyAccount(event, 'my-description')">Add</button>
  </div>
</section>

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
          <th><i class="fa-sharp fa-solid fa-calendar-days"></i> Date</th>
          <th><i class="fa-sharp fa-solid fa-clock"></i></i> Time</th>
          <th><i class="fa-sharp fa-solid fa-file-invoice"></i> Service Number</th>
          <th><i class="fa-sharp fa-solid fa-handshake"></i> Service Type</th>
          <th><i class="fa-sharp fa-solid fa-phone-volume"></i> Contact Number</th>
          <th><i class="fa-sharp fa-solid fa-map-location-dot"></i> Address</th>
          <th><i class="fa-sharp fa-solid fa-circle-check"></i> Status</th>
          <th><i class="fa-sharp fa-solid fa-user-tie"></i> Customer</th>
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

<section class="myaccount-tabcontent" id="my-services">
  <h1><i class="fa-solid fa-screwdriver-wrench"></i> My Services</h1>
  <p> Upgrade your account to take your experience to the next level.</p>
  <hr>
  <div class="service-container">
    <h3>Upgrade to a Service Provider account and access exclusive features.</h4>
      <img src="subs.png" alt="picture to insert!!!!">
      <p>Hello, Erwin! You cannot access these features if you
        are a service seeker. Please subscribe or update your
        payment if you want to use these features.</p>
      <?php
$userid = $_SESSION['user_id'];
$sql = "SELECT subscription_id FROM subscription WHERE user_id = '$userid' ";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
if ($stmt->rowCount() == 0) {
    ?>
        <form action="/../OOP/php/subscription_free.php" method="post">
          <button type="submit" name="submit">Start Free Trial</button>
        </form>
      <?php }?>
      <!-- <input type="button" value="Upgrade" class="spass"> -->
      <input type="button" class="save-btn" value="Upgrade" onclick="openMyAccount(event, 'my-subscription')" />
      <!-- <input type="button" value="Upgrade" class="spass"> -->
  </div>
</section>

<section class="myaccount-tabcontent" id="my-description">
    <h1><i class="fa-solid fa-receipt"></i> Your Descripiton</h1>
    <p>Inserting your job description here will help you in being
      easily recognized by service seekers and in promoting
      and advertising your services.</p>
    <hr>
    <div class="app-container">
      <h2><i class="fa-solid fa-circle-exclamation"></i> Please enter your description here.</h2>
      <img src="receipt.png" alt="image to be insert!!!">
      <div class="app-dropdown">
      <form action="/../OOP/php/upgradeAccount_function.php" method="POST">
        <select name="category" id="category" onclick="csload(1); this.onclick=null;">
          <option value="" hidden>Category</option>
        </select>

        <select name="specific-service" id="specific-service" onclick="csload(2); this.onclick=null;">
          <option value="" hidden>Sub-Category</option>
        </select>
      </div>
      <input type="text" name="upgrade-account-description" class="description-box" placeholder="Write your description here.">
      <input type="submit" value="Proceed" class="spass">
      </form>
    </div>
  </section>
<script src="/../OOP/js/services.js"></script>