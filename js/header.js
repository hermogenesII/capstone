// MENU NAVIGATION

let menuBtn = document.querySelector("#menu-btn");
let navMenu = document.querySelector(".navigation");

menuBtn.addEventListener("click", function () {
  this.focus();
  navMenu.classList.toggle("active");
});

let searchbtn = document.querySelector("#search-btn");
if (searchbtn) {
  let searchBtn = searchbtn;

  let searchBar = document.querySelector(".search-bar");

  searchBtn.addEventListener("click", function () {
    this.focus();
    searchBar.classList.toggle("active");
  });

  document.querySelector("body").addEventListener("click", function (evt) {
    if (
      !navMenu.classList.contains("active") &&
      !searchBar.classList.contains("active")
    )
      return;
    var isNav =
      navMenu.contains(evt.target) ||
      menuBtn.contains(evt.target) ||
      searchBar.contains(evt.target) ||
      searchBtn.contains(evt.target);
    if (!isNav) {
      navMenu.classList.remove("active");
      searchBar.classList.remove("active");
    }
  });

  window.onscroll = () => {
    navMenu.classList.remove("active");
    searchBar.classList.remove("active");
  };

  // function toggleSuggestions() {
  // Get the search input and suggestions container elements

  // const searchInput = document.getElementById("search");
  // const suggestionsContainer = document.getElementById("result-div");

  const searchInput = document.querySelector("#search");
  const suggestionContainer = document.querySelector("#result-div");

  searchInput.addEventListener("input", (event) => {
    // Get the current value of the search input
    const searchValue = event.target.value;

    // Show the suggestion container if the search input has a value,
    // otherwise hide it
    if (searchValue) {
      suggestionContainer.style.display = "block";
    } else {
      suggestionContainer.style.display = "none";
    }
  });

  document.body.addEventListener("click", (event) => {
    // Hide the container by setting its display style to none
    suggestionContainer.style.display = "none";
  });

  document.body.addEventListener("scroll", (event) => {
    // Hide the container by setting its display style to none
    suggestionContainer.style.display = "none";
  });
}
//   // If the suggestions container is currently hidden, show it
//   if (suggestionsContainer.style.display === "none") {
//     suggestionsContainer.style.display = "block";
//   } else {
//     // Otherwise, hide it
//     suggestionsContainer.style.display = "none";
//   }
// }

// // Get the search input element
// var searchInput = document.getElementById("search");

// // Add event listeners to show and hide the suggestions when the input is focused or blurred
// searchInput.addEventListener("focus", toggleSuggestions);
// searchInput.addEventListener("blur", toggleSuggestions);
