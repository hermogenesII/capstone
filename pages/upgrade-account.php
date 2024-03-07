<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <link rel="stylesheet" href="../css/upgrade-account.css" />
  <script src="/../OOP/js/category.js"></script>


  <title>Upgrade Account</title>
</head>

<body style="background-image: linear-gradient(rgba(80, 113, 190, 0.918), rgba(234, 170, 80, 0.466), rgba(76, 128, 201, 0.675)), url('../images/background/upgrade-account-background.jpg'); ">

  <div class="upgrade-account-container">
    <div class="upgrade-account">
      <h1><i class="fa-solid fa-cloud-arrow-up"></i> Upgrade Account</h1>

      <form action="../php/upgradeAccount_function.php" method="POST">
        <select name="category" id="category" onclick="csload(1); this.onclick=null;">
          <option value="" hidden>Category</option>
        </select>

        <select name="specific-service" id="specific-service" onclick="csload(2); this.onclick=null;">
          <option value="" hidden>Specific-Service</option>
        </select>

        <textarea name="upgrade-account-description" id="upgrade-account-description" placeholder="Description:"></textarea>

        <input type="submit" value="Promote Service" />
      </form>
    </div>
  </div>

  <!-- <script>

    let accountUpgrade = {
      "Utility": ["Electrician", "Tubero"],
      "Electronic Device": ["Smart Phone", "Laptop", "Smart TV"],
      "Mechanic": ["Four Wheels", "Two Wheels"]
    }

    window.onload = function() {
      let category = document.getElementById("category");
      let subCategory = document.getElementById("specific-service");

      for (var x in accountUpgrade) {
        category.options[category.options.length] = new Option(x);
      }

      category.onchange = function() {
        subCategory.length = 1;

        var y = accountUpgrade[this.value];
        for (var z in accountUpgrade[this.value]) {
          subCategory.options[subCategory.options.length] = new Option(y[z]);
        }
      }
    }

  </script> -->

</body>

</html>
