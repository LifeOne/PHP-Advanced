<?php

 ?>
 <html lang='en-US'>
  <head>
    <meta charset='utf-8'>
    <title>Quoting Dojo</title>
    <style>
      * {
        padding: 0;
        margin: 0;
        font-size: 20px;
        font-family: 'Comic Sans MS', cursive, sans-serif;
      }
      body {
        background-color: #2ecc71;
      }
      h1 {
        font-size: 36px;
        text-align: center;
        margin: 15px;
      }
      #wrapper {
        margin: 0 auto;
        width: 650px;
      }
      span {
        display: block;
        margin: 15px;
      }
      form {
        display: inline-block;
      }
      .button {
        margin-left: 150px;
      }
      #in-quote {
        width: 400px;
        height: 200px;
        vertical-align: top;
        padding: 0 10px;
      }
      #in-name {
        width: 400px;
        padding: 0 10px;
      }
      #left, #right {
        display: inline-block;
      }
      #left {
        width: 200px;
        vertical-align: top;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <h1>Welcome to Quoting Dojo!</h1>
      <div id="left">
        <span>Your name:</span>
        <span>Your quote:</span>
      </div>
      <div id="right">
        <form action='process.php' method='post'>
          <input type='hidden' name='id' value='add-quote'>
          <span><input id='in-name' type='text' name='name'></span>
          <span><textarea id='in-quote' cols="30" rows="10" type='text' name='quote'></textarea></span>
      </div>
      <div id="bottom">
          <input class='button' type='submit' value='Add my quote!'>
        </form>
        <form action='process.php' method='post'>
          <input type='hidden' name='id' value='skip-to-quotes'>
          <input class='button' type='submit' value='Skip to quotes!'>
        </form>
      </div>

    </div>
  </body>
</html>
