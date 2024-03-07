<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <link rel="stylesheet" href="./css/categories.css" />
  <link rel="stylesheet" href="./css/sidebar.css" />

  <title>Categories</title>
</head>
</body>
<?php
include '../admin/sidebar.php';
?>
<section class="myaccount-tabcontent" id="categories">
  <h1><i class="fa-sharp fa-solid fa-list"></i> Categories</h1>
  <p class="paragraph">The administrator has the privilege to add, delete and edit other admin members.
  </p>
  <hr>
  <div class="proof-container">
    <?php
include "/../xampp/htdocs/OOP/config/db_conn.php";
$sql = "SELECT * FROM category";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $category_id = $category["Category_id"];?>
      <div class="category-border">
        <div class="category">
          <img src="/../OOP/images/background/<?php echo $category["Category_Img"]; ?>">
          <div class="layer">
          <form action="/../OOP/admin/php/addSubCategories.php" method="post">
            <h3 style="text-transform: uppercase;"><?php echo $category["Category"]; ?></h3>
            <label class="label-viewBtn" for="viewSub<?php echo $category["Category_id"]; ?>"><i class="fa-solid fa-check" aria-hidden="true"></i> View Sub-Categories</label>
            <input type="checkbox" class="viewSub" id="viewSub<?php echo $category["Category_id"]; ?>">
            <div class="viewSub-container">
              <div class="accept-prompt">
                <h2>Sub Categories</h2>
                <div class="addContainer">
                  <ol>
                  <?php
$sql2 = "SELECT * FROM subcategory WHERE Category_id = '$category_id' ";
    $stmt2 = $conn->prepare($sql2, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt2->execute();
    while ($subcategory = $stmt2->fetch(PDO::FETCH_ASSOC)) {?>
                    <li>
                      <p><?php echo $subcategory["Subcategory"]; ?></p> <label class="label-editBtn" for="editBtn"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Edit</label>
                      <input type="checkbox" class="editBtn" id="editBtn">
                      <label class="label-deleteBtn" for="deleteBtn"><i class="fa-solid fa-trash" aria-hidden="true"></i> Delete</label>
                      <input type="checkbox" class="deleteBtn" id="deleteBtn">
                    </li>
                    <!-- <li>
                      <p>Electrician</p> <label class="label-editBtn" for="editBtn"><i class="fa-solid fa-check" aria-hidden="true"></i>Edit</label>
                      <input type="checkbox" class="editBtn" id="editBtn">
                      <label class="label-deleteBtn" for="deleteBtn"><i class="fa-solid fa-check" aria-hidden="true"></i> Delete</label>
                      <input type="checkbox" class="deleteBtn" id="deleteBtn">
                    </li> -->
                    <?php }?>
                  </ol>
                  <label class="label-addSub" for="addSub<?php echo $category["Category_id"]; ?>"> Add</label>
                  <input type="checkbox" class="addSub" id="addSub<?php echo $category["Category_id"]; ?>">
                  <div class="addSub-container">
                    <div class="accept-prompt">
                      <h2>Add Categories</h2>
                      <div class="addContainer">
                        <input type="hidden" name="Category_id" value="<?php echo $category["Category_id"]; ?>">
                        <input type="text" name="subCategoryName" id="subCategoryName">
                        <label for="subCategoryName">Sub Category</label>
                      </div>
                      <button type="submit" name="accept" value="Accept" class="accept">Add</button>
                      <button type="button" id="back3" class="back3">Cancel</button>
                    </div>
                  </div>
                </div>
                <button type="button" id="back1" class="back1">Close</button>
              </div>
            </div>
            </form>
          </div>
        </div>
        <div class="category-description">
          <h4 style="text-transform: uppercase;"><?php echo $category["Category"]; ?></h4>
          <p><?php echo $category["Category_Description"]; ?>
        </div>
      </div>
    <?php }?>
  </div>
  <div class="but">
    <!-- <button>Add</button -->
    <form action="/../OOP/admin/php/addCategories.php" method="post" enctype="multipart/form-data">
      <!-- Add Categories -->
      <label for="addBtn"> Add</label>
      <input type="checkbox" class="addBtn" id="addBtn">
      <div class="accept-container">
        <div class="accept-prompt">
          <h2>Add Categories</h2>
          <div class="addContainer">
            <i class="fa-solid fa-plus fa-3x"></i>
            <input type="file" name="categoryImg" id="fileInput" accept=".jpg, jpeg, .png" required>
            <label for="fileInput">Category Image</label>
            <input type="text" name="categoryName" id="categoryName">
            <label for="categoryName">Category Title</label>
            <textarea name="categoryDescription" id="categoryDescription" placeholder="Description..." cols="30" rows="10" required></textarea>
            <!-- <input type="text" name="categoryDescription" id="categoryDescription" placeholder="Description"> -->
            <br><button type="button" id="back2" class="back">Cancel</button>
          <button type="submit" name="accept" value="Accept" class="accept">OK</button>
    </div>
        </div>
      </div>
    </form>

  </div>
</section>

<script>
  const addBtn = document.querySelector('.addBtn');
  const parent = document.querySelector('#categories');
  let viewSubContainer = document.querySelectorAll('.viewSub-container');
  let viewSub = document.querySelectorAll('.viewSub');
  let addSubContainer = document.querySelectorAll('.addSub-container');
  let addSub = document.querySelectorAll('.addSub');

  addBtn.addEventListener('change', function() {
    if (this.checked) {
      parent.style.pointerEvents = 'none';
    } else {
      parent.style.pointerEvents = 'auto';
    }
  });

  viewSub.forEach(function(button, index) {
  button.addEventListener('click', function() {
    viewSubContainer[index].style.visibility = 'visible';
    // Show the decline container div
  });
});

addSub.forEach(function(button, index) {
  button.addEventListener('click', function() {
    addSubContainer[index].style.visibility = 'visible';
    // Show the decline container div
  });
});

  // const checkbox = document.querySelector('#checkbox');
  // const button1 = document.querySelector('#back1');
  let button1 = document.querySelectorAll('.back1');
  const button2 = document.querySelector('#back2');
  let button3 = document.querySelectorAll('.back3');

  // button1.addEventListener('click', function() {
  //     declineBtn.checked = false;
  //     // declineBtn.removeAttribute('checked');
  //     parent.style.pointerEvents = 'auto';
  // });

    button1.forEach(function(button, index) {
  button.addEventListener('click', function() {
    viewSubContainer[index].style.visibility = 'hidden';
    // Show the decline container div
  });
});

  button2.addEventListener('click', function() {
    addBtn.checked = false;
    // acceptBtn.removeAttribute('checked');
    parent.style.pointerEvents = 'auto';
  });

  button3.forEach(function(button, index) {
  button.addEventListener('click', function() {
    addSubContainer[index].style.visibility = 'hidden';
    // Show the decline container div
  });
});


  $(function() {
    // Bind a click event to the icon element
    $('i.fa-plus').click(function() {
      $('#fileInput').trigger('click');
    });

    // Detect when a file has been selected in the file input
    $('#fileInput').change(function() {
      // Get the selected file
      var file = this.files[0];

      // Check if the file is an image
      if (!file.type.startsWith('image/')) {
        // Not an image, do something else
        return;
      }

      // Create a new FileReader object
      var reader = new FileReader();

      // Set the onload event handler
      reader.onload = function(e) {
        // Get the data URL
        var dataURL = e.target.result;

        // Create an image element and set its src to the data URL
        var image = $('<img id="categoryImg">').attr('src', dataURL);

        // Replace the icon element with the image element
        image.insertBefore('i.fa-plus');
        $('i.fa-plus').remove();

        // Bind a click event to the image element
        bindClickEventToImage();
      };

      // Read the image file as a data URL
      reader.readAsDataURL(file);
    });

    function bindClickEventToImage() {
      $('#categoryImg').click(function() {
        $('#fileInput').trigger('click');
      });
    }
  });
</script>

</html>