<?php
$dbhost = "localhost:3307";
$dbname = "xsample";
$dbchar = "utf8";
$dbuser = "root";
$dbpass = "";
try {
    $pdo = new PDO(
        "mysql:host=$dbhost;dbname=$dbname;charset=$dbchar",
        $dbuser,
        $dbpass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED,
        ]
    );
} catch (Exception $ex) {
    exit($ex->getMessage());
}

if (!isset($_POST["segment"])) {
    exit();
}

switch ($_POST["segment"]) {

    default:
        exit();

    case "country":
        $stmt = $pdo->prepare("SELECT * FROM `country`");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            printf("<option value='%s'>%s</option>", $row["country_code"], $row["country_name"]);
        }
        break;

    case "province":
        $stmt = $pdo->prepare("SELECT * FROM `province` WHERE `country_code` = ?");
        $stmt->execute([$_POST["country"]]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            printf("<option value='%s'>%s</option>", $row["province_code"], $row["province_name"]);
        }
        break;

    case "municipality":
        $stmt = $pdo->prepare("SELECT * FROM `municipality` WHERE `country_code` = ? AND `province_code` = ?");
        $stmt->execute([$_POST["country"], $_POST["province"]]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            printf("<option value='%s'>%s</option>", $row["municipality_code"], $row["municipality_name"]);
        }
        break;

    case "barangay":
        $stmt = $pdo->prepare("SELECT * FROM `barangay` WHERE `country_code` = ? AND `province_code` = ? AND `municipality_code` = ?");
        $stmt->execute([$_POST["country"], $_POST["province"], $_POST["municipality"]]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            printf("<option value='%s'>%s</option>", $row["barangay_code"], $row["barangay_name"]);
        }
}
