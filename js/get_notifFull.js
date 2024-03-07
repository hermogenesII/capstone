notifFullList = document.getElementById("notifFullList");
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/../OOP/php/get_notifFull.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        notifFullList.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 500);
