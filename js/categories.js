let selectMenu = document.getElementById("category");
let locationMenu = document.getElementById("location");
let subCategorySelect = document.getElementById("specific-service");
let heading = document.querySelector(".service-provider-title h3");
let container = document.querySelector(".service-provider-container");

selectMenu.addEventListener("change", function () {
  let categoryName = this.value;
  let locationName = locationMenu.value;
  // if (categoryName) {
  //   subCategorySelect.style.display = "inline";
  // } else {
  //   subCategorySelect.style.display = "none";
  // }
  // heading.innerHTML = this[this.selectedIndex].text;

  let http = new XMLHttpRequest();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      let out = "";
      // alert(response.length);
      if (response.length === 0) {
        out += ` <p class="none" style="font-size:40px; margin-top:20%; width: 500px; color: grey; text-align:center; margin-left:90%;">Unfortunately, there are no service providers in this category as of yet.</p>
        `;
      } else {
        for (let provider of response) {
          chatImg =
            provider.image_filename == null
              ? "default.png"
              : provider.image_filename;
          out += `
        <div class="service-provider">
        <i class="fa-solid fa-bars"></i>
        <i class="fa-solid fa-gear"></i>
        <img class="profile-pic" src="/../OOP/images/photo/${chatImg}" alt="profile-pic" />
        <h4>${provider.fname} ${provider.mname} ${provider.lname}</h4>
        <p><br>${provider.description}<br></p>
        <div class="social-media">
          <br><i class="fa-brands fa-facebook"></i>
          <i class="fa-brands fa-twitter"></i>
          <i class="fa-brands fa-youtube"></i>
        </div>
        <?php if (isset($_SESSION["user_id"])) {?>
          <div class="buttons">
            <a class="follow-btn" href="/../OOP/pages/hire.php?userid=${provider.user_id}"> Hire</a>
            <a class="follow-btn" href="/../OOP/pages/message.php?userid=${provider.user_id}"> Message</a>
          </div>
          <?php }?>
          <div class="profile-bottom">
          <a href="/../OOP/pages/service-provider.php?userid=${provider.user_id}">
            <p>Learn More About My Profile</p>
            <i class="fa-solid fa-arrow-down"></i>
            </a>
          </div>
        </div>
        `;
        }
      }
      container.innerHTML = out;
    }
  };

  http.open("POST", "/../OOP/js/category.php");
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http.send("category=" + categoryName + "&location=" + locationName);
});

locationMenu.addEventListener("change", function () {
  let locationName = this.value;
  let categoryName = selectMenu.value;

  let http = new XMLHttpRequest();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      let out = "";
      // alert(response.length);
      if (response.length === 0) {
        out += ` <p class="none" style="font-size:40px; margin-top:20%; width: 500px; color: grey; text-align:center; margin-left:90%;">Unfortunately, there are no service providers in this category as of yet.</p>
        `;
      } else {
        for (let provider of response) {
          chatImg =
            provider.image_filename == null
              ? "default.png"
              : provider.image_filename;
          out += `
        <div class="service-provider">
        <i class="fa-solid fa-bars"></i>
        <i class="fa-solid fa-gear"></i>
        <img class="profile-pic" src="/../OOP/images/photo/${chatImg}" alt="profile-pic" />
        <h4>${provider.fname} ${provider.mname} ${provider.lname}</h4>
        <p><br>${provider.description}<br></p>
        <div class="social-media">
          <br><i class="fa-brands fa-facebook"></i>
          <i class="fa-brands fa-twitter"></i>
          <i class="fa-brands fa-youtube"></i>
        </div>
        <?php if (isset($_SESSION["user_id"])) {?>
          <div class="buttons">
            <a class="follow-btn" href="/../OOP/pages/hire.php?userid=${provider.user_id}"> Hire</a>
            <a class="follow-btn" href="/../OOP/pages/message.php?userid=${provider.user_id}"> Message</a>
          </div>
          <?php }?>
          <div class="profile-bottom">
          <a href="/../OOP/pages/service-provider.php?userid=${provider.user_id}">
            <p>Learn More About My Profile</p>
            <i class="fa-solid fa-arrow-down"></i>
            </a>
          </div>
        </div>
        `;
        }
      }
      container.innerHTML = out;
    }
  };

  http.open("POST", "/../OOP/js/category.php");
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http.send("category=" + categoryName + "&location=" + locationName);
});
