<?php
  session_start();
  if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true) {
    header('Location: index.php');
    die();
  }
  if(isset($_SESSION['reg-errors'])) {
    $re = true;
  } else {
    $re = false;
  }
 ?>

<html lang='en-US'>
  <head>
    <meta charset='utf-8'>
    <title>Register</title>
    <style>
      * {
        font-family: "Courier New", Courier, monospace;
        text-align: center;
      }
      #wrapper {
        width: 500px;
        margin: 0 auto;
      }
      span {
        display: block;
        margin: 10px 5px;
      }
      input {
        text-align: left;
      }
      #titles, #form {
        width: 200px;
        display: inline-block;
        vertical-align: top;
      }
      <?php if(isset($_SESSION['reg-errors'])) { ?>
      #errors {
        margin: 25px auto 0 auto;
        text-align: left;
        color: red;
      }
      <?php } ?>
    </style>
  </head>
  <body>
    <div id="wrapper">
      <h3>Register Below!</h3>
      <div id='titles'>
        <span>Username: </span>
        <span>Email: </span>
        <span>Password: </span>
        <span>Confirm Password: </span>
      </div>
      <div id='form'>
      <form action='process.php' method='post'>
        <input type='hidden' name='id' value='register'>
        <span><input type='text' name='username'></span>
        <span><input type='email' name='email'></span>
        <span><input type='password' name='password'></span>
        <span><input type='password' name='c_password'></span>
      </div>
        <span><input type='submit' value='Register'></span>
      </form>
      <a href='login.php'>Already have an account?</a>
    </div>
    <?php if($re) { ?>
    <div id='errors'>
      <?php foreach($_SESSION['reg-errors'] as $error) { ?>
        <p><?= $error ?></p>
      <?php }?>
    </div>
    <?php }
    session_destroy();
    ?>
  </body>
</html>
