subcriptionList = document.getElementById("proof-js");

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/../OOP/php/proof.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        subcriptionList.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 500);

//javascript nung image sa admin ng proof

const image = document.getElementById("image");
let originalWidth = image.style.width;
let originalHeight = image.style.height;

image.addEventListener("click", function () {
  image.style.width = "350px";
  image.style.height = "auto";
});

document.body.addEventListener("click", function () {
  image.style.width = originalWidth;
  image.style.height = originalHeight;
});
