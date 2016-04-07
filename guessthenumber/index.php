<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <title>Great Number Game!</title>
    <style type='text/css'>
      * {
        padding: 0;
        margin: 0;
      }
      #wrapper {
        width: 500px;
        margin: 25px auto;
        text-align: center;
      }
      h3 {
        margin: 20px 5px;
      }
      p {
        margin: 10px;
      }
      input {
        margin: 5px 150px;
      }
      form {
        text-align: center;
        margin-top: 40px;
      }
      #restart {
        margin-top: 50px;
      }
      .red {
        background-color: red;
        height: 100px;
        color: white;
      }
      .green {
        background-color: green;
        height: 100px;
        color: white;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <h3>Welcome to the Great Number Game!</h3>
      <p>I am thinking of a number between 1 and 100.</p>
      <p>Take a guess!</p>
      <?php if(!empty($_SESSION['return'])) {
        ?><p class="<?=$_SESSION['return-class']?>"><?=$_SESSION['return']?></p><?php
      }?>
      <form action="process.php" method="post">
        <input type='hidden' name='id' value='game'>
        <input type='text' name='guess'>
        <input type='submit'>
      </form>
      <form action="process.php" method="post" id='restart'>
        <input type='hidden' name='id' value='restart'>
        <input type='submit' value='Restart'>
      </form>
    </div>
  </body>
</html>
