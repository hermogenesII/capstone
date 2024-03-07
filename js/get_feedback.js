ratings = document.getElementById("rating-and-review-container");

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/../OOP/php/get_feedback.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        ratings.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 500);
