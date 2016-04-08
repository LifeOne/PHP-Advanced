<?php
session_start();
require_once('connection.php');
$query = "SELECT * FROM users";
$users = fetch_all($query);
  /*

  If the email address in not valid, have a notification "Email is not valid!" to display on the homepage.
  Once a valid email address is entered, save the email address the user entered into the database.
  On success.php, display all the email addresses entered along with the date and the time (e.g. June 24th 2013, 6:00PM) when the email addresses were entered
  (Bonus) add a new feature that allows the user in success.php to delete an email record.

  */
if(!isset($_SESSION['email']) && !isset($_SESSION['match'])) {
   header("Location: index.php");
   die();
}

$user_emails = [];
$user_time = [];
foreach($users as $user) {
  $user_emails[] = $user['email'];
  $user_time[] = $user['created_at'];
}

 ?>
<html lang='en-US'>
  <head>
    <meta charset='utf-8'>
    <title>Master Email List</title>
    <style>
      * {
        font-size: 18px;
      }
      #wrapper {
        width: 650px;
        margin: 0 auto;
      }
      #success {
        width: 400px;
        margin: 15px auto;
        background-color: #2ecc71;
        border: 1px solid black;
      }
      #list {
        margin: 25px auto;
        text-align: center;
        border: 1px solid black;
        padding: 15px;
      }
      #list p {
        margin: 5px;
      }
      #emails, #times, #delete {
        width: 200px;
        padding: 0;
        margin: 0;
        display: inline-block;
      }
      span, input, button {
        display: block;
        margin: 10px;
        padding: 0;
      }
      h6 {
        margin: 0;
        margin-bottom: 25px;
        border-bottom: 1px solid black;
      }
      p {
        text-align: center;
      }
      form {
        text-align: center;
        margin: 0;
        padding: 0;
      }
      .delete-button {
        padding-bottom: 1px;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <div id="success">
        <p><?php
          $out = (isset($_SESSION['email']) ? "The email address you entered '{$_SESSION['email']}' is a valid email address! Thank you!" : "Welcome back!");
          echo $out;
        ?></p>
      </div>
      <div id="list">
        <div id='emails'>
          <h6>Email Address</h6>
          <?php
            foreach($user_emails as $user_email) {
              echo "<span>". $user_email . "</span>";
            }
           ?>
        </div>
        <div id='times'>
          <h6>Time Created</h6>
          <?php
            foreach($user_time as $created) {
              echo "<span>" . $created . "</span>";
            }
          ?>
        </div>
        <div id="delete">
          <h6>Delete Entry</h6>
          <?php
            foreach($users as $user) {
              // echo "<form action='process.php' method='post'><input type='hidden' name='id' value='delete'><input type='hidden' name='id_to_delete' value='{$user['id']}'><input class='delete-button' type='submit' value='Delete'></form>";

              echo "<form action='process.php' method='post'><input type='hidden' name='id' value='delete'><input type='hidden' name='id_to_delete' value='{$user['id']}'><button class='delete-button' type='submit'>Delete</button></form>";
            }
           ?>
        </div>
      </div>
      <form action='index.php'>
        <input type='submit' value='Back'>
      </form>
    </div>
  </body>
</html>
<?php
// session_destroy();
?>
