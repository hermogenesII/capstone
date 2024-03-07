
<section class="myaccount-tabcontent" id="my-message">
  <div class="message-container">
    <div class="chat-container">
      <h1><i class="fa-solid fa-robot"></i> Messages</h1>
      <p>
        Drive growth targeted message that increase sales, tours, to abroad
        new users and more.
      </p>
      <div class="chat-box">
      </div>
      <div class="chat-bottom">
        <textarea name="" id="" cols="0" rows="1" placeholder="Message..."></textarea>
        <button><i class="fa-solid fa-paper-plane"></i></button>
      </div>
    </div>
    <div class="chatlist-container">
      <h2><i class="fa-sharp fa-solid fa-comments"></i> Conversation</h2>
      <p><i class="fa-sharp fa-solid fa-circle-dot"></i> Chat list</p>
      <p><?php echo $_SESSION['user_status'] ?></p>
      <ul id="chatList">
      </ul>
      <div class="chatlist-bottom">
        <!-- <button onclick="openMyAccount(event, 'my-message')">
          <i class="fa-sharp fa-solid fa-paper-plane"></i> Message
        </button>
        <button onclick="openMyAccount(event, 'my-automation')"><i class="fa-solid fa-robot"></i> Automation</button>
      </div> -->
    </div>
  </div>
</section>

<!-- <section class="myaccount-tabcontent" id="my-automation">
    <div class="message-container">
      <div class="chat-container">
        <h1><i class="fa-solid fa-robot"></i> Automations</h1>
        <p>
          Drive growth targeted message that increase sales, tours, to abroad
          new users and more.
        </p>
        <div class="chat-box">
          <div class="chat">
            <img src="App.png" alt="" />
            <h4>Appointment Reminders</h4>
            <p>
              <i class="fa-sharp fa-solid fa-cannabis"></i> Send a message
              remind 24 hours before a schedule appointments.
            </p>
            <button>
              <i class="fa-sharp fa-solid fa-check-to-slot"></i> Apply
            </button>
          </div>
        </div>
        <div class="chat-bottom">
          <textarea name="" id="" cols="0" rows="1" placeholder="Message..."></textarea>
          <button><i class="fa-solid fa-paperclip"></i></button>
          <button><i class="fa-solid fa-paper-plane"></i></button>
        </div>
      </div>
      <div class="chatlist-container">
        <h2><i class="fa-sharp fa-solid fa-comments"></i> Conversation</h2>
        <p><i class="fa-sharp fa-solid fa-circle-dot"></i> Chat list</p>
        <ul>
          <li>
            <img src="4.png" alt="" />
            <p>Hermogenes II Pelaez Magsino</p>
          </li>
          <li>
            <img src="4.png" alt="" />
            <p>Erwin B. Andrade</p>
          </li>
          <li>
            <img src="4.png" alt="" />
            <p>Eudichael Jardeleza</p>
          </li>
          <li>
            <img src="4.png" alt="" />
            <p>Vincent Andrew Monleon</p>
          </li>
          <li>
            <img src="4.png" alt="" />
            <p>Princess Nicole Safari</p>
          </li>
          <li>
            <img src="4.png" alt="" />
            <p>Patrick Dave Zoleta</p>
          </li>
          <li>
            <img src="4.png" alt="" />
            <p>Emerson Lacdao</p>
          </li>
          <li>
            <img src="4.png" alt="" />
            <p>Dwyane Stephen</p>
          </li>
          <li>
            <img src="4.png" alt="" />
            <p>Kurt Ruzzel Bernardo</p>
          </li>
        </ul>
        <div class="chatlist-bottom">
          <button onclick="openMyAccount(event, 'my-message')">
            <i class="fa-sharp fa-solid fa-paper-plane"></i> Message
          </button>
          <button onclick="openMyAccount(event, 'my-automation')">
            <i class="fa-solid fa-message"></i> Automation
          </button>
          <button><i class="fa-solid fa-robot"></i> Automation</button>
        </div>
      </div>
    </div>
</section> -->

<script src="/../OOP/js/chat.js"></script>