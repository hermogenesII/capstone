let sideMenu = document.querySelector("#sidebar-btn");
let showMenu = document.querySelector(".myaccount-container");

sideMenu.addEventListener("click", function () {
  this.focus();
  showMenu.classList.toggle("active");
});

document.querySelector("body").addEventListener("click", function (evt) {
  if (!showMenu.classList.contains("active")) return;
  var isNav = showMenu.contains(evt.target) || sideMenu.contains(evt.target);
  if (!isNav) {
    showMenu.classList.remove("active");
  }
});

window.onscroll = () => {
  showMenu.classList.remove("active");
};
