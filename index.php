
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-analytics.js"></script>

<style>
    form{
        /* width: 200px; */
        display: flex;
        flex-direction: column;
    }
    div{
        padding-top: 20px;
        width: 300px;
        display: flex;
        flex-direction: column;
    }
    ul{
        list-style-type: none;
    }
</style>


</head>
<body>
    <div style="margin: 0 auto;">

    
        <form onsubmit="return sendMessage();">

            <textarea  type="text" id="message" placeholder="Enter message" autocomplete="off" rows="4"></textarea >
            <input type="submit" value="Send" style="height: 30px; width: 200px; margin: 10px auto;">
        </form>
        <ul id = "messages">

        </ul>
    </div>

    



    <script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyCOd6wrxRJdA3cIxyhBKXBSeb5kMgYPmZA",
    authDomain: "my-chatproject-3c62c.firebaseapp.com",
    databaseURL: "https://my-chatproject-3c62c.firebaseio.com",
    projectId: "my-chatproject-3c62c",
    storageBucket: "my-chatproject-3c62c.appspot.com",
    messagingSenderId: "888814097530",
    appId: "1:888814097530:web:81529d787949927a3357c3",
    measurementId: "G-SQ4BL2F8DK"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  var myName = prompt('Enter your name');
  function sendMessage(){
      var message = document.getElementById('message').value;
      firebase.database().ref("messages").push().set({
        "sender": myName,
        "message": message
      });

      return false;
  }

  firebase.database().ref('messages').on('child_added', function(snapshot){
    var html = "";
    html += "<li id='messsage-" + snapshot.key +"'>";
    
    html += snapshot.val().sender + ": " + snapshot.val().message;
    html += "<span>  </span>";
    if(snapshot.val().sender == myName){
        // html +="<br> "
        html += "<button data-id='" + snapshot.key +"' onclick='deleteMessage(this);'>";
        html += "Delete";
        html += "</button>";
    }
    html += "</li>";

    document.getElementById('messages').innerHTML += html;
  });

  function deleteMessage(self){
    var messageId = self.getAttribute("data-id");
    firebase.database().ref("messages").child(messageId).remove();
  }
  firebase.database().ref("messages").on("child_removed", function(snapshot){
      var msg = document.getElementById("message-" + snapshot.key);
    //   msg.innerHTML = "removed";
  });
</script>
</body>
</html>



