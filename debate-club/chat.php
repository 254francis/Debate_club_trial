<?php
session_start();
if (!isset($_SESSION['user_id'])) header('Location: login.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chat Room</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <style>
    #chat-box { height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px; }
    .msg { margin-bottom: 10px; }
  </style>
</head>
<body class="container py-4">
  <h3>Welcome to the Chat Room</h3>

  <div id="chat-box" class="mb-3"></div>

  <form id="chat-form">
    <input type="text" id="message" class="form-control" placeholder="Type your message..." required>
    <button type="submit" class="btn btn-primary mt-2">Send</button>
  </form>

  <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>

  <script>
    function loadChat() {
      $.get("ajax_chat.php", function(data) {
        $("#chat-box").html(data);
        $("#chat-box").scrollTop($("#chat-box")[0].scrollHeight);
      });
    }

    $(document).ready(function() {
      loadChat();
      setInterval(loadChat, 3000);

      $("#chat-form").on("submit", function(e) {
        e.preventDefault();
        $.post("ajax_chat.php", {
          action: "send",
          message: $("#message").val()
        }, function() {
          $("#message").val('');
          loadChat();
        });
      });
    });
  </script>
</body>
</html>
