<?php

session_start();
include '/xampp/htdocs/OOP/config/db_conn.php';
if (isset($_SESSION['user_id'])) {
    $origin = $_SESSION['user_barangay'];
}
$destination = $_GET['location'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/../OOP/css/map.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <title>Map</title>
</head>

<body></body>
  <?php

include '/xampp/htdocs/OOP/config/db_conn.php';

$sql = "SELECT CONCAT(barangay.barangay_name, ' ',municipality.municipality_name, ' ', province.province_name, ' ', country.country_name)
AS :location FROM user
  INNER JOIN barangay ON user.address=barangay.barangay_code
  INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
  INNER JOIN province ON barangay.province_code=province.province_code
  INNER JOIN country ON barangay.country_code=country.country_code
  WHERE barangay.barangay_code=:user";
?>
  <div>
    <h1><i class="fa-sharp fa-solid fa-map-location-dot"></i> Maps</h1>
    <p>Are you looking for something? Use these features to find what you need.</p>
    <button type="button" onclick="history.back()">Back</button>
  </div>

  <div class="container">

    <div class="map">
      <div id="my-map-display">
        <?php if (isset($_SESSION['user_id'])) {
    ?>
      <iframe
      frameborder="0" src="https://www.google.com/maps/embed/v1/directions?origin=
      <?php
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute([':location' => "originLocation", ':user' => $origin]);
    $location = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $location["originLocation"];
    ?>
  &destination=<?php
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute([':location' => "destinationLocation", ':user' => $destination]);
    $location = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $location["destinationLocation"];
    ?>&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8">
      </iframe>
      <?php } else {?>
        <div style="max-width:100%;list-style:none; transition: none;overflow:hidden;width:500px;height:500px;"><div id="my-map-canvas" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=<?php
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute([':location' => "destinationLocation", ':user' => $destination]);
    $location = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $location["destinationLocation"];
    ?>&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe></div><a class="google-map-html" rel="nofollow" href="https://www.bootstrapskins.com/themes" id="grab-map-info">premium bootstrap themes</a><style>#my-map-canvas img.text-marker{max-width:none!important;background:none!important;}img{max-width:none}</style></div>
      <?php }?>
    </div>
      <style>
        #my-map-display img {
          max-width: none !important;
          background: none !important;
          font-size: inherit;
          font-weight: inherit;
        }
      </style>
  </div>
</body>

</html>
