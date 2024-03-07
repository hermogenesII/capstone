<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

// $id = $_SESSION["user_id"];
$sql = "SELECT subscription.*, CONCAT(user.fname, ' ', user.lname) AS name FROM subscription INNER JOIN user ON subscription.user_id=user.user_id WHERE subscription.status = 'pending' ORDER BY subscription.subscription_id DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$subcriptionList = "";

if ($stmt->rowCount() == 0) {
    $subcriptionList .= "No Subscription Request";
} else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $subcriptionList .= ' <tr>
                                <td>' . $request['name'] . '</td>
                                <td>' . $request['subscription_type'] . '</td>
                                <td>' . $request['reference'] . '</td>
                                <td> <img class="referenceImg" id="image" src="/../OOP/practice/user-account/includes/reference/' . $request['reference_img'] . '" alt=""></td>
                                <td>
                                <form action="/../OOP/admin/php/update_subscription.php" method="post">
                                <input type="hidden" name="userid" value="' . $request['user_id'] . '">
                                <input type="hidden" name="type" value="' . $request['subscription_type'] . '">
                                <input type="hidden" name="subsid" value="' . $request['subscription_id'] . '">
                                  <button type="submit" name="submit" value="approved" class="accept"><i class="fa-sharp fa-solid fa-circle-check"></i></button>
                                  </form>
                                </td>
                                <td>
                                <form action="/../OOP/admin/php/update_subscription.php" method="post">
                                <input type="hidden" name="userid" value="' . $request['user_id'] . '">
                                <input type="hidden" name="type" value="' . $request['subscription_type'] . '">
                                <input type="hidden" name="subsid" value="' . $request['subscription_id'] . '">
                                  <button type="submit"  name="submit" value="disapproved"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
                                  </form>
                                </td>
                              </tr>';
    }
}
echo $subcriptionList;
