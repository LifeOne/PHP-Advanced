<?php
require_once('connection.php');
session_start();
$location = '';
if(!isset($_POST)) {
  header("Location: login.php");
  die();
}
/*************
  FUNCTIONS
*************/
  /*
    REGISTER FUNCTIONS
  */
    function validate_username($n) {
      if(strlen($n) == 0) {
        $_SESSION['reg-errors'][] = "Please enter a username.";
        return false;
      }
      for($i = 0; $i < strlen($n); $i++) {
        if(ctype_alpha($n[$i]) || ctype_digit($n[$i])) {
        } else {
          $_SESSION['reg-errors'][] = "Usernames may only contain letters and numbers.";
          return false;
        }
      }
      $query = "SELECT * FROM users WHERE users.username = '{$n}'";
      $results = fetch_record($query);
      if($results > 0) {
        $_SESSION['reg-errors'][] = "Username already exists!";
        return false;
      } else {
        return true;
      }
    }

    function validate_email($n) {
      return filter_var($n, FILTER_VALIDATE_EMAIL);
    }

    function validate_password($n, $n2) {
      if(strlen($n) == 0) {
        $_SESSION['reg-errors'][] = "Please enter a password.";
        return false;
      }
      if($n == $n2) {
        return true;
      } else {
        $_SESSION['reg-errors'][] = "Passwords do not match.";
        return false;
      }

    }
  /*
    LOGIN FUNCTIONS
  */
    function login($user, $pass, $from) {
      $query = "SELECT * FROM users WHERE users.username = '{$user}'";
      $fetch = fetch_record($query);
      $enc = md5($pass . $fetch['salt']);
      $query = "SELECT * FROM users WHERE users.password = '{$enc}'";
      $checkPass = fetch_record($query);
      if($checkPass) {
        //SUCCESSFUL LOGIN
        session_destroy();
        session_start();
        $_SESSION['user-id'] = "{$checkPass['id']}";
        $_SESSION['username'] = "{$checkPass['username']}";
        $_SESSION['logged-in'] = true;
        return 'index.php';
      } else {
        //FAILED LOGIN
        return $from;
      }
    }
  /*
    MESSAGES FUNCTIONS
  */

  /*
    COMMENTS FUNCTIONS
  */


/*************
  USES $_POST
*************/
  if(isset($_POST['id'])) {
  /*
    LOGIN
  */
    if($_POST['id'] == 'login') {
      $location = login($_POST['username'], $_POST['password'], 'login.php');
    }
  /*
    LOGOUT
  */
    if($_POST['id'] == 'logout') {
      session_destroy();
      $location = 'login.php';
    }
  /*
    REGISTER
  */
    if($_POST['id'] == 'register') {
      //PREVENT MYSQL INJECTIONS
      $username = escape_this_string($_POST['username']);
      $email = escape_this_string($_POST['email']);
      $password = escape_this_string($_POST['password']);
      $c_password = escape_this_string($_POST['c_password']);

      //iv[] = is valid | index = assigned index for specific validation
      $iv[0] = validate_username($username);
      $iv[1] = validate_email($email);
      $iv[2] = validate_password($password, $c_password);

      if($iv[0] && $iv[1] && $iv[2]) {
        //REGISTRATION IS VALID. CREATE DATABASE ENTRY AND LOG THEM IN.
        $salt = bin2hex(openssl_random_pseudo_bytes(22));
        $enc_password = md5($password . $salt);
        $query = "INSERT INTO users (username, email, password, salt, created_at, updated_at)
                  VALUES('{$username}', '{$email}', '{$enc_password}', '{$salt}', NOW(), NOW())";
        run_mysql_query($query);

        $location = login($username, $password, 'register.php');

      } else {
        //REGISTRATION IS INVALID. POINT BACK TO REGISTER PAGE AND INFORM THEM OF ERRORS.
        $location = 'register.php';
      }

    }
  /*
    NEW MESSAGE
  */
    if($_POST['id'] == 'message') {
      if($_POST['content']) {
        $content = escape_this_string($_POST['content']);
        $query = "INSERT INTO messages (user_id, message, created_at, updated_at) VALUES('{$_SESSION['user-id']}', '{$content}', NOW(), NOW())";
        run_mysql_query($query);
      }
      $location = 'index.php';
    }
  /*
    NEW COMMENT
  */
    if($_POST['id'] == 'comment') {
      if($_POST['content']) {
        $content = escape_this_string($_POST['content']);
        $commentquery = "INSERT INTO comments (message_id, user_id, comment, created_at, updated_at) VALUES('{$_POST['message-id']}', '{$_SESSION['user-id']}', '{$content}', NOW(), NOW())";
        run_mysql_query($commentquery);
      }
      $location = 'index.php';
    }
  }


/*************
     MISC
*************/
  // var_dump($location);
  header("Location: $location");
?>
