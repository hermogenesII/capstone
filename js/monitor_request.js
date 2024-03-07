monitorRequest = document.getElementById("monitor_request");
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/../OOP/php/monitor_request.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        monitorRequest.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 500);
