<?php
session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';
$paramSearch = "%" . $_POST["name"] . "%";
$id = $_SESSION["user_id"];

$sql = "SELECT DISTINCT(user.user_id), CONCAT(user.fname, ' ', user.mname, ' ', user.lname) AS name FROM user INNER JOIN user_provider ON user.user_id=user_provider.user_id AND user_provider.user_id != '$id' INNER JOIN subcategory ON subcategory.Subcategory_id=user_provider.Subcategory_id INNER JOIN category ON category.Category_id=subcategory.Category_id WHERE user.user_id != '$id' AND user.fname like '$paramSearch' OR user.mname like '$paramSearch' OR user.lname like '$paramSearch' OR user_provider.Service_description like '$paramSearch' OR subcategory.Subcategory like '$paramSearch' OR category.Category like '$paramSearch' ;";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '
    <li class="provide"><a href="/../OOP/pages/service-provider.php?userid=' . $row["user_id"] . '">' . $row['name'] . '</a></li>
';
        $userid = $row["user_id"];
        $sql1 = "SELECT  DISTINCT(category.Category), CONCAT(user.fname, ' ', user.mname, ' ', user.lname) AS name FROM user INNER JOIN user_provider ON user.user_id=user_provider.user_id INNER JOIN subcategory ON subcategory.Subcategory_id=user_provider.Subcategory_id INNER JOIN category ON category.Category_id=subcategory.Category_id WHERE user.user_id != '$id' AND  user.user_id = '$userid' AND user.fname like '$paramSearch' OR user.mname like '$paramSearch' OR user.lname like '$paramSearch' OR user_provider.Service_description like '$paramSearch' OR subcategory.Subcategory like '$paramSearch' OR category.Category like '$paramSearch';";
        //     $stmt1 = $conn->prepare($sql1, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        //     $stmt1->execute();
        //     while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        //         echo '
        // <li class="sub"><p>' . $row1['Category'] . '</p></li>
        // ';
        $userid = $row["user_id"];
        $sql2 = "SELECT  DISTINCT(subcategory.Subcategory), CONCAT(user.fname, ' ', user.mname, ' ', user.lname) AS name FROM user INNER JOIN user_provider ON user.user_id=user_provider.user_id INNER JOIN subcategory ON subcategory.Subcategory_id=user_provider.Subcategory_id INNER JOIN category ON category.Category_id=subcategory.Category_id WHERE user.user_id != '$id' AND  user.user_id = '$userid' AND user.fname like '$paramSearch' OR user.mname like '$paramSearch' OR user.lname like '$paramSearch' OR user_provider.Service_description like '$paramSearch' OR subcategory.Subcategory like '$paramSearch' OR category.Category like '$paramSearch';";
        $stmt2 = $conn->prepare($sql2, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt2->execute();
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            echo '
                <li class="sub"><i class="fa-sharp fa-solid fa-circle"></i><p>' . $row2['Subcategory'] . '</p></li>
        ';
        }
        // }
    }
} else {
    echo '
    <script>console.log("hi")</script>
    <li class="provide">
    <p>No Result</p></li>
';
}
// function liveSearch($keyword)
// {
//     include '../db_conn.php';
//     $paramSearch = "%" . $keyword . "%";
//     $sql = "SELECT * FROM user WHERE fname like ?";
//     $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
//     $stmt->execute([$paramSearch]);
//     $data = [];
//     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//         $data[] = $row;
//     }
//     // return $data;
//     // echo "<script>console.log($data)</script>";
//     // $data = executeGetDataBindParam($sql, "s", []);
//     echo json_encode($data);
// }
// SELECT DISTINCT(user.user_id),category.Category, CONCAT(user.fname, ' ', user.mname, ' ', user.lname) AS name FROM user INNER JOIN user_provider ON user.user_id=user_provider.user_id INNER JOIN subcategory ON subcategory.Subcategory_id=user_provider.Subcategory_id INNER JOIN category ON category.Category_id=subcategory.Category_id WHERE user.fname like '%uti%' OR user.mname like '%uti%' OR user.lname like '%uti%' OR user_provider.Service_description like '%uti%' OR subcategory.Subcategory like '%uti%' OR category.Category like '%uti%';
