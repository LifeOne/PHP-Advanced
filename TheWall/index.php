<?php
session_start();
if(!isset($_SESSION['user-id'])) {
  session_destroy();
  header("Location: login.php");
  die();
}
require_once('connection.php');
 ?>
<html lang='en-US'>
  <head>
    <meta charset='utf-8'>
    <title>The Wall</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        font-family: "Courier New", Courier, monospace;
      }
      #top {
        border-bottom: 1px solid black;
        margin: 0 0;
        text-align: right;
        height: 30px;
      }
      #top span, #top form {
        display: inline-block;
        text-align: right;
        margin-right: 25px;
        margin-top: 5px;
      }
      #wall {
        width: 800px;
        margin: 0 auto;
      }
      .left {
        display: inline-block;
        float: left;
        overflow: hidden;
        margin-left: 25px;
        margin-top: 2px;
        text-align: left;
      }
      #postm {
        margin-top: 50px;
      }

      .post-right {
        text-align: right;
        margin: 5px 0;
      }
      .post-right input {
        width: 100px;
        text-align: center;
      }
      h3 {
        font-size: 24px;
      }
      textarea {
        resize: none;
        font-size: 15px;
        padding: 5px;
      }
      .message-content {
        margin: 5px 12px;
      }
      .postc {
        margin: 20px 20px 20px 50px;
      }
      .comment {
        margin: 20px 20px 20px 50px;
      }
      .comment-content {
        margin: 5px;
      }
    </style>
  </head>
  <body>
    <div id='top'>
      <div class='left'>
        <h2>CodingDojo Wall</h2>
      </div>
      <span>Welcome <?= $_SESSION['username']?></span>
      <form action='process.php' method='post'>
        <input type='hidden' name='id' value='logout'>
        <input type='submit' value='Logout'>
      </form>
    </div>
    <div id='wall'>
      <div id='postm'>
        <h3>Post a message</h3>
        <form action='process.php' method='post' name='postmessage'>
          <input type='hidden' name='id' value='message'>
          <textarea name='content' rows="5" cols="86"></textarea>
          <div class='post-right'>
            <input type='submit' value='Post Message'>
          </div>
        </form>
      </div>

      <?php
      $query = "SELECT username, message, messages.id, messages.created_at FROM messages JOIN users ON messages.user_id = users.id";
      $messages = fetch_all($query);

      foreach($messages as $message) { ?>
        <div class='message'>
          <h4><?= $message['username']?> - <?php $time = strtotime($message['created_at']); echo date("g:ia F j Y", $time);?></h4>
          <p class='message-content'><?= $message['message']?></p>
          <?php
            $query = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE message_id = '{$message['id']}'";
            $comments = fetch_all($query);
            foreach($comments as $comment) {
              ?>
              <div class='comment'>
                <h4><?= $comment['username']?> - <?php $time = strtotime($comment['created_at']); echo date("g:ia F j Y", $time);?></h4>
                <p class='comment-content'><?= $comment['comment']?></p>
              </div>
              <?php
            }
          ?>
          <div class='postc'>
            <p>Post a comment</p>
            <form action='process.php' method='post'>
              <input type='hidden' name='id' value='comment'>
              <input type='hidden' name='message-id' value="<?= $message['id']?>">
              <textarea name='content' rows="3" cols="78"></textarea>
              <div class='post-right'>
                <input type='submit' value='Post Comment'>
              </div>
            </form>
          </div>
        </div>
      <?php  } ?>
    </div>
  </body>
</html>
<?php
?>
