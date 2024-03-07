const form = document.querySelector(".typing_area"),
  inputField = form.querySelector(".input"),
  sendBtn = form.querySelector("button"),
  chatbox = document.querySelector(".chat-box"),
  chatupper = document.querySelector(".chat-upper");

form.onsubmit = (e) => {
  e.preventDefault();
};

sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/../OOP/php/insert_chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = "";
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/../OOP/php/get_chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatbox.innerHTML = data;
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/../OOP/php/get_chat-profile.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatupper.innerHTML = data;
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);
