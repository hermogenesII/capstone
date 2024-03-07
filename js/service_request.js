serviceRequest = document.getElementById("service_request");
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/../OOP/php/service_request.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        serviceRequest.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 500);
