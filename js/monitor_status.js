monitorStatus = document.getElementById("monitor_status");
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/../OOP/php/monitor_status.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        monitorStatus.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 500);
