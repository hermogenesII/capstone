<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/subscription.css">
  <link rel="stylesheet" href="../css/account-sidebar.css">
  <title>Subscription</title>
</head>
<body>
<?php
include '../account-sidebar.php';
?>
<section class="myaccount-tabcontent" id="my-subscription">
  <div class="subscription">
    <form id="subscription" action="/../OOP/php/subscription.php" method="post" enctype="multipart/form-data">
      <div class="subscription-page">
        <h1><i class="fa-sharp fa-solid fa-receipt"></i> Subscription</h1>
        <p>Premium has even more features to help you keep calm and organize.</p>
        <hr>
        <div class="payment-list">
          <div class="subs-list">
            <h2>1 Month</h2>
            <img src="../1.png" alt="picture">
            <p>
              For 30 days, you will have full access to the website's features.
            </p>
            <div class="amount">
              <p>₱ 100.00</p>
            </div>
            <p>Gcahs/Paymaya</p>
            <input type="radio" name="duration" value="Monthly" onclick="nextPrev(1)"  class="spass" readonly/>
          </div>
          <div class="subs-list">
            <h2> 3 Months</h2>
            <img src="../2.png" alt="picture">
            <p>
              For 3 months, you will have full access to the website's features.
            </p>
            <div class="amount">
              <p>₱ 300.00</p>
            </div>
            <p>Gcahs/Paymaya</p>
            <input type="radio" name="duration" value="Quarterly" onclick="nextPrev(1)"   class="spass" readonly/>
          </div>
          <div class="subs-list">
            <h2>1 Year</h2>
            <img src="../3.png" alt="picture">
            <p>
              For 12 months, you will have full access to the website's features.
            </p>
            <div class="amount">
              <p>₱ 1,000.00</p>
            </div>
            <p>Gcahs/Paymaya</p>
            <input type="radio" name="duration" value="Annually" onclick="nextPrev(1)"   class="spass" readonly/>
          </div>
        </div>

      </div>
      <div class="subscription-page">
          <h1><i class="fa-solid fa-credit-card"></i> Proof of Payment</h1>
          <p>Use this page to send valid proof of your
            subscription payment. <br>The admin will review and
            process your receipt and reference number as
            soon as possible.
          </p>
        <hr>
        <div class="proof-container-form">
            <img src="../reee.png" alt="image to be insert!!">
            <div class="trylang">
              <div class="list-payment">
                <div class="number">
                <h3><i class="fa-solid fa-circle-info"></i> Transaction Details</h3>
                <img src="../rer.png" alt="image to be insert!!">
                <p>Send your payment here:</p>
                <h5><i class="fa-solid fa-sack-dollar"></i> Gcash : 0912 345 6789</h5>
                <h5><i class="fa-solid fa-leaf"></i> Paymaya : 0912 345 6789</h5>
                <h5><i class="fa-brands fa-paypal"></i> Paypal : 0912 345 6789</h5>
                <h5><i class="fa-solid fa-coins"></i> Coins PH : 0912 345 6789</h5>
                </div>
              </div>
              <div class="reference">
                <p>Enter reference number:</p>
                <input type="text" name="referenceNum" placeholder="Reference Number...">

                <input type="file" name="referenceImg" id="referenceImg" accept=".jpg, jpeg, .png">
                <p>Please upload your receipt here.</p>
              </div class>
              <div class="botpay">
                <input type="button" value="Submit" onclick="nextPrev(1)"   class="back">
                <input type="button" value="Back" onclick="nextPrev(-1)"  class="back">
              </div>
            </div>
        </div>
      </div>
    </form>
  </div>

</section>

<script>
      var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
      var x = document.getElementsByClassName("subscription-page");

      x[n].style.display = "block";
      // if (n == 0) {
      //   document.getElementsByClassName("back").style.display = "none";
      // } else {
      //   document.getElementsByClassName("back").style.display = "inline";
      // }

      if (n == x.length - 1) {
        document.getElementsByClassName("spass").innerHTML = "Submit";
      } else {
        document.getElementsByClassName("spass").innerHTML = "Apply";
      }
    }

    function nextPrev(n) {
      var x = document.getElementsByClassName("subscription-page");
      x[currentTab].style.display = "none";
      currentTab = currentTab + n;
      if (currentTab >= x.length) {
        document.getElementById("subscription").submit();
        return false;
      }
      showTab(currentTab);
    }
</script>

</body>
</html>
