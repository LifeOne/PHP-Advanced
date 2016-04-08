<?php
  session_start();
  require_once('connection.php');
  /*

  If the email address in not valid, have a notification "Email is not valid!" to display on the homepage.
  Once a valid email address is entered, save the email address the user entered into the database.
  On success.php, display all the email addresses entered along with the date and the time (e.g. June 24th 2013, 6:00PM) when the email addresses were entered
  (Bonus) add a new feature that allows the user in success.php to delete an email record.

  */
  //EMAIL VALIDATION SHIZ
  function validate_email($e) {
    if(strlen($e) == 0)
      return false;
    else {
      $firstchar = false;
      $at = false;
      $domain = false;
      $dot = false;
      $tld = false;
      $atDotCount = 0;
      for($i = 0; $i < strlen($e); $i++) {
        if(!$firstchar && (ctype_digit($e[$i]) || ctype_alpha($e[$i]))) {
          $firstchar = true;
        } else if($firstchar && !$at && ($e[$i] == '@')) {
          $at = true;
        } else if($at && !$domain && (ctype_alpha($e[$i]) || ctype_digit($e[$i]))) {
          $domain = true;
        } else if($domain && !$dot && ($e[$i] == '.')) {
          $dot = true;
        } else if($dot && !$tld && ctype_alpha($e[$i])) {
          return ($atDotCount < 3 ? true : false);
        }
        if($e[$i] == '@' || $e[$i] == '.') {
          $atDotCount++;
        }
      }
      return false;
    }
  }

  //CHECK IF EMAIL EXISTS
  $query = "SELECT * FROM users";
  $users = fetch_all($query);


  if($_POST['id'] == 'registrar') {
    //MATCHED EMAIL -> LOGIN
    $matches = false;
    foreach($users as $user) {
      if($_POST['email'] == $user['email']) {
        $matches = true;
      }
    }

    if($matches == true) {
      $_SESSION['match'] = true;
      $location = 'success.php';
    } //NEW EMAIL -> VALIDATE
    else {
      $isTrue = validate_email($_POST['email']);
      if(!$isTrue)
        $_SESSION['hasError'] = true;
      else {
        $_SESSION['email'] = $_POST['email'];
        $query = "INSERT INTO users (email, created_at, updated_at) VALUES('{$_SESSION['email']}', NOW(), NOW())";
        if(run_mysql_query($query)){}
      }

      $location = ($isTrue ? 'success.php' : 'index.php');

    }
    header("Location: $location");
  } else if ($_POST['id'] == 'delete') {
    $query = "DELETE FROM users WHERE id = {$_POST['id_to_delete']}";
    if(run_mysql_query($query)) {}
    header("Location: success.php");
  }

 ?>
