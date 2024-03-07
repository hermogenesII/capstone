<?php

session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
$userid = $_GET['userid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <link rel="stylesheet" href="./css/view-more.css" />
    <link rel="stylesheet" href="./css/sidebar.css" />

    <title>Verification</title>
</head>
</body>
<?php
include '/../xampp/htdocs/OOP/admin/sidebar.php';

$sql = "SELECT images.image_filename, user.*,CONCAT(user.fname, ' ', user.mname, ' ', user.lname) AS Name, CONCAT(barangay.barangay_name, ' ', municipality.municipality_name, ' ', province.province_name, ' ', country.country_name) AS Address FROM user
INNER JOIN barangay ON user.address=barangay.barangay_code
            INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
            INNER JOIN province ON barangay.province_code=province.province_code
            INNER JOIN country ON barangay.country_code=country.country_code
            INNER JOIN images ON user.user_id=images.user_id
WHERE user.user_id = '$userid' AND images.image_type = 'validID'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
// $user_request = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<section class="myaccount-tabcontent" id="view-more">
    <h1><i class="fa-solid fa-shield-halved"></i> Verification </h1>
    <p>Verify and review the hiring request of the service provider.
    </p>
    <hr>
    <div class="image-container">
        <div class="id-picture">
            <?php while ($user_request = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
                <img src="/../OOP/images/validID/<?php echo $user_request['image_filename'] ?>" alt="">
            <?php }?>
        </div>
        <div class="proof-container">
            <div class="head">
                <h1>Verification</h1>
            </div>
            <div class="content">
                <div class="content-value">
                    <p><i class="fa-regular fa-id-badge"></i> User ID : </p>
                    <p><i class="fa-solid fa-user"></i> Name: </p>
                    <p><i class="fa-solid fa-calendar"></i> Date of Birth: </p>
                    <p><i class="fa-solid fa-venus-mars"></i> Gender:</p>
                    <p><i class="fa-solid fa-location-dot"></i> Address: </p>
                    <p><i class="fa-solid fa-circle"></i> Contact no.: </p>
                </div>
                <div class="value">
                    <p><?php
$stmt->execute();
$user_request = $stmt->fetch(PDO::FETCH_ASSOC);

echo $user_request['user_id']?></p>
                    <p><?php echo $user_request['Name'] ?></p>
                    <p><?php echo $user_request['dob'] ?></p>
                    <p><?php echo $user_request['gender'] ?></p>
                    <p><?php echo $user_request['Address'] ?></p>
                    <p><?php echo $user_request['contact'] ?> </p>
                </div>
            </div>
            <div class="btn">
                <form action="/../OOP/admin/php/reviewed.php" method="post">
                    <input type="hidden" name="userid" value="<?php echo $user_request['user_id'] ?>">
                    <button type="button" class="back"> <a href="/../OOP/admin/userrequest.php">Back</a> </button>

                    <!-- <button type="submit" name="accept" value="Accept" class="accept">Accept</button>
                    <button type="submit" name="decline" value="Decline" class="decline">Decline</button> -->

                    <!-- Decline -->
                    <label for="declineBtn"><i class="fa-solid fa-times" aria-hidden="true"></i> Decline</label>
                    <input type="checkbox" class="declineBtn" id="declineBtn">
                    <div class="decline-container">
                        <div class="decline-prompt">
                            <h1>Are you sure you want to decline it?</h1>
                            <button type="button" id="back1" class="back">Cancel</button>
                            <button type="submit" name="decline" value="Decline" class="accept" style="pointer-events: auto;">Ok</button>
                        </div>
                    </div>

                    <!-- Accept -->
                    <label for="acceptBtn"><i class="fa-solid fa-check" aria-hidden="true"></i> Accept</label>
                    <input type="checkbox" class="acceptBtn" id="acceptBtn">
                    <div class="accept-container">
                        <div class="accept-prompt">
                            <h1>Are you sure you want to Accept it?</h1>
                            <button type="button" id="back2" class="back">Cancel</button>
                            <button type="submit" name="accept" value="Accept" class="accept">Ok</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const declineBtn = document.querySelector('.declineBtn');
            const acceptBtn = document.querySelector('.acceptBtn');
            const parent = document.querySelector('.proof-container');

            declineBtn.addEventListener('change', function() {
                if (this.checked) {
                    parent.style.pointerEvents = 'none';
                } else {
                    parent.style.pointerEvents = 'auto';
                }
            });

            acceptBtn.addEventListener('change', function() {
                if (this.checked) {
                    parent.style.pointerEvents = 'none';
                } else {
                    parent.style.pointerEvents = 'auto';
                }
            });


            // const checkbox = document.querySelector('#checkbox');
            const button1 = document.querySelector('#back1');
            const button2 = document.querySelector('#back2');

            button1.addEventListener('click', function() {
                declineBtn.checked = false;
                // declineBtn.removeAttribute('checked');
                parent.style.pointerEvents = 'auto';
            });

            button2.addEventListener('click', function() {
                acceptBtn.checked = false;
                // acceptBtn.removeAttribute('checked');
                parent.style.pointerEvents = 'auto';
            });
        </script>
</section>

</html>