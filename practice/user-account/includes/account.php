<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/account-sidebar.css">
    <title>Account</title>
</head>
<body>

<?php
include '../account-sidebar.php';
?>

<section class="myaccount-tabcontent" id="my-profile">
    <div class="my-profile-info">
        <h1><i class="fa-solid fa-user"></i> My Profile</h1>
        <p>Manage and Protect your account</p>
        <hr />
    </div>
    <div class="container">
        <form id="profile-form" action="/../OOP/php/include/profile.inc.php" method="post" enctype="multipart/form-data">

        <?php
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM images WHERE user_id = '$user_id' AND image_type = 'profile'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($stmt->rowCount() == 0) {
    ?><img src="/../OOP/images/photo/default.png" />
                <?php } else {?>
                    <img src="/../OOP/images/photo/<?php echo $row['image_filename']; ?>" />
                    <div class="select-pic">
                        <input type="hidden" name="old-pic" value="<?php echo $row['image_filename']; ?>">
                    </div>
                <?php }?>
            <div class="profile-btn">
                <button id="select" name="profile-pic" type="submit">Upload</button>
                <input type="file" name="profile-pic" id="profile-pic" accept=".jpg, jpeg, .png" >
            </div>
        </form>
        <ul>
            <li>
            <label for="username"><i class="fa-solid fa-user"></i> Username:</label>
            <input type="text" class="username" placeholder="<?php echo $_SESSION["username"]; ?>" disabled/>
            </li>
            <li>
            <label for="name"><i class="fa-solid fa-user"></i> Name:</label>
            <input type="text" class="name" placeholder="<?php echo $_SESSION["user_fname"] . " " . $_SESSION["user_mname"] . " " . $_SESSION["user_lname"]; ?>" disabled/>
            </li>
            <li>
            <label for="email"><i class="fa-solid fa-envelope"></i> Email:</label>
            <input type="email" class="email" value="<?php echo $_SESSION["user_email"]; ?>" disabled>
            </li>
            <li>
            <label for="phone"><i class="fa-solid fa-phone"></i> Phone no.:</label>
            <input type="number" class="phone" value="<?php echo $_SESSION["user_contact"]; ?>" disabled />
            </li>
            <li>
            <label for="address"><i class="fa-solid fa-location-dot"></i> Address:</label>
            <input type="text" class="address" value="<?php echo $_SESSION["user_address"]; ?>" disabled />
            </li>
            <li>
            <label for="gender"><i class="fa-solid fa-venus-mars"></i> Gender:</label>
            <input type="text" class="gender" value="<?php echo $_SESSION["user_gender"]; ?>" disabled />
            </li>
            <li>
            <label for="dateob"><i class="fa-solid fa-calendar-days"></i> Date of Birth:</label>
            <input type="text" class="dob" value="<?php
echo $_SESSION["user_dob"]; ?>" disabled />
            </li>
            <li>
            <a href="/../OOP/practice/user-account/includes/account-edit.php"><input type="button" class="edit-btn" value="Edit"></a>
            </li>
        </ul>
    </div>
</section>
</body>
</html>



