<?php
  session_start();
  /*

  If the email address in not valid, have a notification "Email is not valid!" to display on the homepage.
  Once a valid email address is entered, save the email address the user entered into the database.
  On success.php, display all the email addresses entered along with the date and the time (e.g. June 24th 2013, 6:00PM) when the email addresses were entered
  (Bonus) add a new feature that allows the user in success.php to delete an email record.

  */

  require_once('connection.php');

  // $query = "SELECT * FROM people WHERE id = 1";
  // $person = fetch_record($query);
  //

 ?>
<html lang='en-US'>
  <head>
    <meta charset='utf-8'>
    <title>Email Validation</title>
    <style>
      #wrapper {
        width: 400px;
        border: 1px solid black;
        margin: 25px auto;
        text-align: center;
      }
      input {
        margin: 15px 5px;
      }
      .wide-text-input {
        width: 250px;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <p>
        <?php echo (!isset($_SESSION['hasError']) ? 'Enter your email:' : 'Please enter a valid email:'); ?>
      </p>
      <form action='process.php' method='post'>
        <input type='hidden' name='id' value='registrar'>
        <input type='text' name='email' class="wide-text-input">
        <input type='submit'>
      </form>
    </div>
  </body>
</html>
<?php
  session_destroy();
 ?>
