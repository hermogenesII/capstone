<?php
$dbhost = "localhost:3307";
$dbname = "xsample";
$dbchar = "utf8";
$dbuser = "root";
$dbpass = "";
try {
    $pdo = new PDO(
        "mysql:host=$dbhost;dbname=$dbname;charset=$dbchar",
        $dbuser, $dbpass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED,
        ]
    );
} catch (Exception $ex) {exit($ex->getMessage());}

if (!isset($_POST["segment"])) {
    exit();
}

switch ($_POST["segment"]) {

    default:
        exit();

    case "category":
        $stmt = $pdo->prepare("SELECT * FROM `category`");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            printf("<option value='%s'>%s</option>", "", "All Categories");
        }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            printf("<option value='%s'>%s</option>", $row["Category"], $row["Category"]);
        }
        break;

    case "specific-service":
        $stmt = $pdo->prepare("SELECT * FROM `subcategory` LEFT JOIN `category` ON subcategory.Category_id=category.Category_id WHERE category.Category = ?");
        $stmt->execute([$_POST["category"]]);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            printf("<option value='%s'>%s</option>", "", "Sub-Category");
        }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            printf("<option value='%s'>%s</option>", $row["Subcategory_id"], $row["Subcategory"]);
        }
        break;
}
