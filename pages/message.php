<?php

session_start();
include '/../xampp/htdocs/OOP/config/db_conn.php';
if (isset($_SESSION['user_id'])) {

    if (isset($_GET['userid'])) {
        $userid = $_GET['userid'];
    } else {
        $id = $_SESSION["user_id"];
        $sql = "SELECT receiver_id,sender_id FROM message WHERE sender_id='$id' or receiver_id = '$id'
  ORDER BY `message`.`message_id`  DESC";
        $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['sender_id'] === $id) {
                $userid = $row['receiver_id'];
            } else {
                $userid = $row['sender_id'];
            }
        }
    }
} else {
    header("Location: /../OOP/pages/alert.php");
}
// echo $userid;
// echo $_SESSION['user_id'];
// $sql = "SELECT user.*, images.* FROM user LEFT JOIN images ON user.user_id=images.user_id WHERE user.user_id = '$userid'";
// $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
// $stmt->execute();
// $chat = $stmt->fetch(PDO::FETCH_ASSOC);
// $chatName = $chat['image_filename'] == null ? "default.png" : $chat['image_filename'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Message</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <link rel="stylesheet" href="/../OOP/css/message.css">
  <link rel="stylesheet" href="/../OOP/css/include//header.css">

</head>

<body>

  <!-- <header id="header" role="banner">
    <div class="header_middle_section">
      <h1>Chat</h1>
    </div>
    <div class="header_right_section">
      <div class="navigation">
        <ul>
          <li>
            <a href="/../OOP/index.php"> <i class="fa-solid fa-square-caret-down"> </i> HOME</a>
          </li>
          <li>
            <a href="#"><i class="fa-solid fa-map"></i> Map</a>
          </li>
          <li>
            <a href="/../OOP/pages/provider-page.php"><i class="fa-solid fa-circle-info"></i> Service Provider
            </a>
          </li>
        </ul>
      </div>
      <div class="profile">
        <?php if (isset($_SESSION["user_id"])) {?>
          <a href="/../OOP/practice/user-account/includes/account.php">
            <?php echo $_SESSION["username"]; ?>
          </a>
          <?php
$user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM images WHERE user_id = '$user_id' AND image_type = 'profile'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() == 0) {?>
            <a href="/../OOP/practice/user-account/includes/account.php"><img src='/../OOP/images/photo/default.png' /></a>
          <?php
} else {?>
            <a href="/../OOP/practice/user-account/includes/account.php"><img src="/../OOP/images/photo/<?php echo $row['image_filename']; ?>" /></a>
          <?php }
} else {?>
          <a href="/../OOP/pages/login.php">Login/Register</a>
        <?php }?>

      </div>

      <i id="menu-btn" class="fa-solid fa-bars"></i>
    </div>

  </header> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


  <header id="header" role="banner">
    <div class="header_middle_section">
      <!-- <i id="search-btn" class="fa fa-magnifying-glass"></i>
    <div class="search-bar">
      <form action="" method="get" id="search-form">
        <div class="input-div">
          <input id="search" type="text" name="search" class="search_area" placeholder="Search..." />
        </div>
        <div id="result-div" style="display: none;">
          <ul id="live-result">
            <li><a href="#"></a></li>
          </ul>
        </div>
      </form>
    </div> -->
    </div>
    <div class="header_right_section">
      <div class="navigation">
        <ul>
          <li>
            <a href="/../OOP/index.php">
              <button class="drop-down-categories-btn">
                <i class="fa-solid fa-home"> </i> Home
              </button>
            </a>
          </li>
          <li>
            <a href="/../OOP/pages/provider-page.php"><i class="fa-solid fa-map"></i> Services</a>
          </li>
        </ul>
      </div>
      <div class="profile">
        <?php if (isset($_SESSION["user_id"])) {?>
          <!-- <a href="/../OOP/pages/message.php"><i class="fa-solid fa-message"></i> My Message
        </a> -->
          <nav class="notification-bell">
            <ul>
              <li>
                <a href="#" id="notif-count"><label for="check"><i class="fa-solid fa-bell" aria-hidden="true"></i>
                  </label>
                  <p id="notifCount"></p>
                </a>
                <input type="checkbox" class="dropdown-check" id="check">
                <ul class="class-dropdown" id="notifList">
                  <li>
                    <img src="#">
                    <h2 class="hire"><i class="fa-solid fa-hand-dots"></i></h2>
                    <p>Hermogenes Magsino Send you an application request.</p>
                  </li>
                  <li>
                    <img src="#">
                    <h2 class="sent"><i class="fa-solid fa-paper-plane"></i></h2>
                    <p>Eudichael Jardeleza Sent you a message.</p>
                  </li>
                  <li>
                    <img src="#">
                    <h2 class="cancel"><i class="fa-solid fa-ban"></i></h2>
                    <p>Erwin Andrade cancel his/her Request.</p>
                  </li>
                  <li>
                    <img src="#">
                    <h2 class="rate"><i class="fa-solid fa-star"></i></h2>
                    <p>Eudichael Jardeleza Rate on your Profile.</p>
                  </li>
                  <li>
                    <img src="#">
                    <h2 class="comment"><i class="fa-solid fa-comment"></i></h2>
                    <p>Eudichael Jardeleza Commented on your profile.</p>
                  </li>
                  <li>
                    <img src="#">
                    <h2 class="accept"><i class="fa-regular fa-square-check"></i></h2>
                    <p>Erwin Andrade Accept your application request.</p>
                  </li>
                  <li>
                    <img src="#">
                    <h2 class="accept"><i class="fa-regular fa-square-check"></i></h2>
                    <p>Erwin Andrade Accept your application request.</p>
                  </li>
                  <li>
                    <img src="#">
                    <h2 class="accept"><i class="fa-regular fa-square-check"></i></h2>
                    <p>Erwin Andrade Accept your application request.</p>
                  </li>
                  <li>
                    <img src="#">
                    <h2 class="update"><i class="fa-regular fa-pen-to-square"></i></h2>
                    <p>Erwin Andrade update your service status.</p>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
          <a href="/../OOP/practice/user-account/includes/account.php">
            <?php echo $_SESSION["username"]; ?>
          </a>
          <?php
$id = $_SESSION["user_id"];
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM images WHERE user_id = '$user_id' AND image_type  = 'profile'";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() == 0) {?>
            <a href="/../OOP/practice/user-account/includes/account.php"><img src='/../OOP/images/photo/default.png' /></a>
          <?php
} else {?>
            <a href="/../OOP/practice/user-account/includes/account.php"><img src="/../OOP/images/photo/<?php echo $row['image_filename']; ?>" /></a>
          <?php }?>
          <!-- <a href="/../OOP/practice/user-account/user-account.php\"><img src="/../OOP/images/photo/profile.png" /></a> -->
        <?php } else {?>
          <a href="/../OOP/pages/login.php"><i class="fa-solid fa-right-to-bracket"></i> Login/Register</a>
        <?php }?>

      </div>

      <i id="menu-btn" class="fa-solid fa-bars"></i>
    </div>
  </header>


  <section class="my-message" id="my-message">
    <!-- <form class="search"><input type="text"><button type="submit"><i class="fa-solid fa-search"></i></button></form> -->
    <div class="my-message-container">
      <div class="chatlist-container">
        <h2><i class="fa-sharp fa-solid fa-comments"></i> Chat list</h2>
        <!-- <p><i class="fa-sharp fa-solid fa-circle-dot"></i> Chat list</p> -->
        <ul>
          <li id="chatList">

          </li>
        </ul>
      </div>
      <div class="message-container">
        <?php
$sql = "SELECT receiver_id,sender_id FROM message WHERE sender_id='$id' or receiver_id = '$id'
         ORDER BY `message`.`message_id`  DESC";
$stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
if (isset($_GET['userid']) or ($stmt->rowCount() > 0)) {
    ?>

          <div class="chat-upper">
            <!-- Profile pic at name -->
          </div>
          <div class="chat-container">
            <div class="chat-box">
              <!-- Dito yung mga chats -->
            </div>
          </div>
          <form action="" class="typing_area" method="post">
            <div class="bot-area">
              <input type="text" name="outgoing_id" value="<?php echo $_SESSION["user_id"] ?>" hidden>
              <input type="text" name="incoming_id" value="<?php echo $userid ?>" hidden>
              <input type="text" name="message" class="input" placeholder="Message..." autocomplete="off"/>
              <button><i class="fa-solid fa-paper-plane"></i></button>
            </div>
          </form>
        <?php } else {?>
          <div class="chat-upper1">
            <!-- Profile pic at name -->
            <p></p>
          </div>
          <div class="chat-container1">
            <div class="chat-box1">
              <!-- Dito yung mga chats -->
              <p style="padding:185px 0; text-align:center"> Start a conversation </p>
            </div>
          </div>
          <form action="" class="typing_area1" method="post">
            <div class="bot-area1">
            </div>
          </form>
        <?php }?>

      </div>
    </div>
  </section>
  <?php
if ($stmt->rowCount() > 0 or isset($_GET['userid'])) {?>

    <script src="/../OOP/js/chatbox.js"></script>
  <?php }?>
  <script src="/../OOP/js/chat.js"></script>


  <!-- chat iteration para mapunta sa una yung chat -->

  <!-- <script>
    let chats = [];

// Add a new chat to the beginning of the list
function addChat(chat) {
  chats.unshift(chat);
}


    let chatList = document.querySelector('.person');

// Iterate over the array of chats and create a list element for each chat
for (let i = 0; i < chats.length; i++) {
  let chat = chats[i];
  let chatElement = document.createElement('li');
  chatElement.innerText = chat;
  chatList.appendChild(chatElement);
}
  </script> -->

</body>

</html>