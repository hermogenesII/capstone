<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <link rel="stylesheet" href="./css/history.css" />
  <link rel="stylesheet" href="./css/sidebar.css" />

  <title>Activity Log</title>
</head>
</body>
<?php
include '../admin/sidebar.php';
?>
<section class="myaccount-tabcontent" id="history">
    <h1><i class="fa-solid fa-book-bookmark"></i> Activity Log</h1>
    <p>View the status of your services request.
    </p>
    <hr>
    <div class="proof-container">
        <table class="content-table">
          <thead>
            <tr>
              <th> ID</th>
              <th> Date</th>
              <th> Customer</th>
              <th> Provider</th>
              <th> Category</th>
              <th> Status</th>
              <th><p> View </p></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>00001</td>
              <td>09 - 01 - 2022</td>
              <td>Erwin Andrade</td>
              <td>Hermogenes Magsino</td>
              <td>Furniture</td>
              <td>Done</td>
              <td>
                <button><i class="fa-solid fa-eye"></i></button>
              </td>
            </tr>
            <tr>
            <td>00002</td>
              <td>07 - 17 - 2021</td>
              <td>Eudichae Jardeleza</td>
              <td>Vincent Andrew Monleon</td>
              <td>Garments</td>
              <td>Done</td>
              <td>
                <button><i class="fa-solid fa-eye"></i></button>
              </td>
            <tr>
              <td>00003</td>
              <td>11 - 23 - 2022</td>
              <td>Hermogenes Magsino</td>
              <td>Eudichael Jardeleza</td>
              <td>Mechanics</td>
              <td>Cancelled</td>
              <td>
                <button><i class="fa-solid fa-eye"></i></button>
              </td>
            </tr>
            <tr>
            <td>00004</td>
              <td>09 - 09 - 2020</td>
              <td>Patrick Dave Zoleta</td>
              <td>Erwin Andrade</td>
              <td>Electronics</td>
              <td>Done</td>
              <td>
                <button><i class="fa-solid fa-eye"></i></button>
              </td>
            <tr>
            <td>00005</td>
              <td>06 - 11 - 2022</td>
              <td>Emerson Lacdao</td>
              <td>Megg Jake Grave</td>
              <td>Spa</td>
              <td>Cancelled</td>
              <td>
                <button><i class="fa-solid fa-eye"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
  </section>
  </section>
</html>
