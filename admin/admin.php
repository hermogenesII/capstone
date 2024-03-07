<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (!isset($_SESSION['role'])) {
    header("Location: /../OOP/pages/alert.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="stylesheet" href="../admin/css/sidebar.css" />
  <link rel="stylesheet" href="../admin/css/admin.css" />


  <title>Dashboard</title>
</head>

<body>
  <?php
include '../admin/sidebar.php';
?>
  <!-- Dashboard -->
  <section class="myaccount-tabcontent" id="dashboard">
    <aside class="admin-side-container">

      <section class="admin-graph">
        <?php
$sql = "SELECT COUNT(DISTINCT(user_id)) AS providerCount FROM user_provider INNER JOIN subcategory ON user_provider.Subcategory_id=subcategory.Subcategory_id INNER JOIN category ON category.Category_id=subcategory.Category_id WHERE category = :category";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
?>
        <div class="admin-header">
          <h1><i class="fa-sharp fa-solid fa-file-contract"></i> Dashboard</h1>
          <img src="../admin/images/admin.jpeg" alt="profile!">
        </div>
        <div class="data-container">
          <div class="data-analytics">
            <div class="title">
              <p><i class="fa-brands fa-servicestack"></i> Services</p>
            </div>
            <div class="services-graph">

              <div class="services-tab" id="graph1">
                <h1><i class="fa-sharp fa-solid fa-toolbox"></i></h1>
                <?php $stmt->execute([':category' => "Utility"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);?>
                <p class="num"><?php echo $count["providerCount"] ?></p>
                <p>Utility</p>
                <button>View Details</button>
              </div>

              <div class="services-tab" id="graph2">
                <h1><i class="fa-sharp fa-solid fa-house-laptop"></i></h1>
                <?php $stmt->execute([':category' => "Electronic"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);?>
                <p class="num"><?php echo $count["providerCount"] ?></p>
                <p>Electronic Devices</p>
                <button>View Details</button>
              </div>

              <div class="services-tab" id="graph3">
                <h1><i class="fa-sharp fa-solid fa-car"></i></h1>
                <?php
$stmt->execute([':category' => "Mechanic"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
                <p class="num"><?php echo $count["providerCount"] ?></p>
                <p>Mechanics</p>
                <button>View Details</button>
              </div>

              <div class="services-tab" id="graph4">
                <h1><i class="fa-sharp fa-solid fa-shirt"></i></h1>
                <?php
$stmt->execute([':category' => "Garment"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
                <p class="num"><?php echo $count["providerCount"] ?></p>
                <p>Garments</p>
                <button>View Details</button>
              </div>

              <div class="services-tab" id="graph5">
                <h1><i class="fa-sharp fa-solid fa-shop"></i></h1>
                <?php
$stmt->execute([':category' => "Furniture"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
                <p class="num"><?php echo $count["providerCount"] ?></p>
                <p>Furniture</p>
                <button>View Details</button>
              </div>

              <div class="services-tab" id="graph6">
                <h1><i class="fa-sharp fa-solid fa-print"></i></h1>
                <?php
$stmt->execute([':category' => "Printing"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
                <p class="num"><?php echo $count["providerCount"] ?></p>
                <p>Digital Printing</p>
                <button>View Details</button>
              </div>

              <div class="services-tab" id="graph7">
                <h1><i class="fa-sharp fa-solid fa-spa"></i></h1>
                <?php
$stmt->execute([':category' => "Beauty"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
                <p class="num"><?php echo $count["providerCount"] ?></p>
                <p>Beauty Services</p>
                <button>View Details</button>
              </div>

              <div class="services-tab" id="graph8">
                <h1><i class="fa-sharp fa-solid fa-dumpster-fire"></i></h1>
                <?php
$stmt->execute([':category' => "Other"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
                <p class="num"><?php echo $count["providerCount"];
$stmt = null; ?></p>
                <p>Others</p>
                <button>View Details</button>
              </div>
            </div>
          </div>

          <!-- avail -->
          <div class="avail-analytics">
            <div class="avail">
              <h1 class="services"><i class="fa-solid fa-file-invoice-dollar"></i> Payments</h1>
            </div>
            <div class="avail-tab">
              <div class="chart-box">
                <h2>Statistic Presentation of Payments</h2>
                <canvas id="myChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- users!!! -->
      <section class="admin-users">
        <div class="user-container">
          <div class="table-user">
            <div class="services">
              <h1><i class="fa-solid fa-users"></i> Users</h1>
            </div>
            <table class="content-table">
              <thead>
                <tr>
                  <th style="width: 155px;"><i class="fa-solid fa-calendar-week"></i> Date</th>
                  <th style="width: 260px;"><i class="fa-solid fa-users"></i> Name</th>
                  <th style="width: 220px;"><i class="fa-solid fa-envelope"></i> Email</th>
                  <th style="width: ;"><i class="fa-solid fa-venus-mars"></i> Gender</th>
                  <th style="width: ;"><i class="fa-solid fa-address-book"></i> Contact No.</th>
                </tr>
              </thead>
              <tbody>
              <?php
$sql = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname ) AS userName FROM user WHERE reviewed = 1 ORDER BY user.user_id DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
                <tr>
                  <td style="width: 155px;"><?php echo $user["registration_date"]; ?></td>
                  <td style="width: 260px;"><?php echo $user["userName"]; ?></td>
                  <td style="width: 200px;"><?php echo $user["email"]; ?></td>
                  <td style="width: ;"><?php echo $user["gender"]; ?></td>
                  <td style="width: ;"><?php echo $user["contact"]; ?></td>
                </tr>
                <?php }
$stmt = null;?>
                <!-- <tr>
                  <td>03/01/22</td>
                  <td>Hermogenes II Magsino</td>
                  <td>hermogenesmagsino@gmail.com</td>
                  <td>Male</td>
                  <td>0912 767 8734</td>
                </tr>
                <tr>
                  <td>11/23/21</td>
                  <td>Eudichael Jardeleza</td>
                  <td>eudichaeljardeleza@gmail.com</td>
                  <td>Male</td>
                  <td>0932 768 2331</td>
                </tr>
                <tr>
                  <td>23/02/18</td>
                  <td>Joseph Samson</td>
                  <td>josephsamason@gmail.com</td>
                  <td>Male</td>
                  <td>0998 767 8341</td>
                </tr>
                <tr>
                  <td>29/11/12</td>
                  <td>Michelle Saet</td>
                  <td>michellesaet@gmail.com</td>
                  <td>Female</td>
                  <td>0923 232 7756</td>
                </tr>
                <tr>
                  <td>01/17/23</td>
                  <td>Jessica Malinao</td>
                  <td>malinaojessica@gmail.com</td>
                  <td>Female</td>
                  <td>0902 434 7901</td>
                </tr> -->
              </tbody>
            </table>
          </div>
      </section>

      <!-- ADDRESS! -->
      <section class="address">
        <div class="address-analytics">
          <div class="addresses">
            <h1><i class="fa-solid fa-map-location-dot"></i> Address</h1>
          </div>
          <div class="address-tab">
            <div class="address-box">
              <h2>Statistic Presentation of Users in every Municipality</h2>
              <?php
$sql = "SELECT COUNT(user_id) AS userCount FROM user INNER JOIN barangay ON user.address=barangay.barangay_code INNER JOIN municipality ON municipality.municipality_code=barangay.municipality_code WHERE municipality.municipality_name = :municipality";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

$stmt->execute([':municipality' => "Buenavista"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
              <span style="display:none" id="buenavista"><?php echo $count["userCount"]; ?></span>
              <?php
$stmt->execute([':municipality' => "Gasan"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
              <span style="display:none" id="gasan"><?php echo $count["userCount"]; ?></span>
              <?php
$stmt->execute([':municipality' => "Boac"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
              <span style="display:none" id="boac"><?php echo $count["userCount"]; ?></span>
              <?php
$stmt->execute([':municipality' => "Mogpog"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
              <span style="display:none" id="mogpog"><?php echo $count["userCount"]; ?></span>
              <?php
$stmt->execute([':municipality' => "Sta Cruz"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
              <span style="display:none" id="staCruz"><?php echo $count["userCount"]; ?></span>
              <?php
$stmt->execute([':municipality' => "Torrijos"]);
$count = $stmt->fetch(PDO::FETCH_ASSOC);
?>
              <span style="display:none" id="torrijos"><?php echo $count["userCount"]; ?></span>
              <canvas id="myAddress"></canvas>
            </div>
          </div>
        </div>
        </div>
      </section>

    </aside>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

  <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myAddress = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['1 Month', '5 Months', '1 Year', '2years'],
        datasets: [{
          label: 'Total',
          data: [12, 19, 73, 60],
          backgroundColor: [
            'rgba(255, 99, 132)',
            'rgba(54, 162, 235)',
            'rgba(32, 66, 106)',
            'rgba(255, 206, 86)',
          ],
          hoverOffset: 4
        }]
      },
      options: {
        responsive: false,
      }
    });
  </script>
  <script>
    let buenavista = document.getElementById('buenavista').innerHTML;
    let gasan = document.getElementById('gasan').innerHTML;
    let boac = document.getElementById('boac').innerHTML;
    let mogpog = document.getElementById('mogpog').innerHTML;
    let staCruz = document.getElementById('staCruz').innerHTML;
    let torrijos = document.getElementById('torrijos').innerHTML;

    var ctx = document.getElementById('myAddress').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Buenavista', 'Gasan', 'Boac', 'Mogpog', 'Sta.Cruz', 'Torrijos'],
        datasets: [{
          label: 'Total',
          data: [buenavista, gasan, boac, mogpog, staCruz, torrijos],
          backgroundColor: [
            'rgba(255, 99, 132)',
            'rgba(54, 162, 235)',
            'rgba(32, 66, 106)',
            'rgba(255, 206, 86)',
            'rgba(25, 106, 46)',
            'rgba(19, 123, 96)',
          ],
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
      }
    });
  </script>
  <script>
    function openMyAccount(evt, accountTab) {
      var i, tabcontent, tablinks;

      tabcontent = document.getElementsByClassName("myaccount-tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      tablinks = document.getElementsByClassName("myaccount-tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      document.getElementById(accountTab).style.display = "block";
      evt.currentTarget.className += " active";
    }

    document.getElementById("defaultOpen").click();

    var nav_dropdown = document.getElementsByClassName("sample");
    var i;

    for (i = 0; i < nav_dropdown.length; i++) {
      nav_dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        dropdownContent.style.marginLeft = "30px"
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
  </script>
</body>

</html>