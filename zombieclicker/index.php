<?php

session_start();


 ?>
 <!DOCTYPE html>
 <html lang="en-US">
  <head>
    <meta charset="utf-8">
    <title>Zombie Clicker</title>
    <style>
      #wrapper {
        margin: 0 auto;
        width: 1000px;
      }
      #message-log p {
        font-size: 10px;
        margin: 5px;
      }
      #message-log {
        margin: 20px;
        border: 1px solid black;
        height: 150px;
        width: 930px;
        overflow: hidden;
      }
      #top, #mid, #bottom {
        margin: 10px 0;
      }
      .explore {
          margin: 10px 20px 10px 20px;
          width: 198px;
          height: 198px;
          border: 1px solid black;
          display: inline-block;
      }
      #brains {
        border: 1px solid black;
        padding: 2px 15px;
      }
      .explore span, form {
        display: block;
        text-align: center;
        font-size: 18px;
        margin: 15px;
      }
      input {
        font-size: 18px;
      }
      #reset {
        display: inline-block;
        text-align: right;
        margin: 15px 15px 15px 750px;
      }
      #reset input {
        font-size: 18px;
      }
      .success {
        color: green;
      }
      .fail {
        color: red;
      }
    </style>
  </head>
  <body>
  <div id="wrapper">
    <div id="top">
      <span>Your Brains: </span>
      <span id="brains"><?php
        if(isset($_SESSION['brains'])) {
          echo $_SESSION['brains'];
        } else {
          $_SESSION['brains'] = 0;
          echo $_SESSION['brains'];
        }
      ?></span>
      <form id="reset" action="process.php" method="post">
        <input type='hidden' name='action' value='restart'>
        <input type="submit" value="Restart">
      </form>
      <p>You are a zombie at the beginning of an apocalypse. Build up your food supply before there are no more brains to be found!</p>
    </div>
    <div id="mid">
      <div class="explore">
        <span>Explore Farm</span>
        <span>get 1-2 brains</span>
        <form action="process.php" method="post">
          <input type='hidden' name='action' value='farm'>
          <input type='submit' value='Find Brains!'>
        </form>
      </div>
      <div class="explore">
        <span>Explore Town</span>
        <span>get 4-10 brains</span>
        <form action="process.php" method="post">
          <input type='hidden' name='action' value='town'>
          <input type='submit' value='Find Brains!'>
        </form>
      </div>
      <div class="explore">
        <span>Explore City</span>
        <span>get 10-50 brains</span>
        <form action="process.php" method="post">
          <input type='hidden' name='action' value='city'>
          <input type='submit' value='Find Brains!'>
        </form>
      </div>
      <div class="explore">
        <span>Raid Rival Zombie</span>
        <span>get/lose 0-150 brains</span>
        <form action="process.php" method="post">
          <input type='hidden' name='action' value='raid'>
          <input type='submit' value='Find Brains!'>
        </form>
      </div>
    </div>
    <div id="bottom">
      <p>Activities:</p>
      <div id="message-log">
        <?php
          if(isset($_SESSION['log'])) {
            $dump = $_SESSION['log'];
            foreach($dump as $log) {
              if($log[4] == 'f') {
                echo "<p class='fail'>" . $log . "</p>";
              } else {
                echo "<p class='success'>" . $log . "</p>";
              }
            }
          }
        ?>
      </div>
    </div>
  </div>
  </body>
 </html>
