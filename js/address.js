function csload(entry) {
  var data = new FormData(),
    target,
    next;

  if (entry == 1) {
    data.append("segment", "country");
    target = document.getElementById("country");
    next = 2;
  } else if (entry == 2) {
    data.append("segment", "province");
    data.append("country", document.getElementById("country").value);
    target = document.getElementById("province");
  } else if (entry == 3) {
    data.append("segment", "municipality");
    data.append("country", document.getElementById("country").value);
    data.append("province", document.getElementById("province").value);
    target = document.getElementById("municipality");
  } else {
    data.append("segment", "barangay");
    data.append("country", document.getElementById("country").value);
    data.append("province", document.getElementById("province").value);
    data.append("municipality", document.getElementById("municipality").value);
    target = document.getElementById("barangay");
  }

  fetch("/../OOP/php/address_function.php", {
    method: "POST",
    body: data,
  })
    .then((res) => {
      return res.text();
    })
    .then((options) => {
      target.innerHTML = options;
      if (next) {
        csload(next);
      }
    });
}

window.addEventListener("DOMContentLoaded", () => {
  document.getElementById("country").onchange = () => {
    csload(2);
  };

  document.getElementById("province").onchange = () => {
    csload(3);
  };

  document.getElementById("municipality").onchange = () => {
    csload(4);
  };
  csload(1);
});
