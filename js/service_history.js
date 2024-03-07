serviceHistory = document.getElementById("service_history");

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/../OOP/php/service_history.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        serviceHistory.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 500);
