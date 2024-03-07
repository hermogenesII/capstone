<?php
session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';

// $id = $_GET["userid"];
$sql = "SELECT feedback.*, CONCAT(user.fname, ' ', user.mname, ' ', user.lname ) AS providerName, images.image_filename FROM user
INNER JOIN user ON user.user_id=feedback.provider_id
            LEFT JOIN images ON images.user_id=feedback.provider_id
WHERE feedback.provider_id = '$userid';";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();

$feedback = "";

if ($stmt->rowCount() == 0) {
    $feedback .= "No Subscription Request";
} else {
    while ($feedback = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // $chatName = $chat['image_filename'] == null ? "default.png" : $chat['image_filename'];
        $feedback .= '    <div class="rating-and-reviews">
                          <div class="rating-and-reviews-info">
                            <img src="me.png">
                            <div class="name-and-date">
                              <h4>Euduchael Andrade</h4>
                              <p>June 13, 2022</p>
                            </div>
                          </div>
                          <div class="rating-and-comments">
                            <h4>Rate:
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                            </h4>
                            <div class="comments">
                              <p>Wala naman problema sa performance sa size lang medyo maliit<br>
                                An obscure term referring to a lung disease cause by a <br>
                                silica dust.</p>

                            </div>
                          </div>
                          <div class="gallery"><img src="me.png">
                          </div>
                      </div>
                        <hr>
                          ';
    }

}
echo $feedback;
