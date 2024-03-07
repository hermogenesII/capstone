<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: /../OOP/pages/alert.php");
} elseif (!isset($_GET['userid'])) {
    header("Location: /../OOP/index.php");
} else {
    $userid = $_GET['userid'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <link rel="stylesheet" href="../css/hire.css">
    <title>Hire Me!</title>
</head>

<body>
    <div class="image">
        <img src="/../OOP/images/icon/hire.png" alt="image">
        <h1>Everyday life made easier</h1>
        <h4>When life gets busy, you don’t have to tackle it alone. <br>Get
            time back for what you love without breaking the bank.</h4>
        <p><i class="fa-solid fa-check"></i> Choose your Tasker by reviews, skills, and price</p>
        <p><i class="fa-solid fa-check"></i> Schedule when it works for you — as early as today</p>
        <p><i class="fa-solid fa-check"></i> Chat, pay, tip, and review all through one platform</p>
    </div>
    <div class="head">
        <?php $sql = "SELECT CONCAT(fname, ' ', lname) AS SPName FROM user WHERE user_id = '$userid'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$SP = $stmt->fetch(PDO::FETCH_ASSOC);
?>
        <h1><i class="fa-brands fa-hire-a-helper"></i>ire Me!</h1>
        <h3 class="SPName"><?php echo $SP["SPName"]; ?></h3>
        <p>( Service Provider )</p>
    </div>
    <form action="/../OOP/php/hire.php" id="hire-form" method="post">
        <section class="hire-form">
            <label for="check"><i class="fa-solid fa-bell" aria-hidden="true"></i>Hire as other</label>
            <input type="checkbox" class="dropdown-check" id="check">

            <div class="form-container">
                <div class="top-form-id">
                    <div class="hide">
                        <div class="name">
                            <p><i class="fa-solid fa-user"></i>Name: </p>
                            <input type="text" name="name">
                        </div>
                        <div class="location">
                            <p><i class="fa-solid fa-location-dot"></i> Location: </p>
                            <div class="address">
                                <select name="country" id="country" onclick="csload(1); this.onclick=null;">
                                    <option value="" hidden>Country</option>
                                </select>
                                <select name="province" id="province" onclick="csload(2); this.onclick=null;">
                                    <option value="" hidden>Province</option>
                                </select>
                                <select name="municipality" id="municipality" onclick="csload(3); this.onclick=null;">
                                    <option value="" hidden>Municipality</option>
                                </select>
                                <select name="barangay" id="barangay" onclick="csload(4); this.onclick=null;">
                                    <option value="" hidden>Barangay</option>
                                </select>
                            </div>
                        </div>
                        <div class="number">
                            <p><i class="fa-solid fa-address-book"></i> Contact Number: </p>
                            <input type="tel" name="contact">
                        </div>
                    </div>
                    <div class="not-hide">
                        <div class="service-request">
                            <p><i class="fa-solid fa-toolbox"></i> Service Request: </p>
                            <select name="service" id="service" required>
                                <option value="select" hidden>Select</option>
                                <?php $sql = "SELECT subcategory.Subcategory FROM user_provider INNER JOIN subcategory ON subcategory.Subcategory_id=user_provider.Subcategory_id WHERE user_provider.user_id = '$userid'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
while ($service = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
                                    <option value="<?php echo $service["Subcategory"] ?>"><?php echo $service["Subcategory"] ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mode-service">
                            <p><i class="fa-solid fa-screwdriver-wrench"></i> Mode of Service: </p>
                            <select name="mos" id="mos">
                                <!-- mos(Mode of Service) -->
                                <option value="select" hidden>Select</option>
                                <option value="home-service">Home Service</option>
                                <option value="walk-in">Walk In</option>
                                <!-- <option value="pick-up">Pick up</option> -->
                            </select>
                        </div>
                        <div class="mode-payment">
                            <p><i class="fa-solid fa-credit-card"></i> Mode of Payment: </p>
                            <select name="mop" id="mop">
                                <!-- mos(Mode of Service) -->
                                <option value="select" hidden>Select</option>
                                <option value="cash">Cash</option>
                                <option value="online-payment">Online</option>
                            </select>
                        </div>
                        <div class="schedule">
                            <p><i class="fa-solid fa-calendar-days"></i> Date of Schedule: </p>
                            <input type="date" name="dos" id="dos">
                        </div>
                        <label for="check1"><i class="fa-sharp fa-solid fa-business-time" aria-hidden="true"></i></i>Rush</label>
                        <input type="checkbox" class="dropdown-check1" id="check1"><p style="display: inline; color: red;">*additional fees</p>
                        <div class="hide1">
                            <div class="number">
                                <p><i class="fa-solid fa-address-book"></i> Preferred Time: </p>
                                <input type="time" name="preferred-time">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="low-form">
                <div class="other">
                    <p>Other Description/Issue: </p>
                </div>
                <div class="description">
                    <textarea id="text" name="description"></textarea>
                </div>
                <div class="buttons">
                    <div class="pula">
                        <input type="hidden" name="providerID" value="<?php echo $userid; ?>">
                        <input type="submit" name="submit" value="Submit" class="sbmt-btn">
                    </div>
                    <button type="button" class="sbmt-btn" onclick="window.history.go(-1);;">Cancel</button>
                    <!-- <input type="submit" value="Cancel" class="sbmt-btn"> -->
                </div>
            </div>

        </section>
    </form>

    <script src="/../OOP/js/address_hire.js"></script>


    <script>
        dos.min = new Date().toISOString().split("T")[0];
    </script>
</body>

</html>