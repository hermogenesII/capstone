function csload(entry) {
  var data = new FormData(),
    target;

  if (entry == 1) {
    data.append("segment", "category");
    target = document.getElementById("category");
  } else {
    data.append("segment", "specific-service");
    data.append("category", document.getElementById("category").value);
    target = document.getElementById("specific-service");
  }

  fetch("/../OOP/php/category_function.php", {
    method: "POST",
    body: data,
  })
    .then((res) => {
      return res.text();
    })
    .then((options) => {
      target.innerHTML = options;
    });
}
window.addEventListener("DOMContentLoaded", () => {
  document.getElementById("category").onchange = () => {
    csload(2);
  };
});
