<?php session_start()?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <link rel="stylesheet" href="../css/registration/registration.css">

  <script src="../js/address.js"></script>

  <title>Registration</title>
</head>

<body style="
      background-image: linear-gradient(
          rgba(234, 237, 244, 0.381),
          rgba(232, 180, 106, 0.551),
          rgba(76, 128, 201, 0.6)
        ),
        url('../images/background/login-background.jpg');
    ">
  <div class="registration-form">
    <h1><i class="fa-solid fa-users-between-lines"></i> Registration Form</h1>
    <form id="registration-form" action="../php/include/registration.inc.php" method="post" enctype="multipart/form-data">
      <section class="registration">
        <?php
if (isset($_SESSION['error'])) {?>
          <p class="error"><?php echo $_SESSION['error'];
    unset($_SESSION["error"]);
    ?></p>
        <?php }?>
        <ul>
          <li class="first">
            <p><i class="fa-solid fa-user"></i> First Name:</p>
            <input type="text" name="firstname" value="<?php echo $username = isset($_SESSION['fname']) ? htmlentities($_SESSION['fname']) : "";
unset($_SESSION["fname"]); ?>" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : "*Juan"; ?>"required/>
          </li>
          <li class="middle">
            <p><i class="fa-solid fa-user"></i> Middle Name:(Optional)</p>
            <input type="text" name="middlename" value="<?php echo $username = isset($_SESSION['mname']) ? htmlentities($_SESSION['mname']) : "";
unset($_SESSION["mname"]); ?>" placeholder="*Manuel" />
          </li>
          <li class="last">
            <p><i class="fa-solid fa-user"></i> Last Name:</p>
            <input type="text" name="lastname" value="<?php echo $username = isset($_SESSION['lname']) ? htmlentities($_SESSION['lname']) : "";
unset($_SESSION["lname"]); ?>" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : "*Marquez"; ?>" required/>
          </li>
          <li class="dob">
            <p><i class="fa-solid fa-calendar-days"></i> Date of Birth:</p>
            <input type="date" name="dateob" id="dateob" value="<?php echo $username = isset($_SESSION['dob']) ? htmlentities($_SESSION['dob']) : "";
unset($_SESSION["dob"]); ?>" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : ""; ?>" required/>
          </li>
          <li class="contactno">
            <p><i class="fa-solid fa-phone"></i> Contact No.:</p>
            <input type="text" name="contact" id="contact" value="<?php echo $username = isset($_SESSION['contact']) ? htmlentities($_SESSION['contact']) : "";
unset($_SESSION["contact"]); ?>" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : ""; ?>"required/>
            <div id="note"></div>
          </li>
          <li class="gender">
            <p><i class="fa-solid fa-venus-mars"></i> Gender:</p>
            <select id="Gender" name="gender">
              <option value="" hidden>Choose gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="None">Prefer not to say</option>
            </select>
          </li>
        </ul>
        <div class="address">
          <p><i class="fa-solid fa-location-dot"></i> Address:</p>
          <div class="address-list">
            <select name="country" id="country">
              <!-- <select name="country" id="country"> -->

                <!-- <option value="Philippines" selected>Philippines</option> -->
              </select>
              <select name="province" id="province" >
                <!-- <select name="province" id="province"> -->
                  <!-- <option value="Marinduque" selected>Marinduque</option> -->
                </select>
                <select name="municipality" id="municipality" onclick="csload(3); this.onclick=null;">
                  <option value="" hidden>Municipality</option>
                </select>
                <select name="barangay" id="barangay" onclick="csload(4); this.onclick=null;">
                  <option value="" hidden>Barangay</option>
                </select>
          </div>
        </div>
        <div class="low-container">
          <div class="log-in">
            Already Have an Account? <a href="./login.php"><u>Login</u></a>
          </div>
          <div class="buttonn2">
            <button type="button" id="nextBtn" onclick="nextPrev(1)" class="registerbutton2">
              Next
            </button>
          </div>
        </div>
      </section>

      <section class="registration" id="registration">
        <div class="next-page">
          <div class="title-img">
            <img src="../images/background/registration.png" alt="" />
          </div>
          <div class="reg-form">
            <div class="user">
              <p><i class="fa-solid fa-user"></i> User Name:</p>
              <input type="text" name="username" value="<?php echo $username = isset($_SESSION['username']) ? htmlentities($_SESSION['username']) : "";
unset($_SESSION["username"]); ?>" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : ""; ?>" />
            </div>
            <div class="email">
              <p><i class="fa-solid fa-envelope"></i> Email Address:</p>
              <input type="text" name="email" value="<?php echo $username = isset($_SESSION['email']) ? htmlentities($_SESSION['email']) : "";
unset($_SESSION["email"]); ?>" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : ""; ?>" />
            </div>
            <div class="note" id="msg">
              <!-- <p>Password must contain atleast 8 Characters with one uppercase, number, and special character.</p> -->
            </div>
            <div class="passwordd">
              <p><i class="fa-solid fa-key"></i> Password:</p>
              <div>
                <input type="password" id="password" name="password" value="" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : ""; ?>" />
                <i class="fa-solid fa-eye"></i>
              </div>
            </div>
            <div class="note" id="cmsg">
            </div>
            <div class="confirm">
              <p><i class="fa-solid fa-key"></i> Confirm Password :</p>
              <div>
                <input type="password" id="cpassword" name="confirm-password" value="" placeholder="<?php echo $require = isset($_SESSION['require']) ? htmlentities($_SESSION['require']) : "";
unset($_SESSION['require']); ?>" />
                <i class="fa-solid fa-eye"></i>
              </div>
            </div>
            <div class="id">
              <p><i class="fa-solid fa-address-card"></i> Valid ID: (Front and Back)</p>
              <input type="file" name="valid-id[]" id="valid-id" accept=".jpg, jpeg, .png" multiple>
            </div>
          </div>

          <li class="check">
            <input type="checkbox" id="checkBox" name="terms" value="1"><a> I Accept the Terms and Conditions</a>
            <div class="terms">
              <div class="accept">
                <h1>Terms and Condition</h1>
                <p> Acceptable use: You must not use our website in
                  any way that causes, or may cause, damage to the
                  website or impairment of the availability or accessibility
                  of the website; or in any way which is unlawful, illegal,
                  fraudulent or harmful, or in connection with any unlawful,
                  illegal, fraudulent or harmful purpose or activity.
                </p>
                <p>By using our Website, you accepted these terms and
                  conditions in full. If you disagree with these terms
                  and conditions or any part of these terms and conditions,
                  you must not use our Website.</p>

                <label><input type="radio" id="agree" name="agree" value="agree"> I Agree</label><br>
                <!-- <label><input type="radio" id="disagree" name="disagree" value="disagree"> I Disagree</label><br> -->
                <input type="button" class="submit" id="submitBtn" value="OK"></input>
              </div>
            </div>
          </li>
          <div class="logins">
            Already Have an Account? <a href="./login.php"><u>Login</u></a>
          </div>
          <div class="buttonn3">
            <button type="button" onclick="nextPrev(-1)" class="registerbutton2">
              Back
            </button>
            <button type="button" id="prevBtn" onclick="nextPrev(1)" class="registerbutton2" disabled>
              Register
            </button>
          </div>
        </div>
      </section>
    </form>
  </div>


  <script>
    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
      var x = document.getElementsByClassName("registration");

      x[n].style.display = "block";
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }

      if (n == x.length - 1) {
        document.getElementById("nextBtn").innerHTML = "Register";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
    }

    function nextPrev(n) {
      var x = document.getElementsByClassName("registration");
      x[currentTab].style.display = "none";
      currentTab = currentTab + n;
      if (currentTab >= x.length) {
        document.getElementById("registration-form").submit();
        return false;
      }
      showTab(currentTab);
    }

    pswrdField1 = document.querySelector(".passwordd input[type='password']"),
      pswrdField2 = document.querySelector(".confirm input[type='password']"),
      toggleBtn1 = document.querySelector(".passwordd .fa-eye"),
      toggleBtn2 = document.querySelector(".confirm .fa-eye");

    toggleBtn1.onclick = () => {
      if (pswrdField1.type == "password") {
        pswrdField1.type = "text";
      } else {
        pswrdField1.type = "password";
      }
    }

    toggleBtn2.onclick = () => {
      if (pswrdField2.type == "password") {
        pswrdField2.type = "text";
      } else {
        pswrdField2.type = "password";
      }
    }

    dateob.max = new Date().toISOString().split("T")[0];


    // Terms and Condition
    const checkbox = document.querySelector('#checkBox');
    const div1 = document.querySelector('.accept');

    if (!checkbox.checked) {
      div1.style.display = 'none';
    }

    checkbox.addEventListener('change', (event) => {
      if (event.target.checked) {
        div1.style.display = 'block';
      } else {
        div1.style.display = 'none';
      }
    });

    // TERMS AND CONDITION AGREE AND DISAGRREE

    const agreeBox = document.querySelector('#agree');
    const disagreeBox = document.querySelector('#disagree');
    const submitBtn = document.querySelector('#submitBtn');
    const regBtn = document.querySelector('#prevBtn');
    const hideDiv = document.querySelector('.accept');

    agreeBox.addEventListener('change', function() {
      if (agreeBox.checked) {

        agreeBox.checked = true;

        // checkbox.disabled = true;
      }
    });

    checkbox.addEventListener('change', function() {
      if (checkbox.checked === false) {

        regBtn.style.color = 'red';
        regBtn.disabled = true;
        checkbox.checked = false;

        // checkbox.disabled = true;
      }
    });


    // disagreeBox.addEventListener('change', function() {
    //   if (disagreeBox.checked) {

    //     agreeBox.checked = false;

    // checkbox.disabled = false;
    //   }
    // });

    submitBtn.addEventListener('click', function() {
      hideDiv.style.display = 'none';
      var requireBox = document.getElementById('checkbox');
      if (agreeBox.checked === false) {
        checkbox.checked = false;
        regBtn.style.color = 'red';
        regBtn.disabled = true;
      } else {
        regBtn.disabled = false;
        checkbox.checked = true;
        regBtn.style.color = 'white';
      }
    });



    // password filtering

    const passInput = document.getElementById('password');
    const cpassInput = document.getElementById('cpassword');
    const noteMsg = document.getElementById('msg');

    passInput.addEventListener('input', () => {
      const passVal = passInput.value;
      const cpassVal = cpassInput.value;

      noteMsg.innerHTML = '';

      if (passVal.length < 8) {
        noteMsg.innerHTML += '<p>Password is too short</p>';
        noteMsg.style.color = 'red';
        return;
      }

      // if (passVal !== cpassVal) {
      //   msg.innerHTML += '<p>Password do not match</p>';
      //   return;
      // }

      if (!passVal.match(/[A-Z]/g)) {
        noteMsg.innerHTML += '<p>Use at least one uppercase letter.</p>';
        noteMsg.style.color = 'red';
        return;

      }

      if (!passVal.match(/[0-9]/g)) {
        noteMsg.innerHTML += '<p>User at least one number.</p>';
        noteMsg.style.color = 'red';
        return;

      }

      if (!passVal.match(/[!@#$%^&*?]/g)) {
        noteMsg.innerHTML += '<p>Use at least one special character.</p>';
        noteMsg.style.color = 'red';
        return;

      }

      if (passVal.length >= 8) {
        noteMsg.innerHTML += '<p>Valid Password!</p>';
        return;
      }
    });

    const cnoteMsg = document.getElementById('cmsg');

    cpassInput.addEventListener('input', () => {
      const passVal = passInput.value;
      const cpassVal = cpassInput.value;

      cnoteMsg.innerHTML = '';

      if (cpassVal !== passVal) {
        cnoteMsg.innerHTML = '<p>Password do not match!</p>';
        noteMsg.style.color = 'red';
        return;
      } else {
        cnoteMsg.innerHTML = '<p>Password is match!</p>';
      }
    });


    // Mobile number registration filtering
    const NumInput = document.getElementById('contact');
    const numMsg = document.getElementById('note');

    function isValid(numInput) {
      const numPattern = /^(09|\+639)\d{9}$/;
      return numPattern.test(numInput);
    }

    NumInput.addEventListener('keyup', event => {
      const valid = NumInput.value;
      if (isValid(valid)) {
        numMsg.innerHTML = 'Valid Phone Number';
        numMsg.style.color = 'green';
      } else {
        numMsg.innerHTML = 'Please input Valid Phone Number';
        numMsg.style.color = 'red';
      }
    });
  </script>
</body>

</html>