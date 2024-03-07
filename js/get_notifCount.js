notifCount = document.getElementById("notifCount");

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/../OOP/php/get_notifCount.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        notifCount.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 500);
