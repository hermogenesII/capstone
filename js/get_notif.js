notifList = document.getElementById("notifList");

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/../OOP/php/get_notif.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        notifList.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 500);
