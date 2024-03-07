<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

// $id = $_SESSION["user_id"];
$sql = "SELECT user.*, CONVERT(user.registration_date, date) AS date, CONVERT(user.registration_date, time) AS time, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name FROM user
INNER JOIN barangay ON user.address=barangay.barangay_code
            INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
            INNER JOIN province ON barangay.province_code=province.province_code
            INNER JOIN country ON barangay.country_code=country.country_code
WHERE reviewed = 0 ORDER BY date DESC, time DESC;";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$userList = "";

if ($stmt->rowCount() == 0) {
    $userList .= "No Subscription Request";
} else {
    while ($request = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // $chatName = $chat['image_filename'] == null ? "default.png" : $chat['image_filename'];
        $userList .= '  <tr>
                          <td>' . $request["date"] . '</td>
                          <td>' . $request["time"] . '</td>
                          <td>' . $request["email"] . '</td>
                          <td>' . $request["barangay_name"] . " " . $request["municipality_name"] . " " . $request["province_name"] . " " . $request["country_name"] . '</td>
                          <td>' . $request["fname"] . " " . $request["mname"] . " " . $request["lname"] . '</td>
                          <td>
                            <button> <a href="/../OOP/admin/view-more.php?userid=' . $request["user_id"] . '">View More</a></button>
                          </td>
                        </tr>
                          ';
    }

}
echo $userList;
