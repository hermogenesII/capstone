<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <link rel="stylesheet" href="./css/serviceprovider.css" />
  <link rel="stylesheet" href="./css/sidebar.css" />

  <title>Service Provider</title>
</head>
</body>
<?php
include '../admin/sidebar.php';
?>
<section class="myaccount-tabcontent" id="service-provider">
    <h1><i class="fa-sharp fa-solid fa-trowel-bricks"></i> Service Provider</h1>
    <p>View the status of your services request.
    </p>
    <hr>
    <div class="proof-container">
        <table class="content-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Categories</th>
              <th>Sub-Categories</th>
              <th>Description</th>
              <th><p> Accept</p></th>
              <th><p> Reject</p></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Erwin Andrade</td>
              <td>09 - 12 - 2022</td>
              <td> 08:19 </td>
              <td>Mechanics</td>
              <td>Motor</td>
              <td><p>
              Ako po ay gumagawa ng mga sirang motor.
              </p>
              </td>
              <td>
                <button class="accept"><i class="fa-sharp fa-solid fa-circle-check"></i></button>
              </td>
              <td>
                <button><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
              </td>
            </tr>
            <tr>
            <td>Hermogenes Magsino</td>
              <td>03 - 09 - 2022</td>
              <td> 03:21 </td>
              <td>Digital Services</td>
              <td>Laptop, Cellphones, tablets at ibp.</td>
              <td><p>
              Ako po ay nagaayos ng mga sirang gadgets.
              </p>
              </td>
              <td>
                <button class="accept"><i class="fa-sharp fa-solid fa-circle-check"></i></button>
              </td>
              <td>
                <button><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
              </td>
            <tr>
            <td>Bernadette Profeta</td>
              <td>12 - 07 - 2010</td>
              <td> 11:33 </td>
              <td>Garments</td>
              <td>Gown</td>
              <td><p>
              Nagpaparent po ako ng gown at iba pang mga kasuutan.
              </p>
              </td>
              <td>
                <button class="accept"><i class="fa-sharp fa-solid fa-circle-check"></i></button>
              </td>
              <td>
                <button><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
              </td>
            </tr>
            <tr>
            <td>Eudichael Jardeleza</td>
              <td>11 - 06 - 2012</td>
              <td> 07:22 </td>
              <td>Utilities</td>
              <td>Refrigerator</td>
              <td><p>
              Gumagawa po ako ng mga appliances tulad ng T.V, Refrigerator at iba pa.
              </p>
              </td>
              <td>
                <button class="accept"><i class="fa-sharp fa-solid fa-circle-check"></i></button>
              </td>
              <td>
                <button><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
              </td>
            <tr>
            <td>Joshua Historillo</td>
              <td>12 - 23 - 2009</td>
              <td> 12:31 </td>
              <td>Beauty Services</td>
              <td>Barbers</td>
              <td><p>
              Ako po ay nagugupit, tumatanggap din ako ng walk in at home service.
              </p>
              </td>
              <td>
                <button class="accept"><i class="fa-sharp fa-solid fa-circle-check"></i></button>
              </td>
              <td>
                <button><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
  </section>
</html>
