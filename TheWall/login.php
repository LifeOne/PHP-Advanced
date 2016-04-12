<?php
  session_start();
  if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true) {
    header('Location: index.php');
  }
 ?>

<html lang='en-US'>
  <head>
    <meta charset='utf-8'>
    <title>Login</title>
    <style>
      * {
        font-family: "Courier New", Courier, monospace;
        text-align: center;
      }
      #wrapper {
        width: 400px;
        margin: 0 auto;
      }
      span {
        display: block;
        margin: 10px 5px;
      }
      input {
        text-align: left;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <h3>Welcome to the Wall! Please Login!</h3>
      <form action='process.php' method='post'>
        <input type='hidden' name='id' value='login'>
        <span>Username: <input type='text' name='username'></span>
        <span>Password: <input type='password' name='password'></span>
        <span><input type='submit' value='Login'></span>
      </form>
      <a href='register.php'>Don't have an account?</a>
    </div>
  </body>
</html>
