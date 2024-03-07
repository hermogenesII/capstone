<?php
// session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
$userid = $_GET['userid'];
$sql = "SELECT user_provider.*, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, subcategory.Subcategory, images.image_filename FROM user_provider INNER JOIN user ON user.user_id=user_provider.user_id INNER JOIN subcategory ON Subcategory.Subcategory_id=user_provider.Subcategory_id LEFT JOIN images ON user.user_id=images.user_id WHERE user_provider.user_id = '$userid'";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$provider = $stmt->fetch(PDO::FETCH_ASSOC);
$profile = $provider["image_filename"] == null ? "default.png" : $provider["image_filename"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />

    <link rel="stylesheet" href="/../OOP/css/review.css" />

    <title>Review and Ratings</title>
  </head>
  <body>
    <form action="/../OOP/php/insert_feedback.php" method="POST" enctype="multipart/form-data" id="review-form">
      <section id="review">
        <div class="header">
          <h1>Rating and Reviews</h1>
        </div>
        <div class="review-container">
          <div class="profile">
            <img src="/../OOP/images/photo/<?php echo $profile; ?>" alt="profile" />
            <p><?php echo $provider["providerName"] ?></p>
          </div>
          <div class="star-review">
            <input type="radio" name="rate" id="star-5" value="1"/>
            <label for="star-5" class="star">&#9734</label>
            <input type="radio" name="rate" id="star-4" value="2"/>
            <label for="star-4" class="star">&#9734</label>
            <input type="radio" name="rate" id="star-3" value="3"/>
            <label for="star-3" class="star">&#9734</label>
            <input type="radio" name="rate" id="star-2" value="4"/>
            <label for="star-2" class="star">&#9734</label>
            <input type="radio" name="rate" id="star-1" value="5" />
            <label for="star-1" class="star">&#9734</label>
            <p class="current_rating">0 of 5</p>
          </div>
          <div class="description">
            <textarea name="review" id="review-text"></textarea>
            <input type="file" name="reviewImg" accept=".jpg, jpeg, .png">
          </div>
          <div class="buttons">
            <input type="hidden" name="userID" value="<?php echo $userid; ?>">
            <input type="submit" name="submit" value="Submit" class="sbmt-btn" />
            <input type="button" onclick="history.back()" value="Back" class="sbmt-btn" />
          </div>
        </div>
      </section>
    </form>
    <script>
        const allStar = document.querySelectorAll('.star');
        const currentRating= document.querySelector('.current_rating');
        allStar.forEach((star, i) => {
            star.onclick = function() {
                let current_star_level = i + 1;
                currentRating.innerHTML = `${current_star_level} of 5`;
                console.log(current_star_level);
                allStar.forEach((star, j) => {
                    if (current_star_level >= j+1) {
                        star.innerHTML = '&#9733';
                    } else {
                        star.innerHTML = '&#9734';
                    }
                })
            }
        })
    </script>
  </body>
</html>
