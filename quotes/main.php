<?php
  require_once('connection.php');
  $query = "SELECT * FROM quotes";
  $quotes = fetch_all($query);
  $quote = [];
  foreach($quotes as $single_quote) {
    $quote[] = $single_quote;
  }

 ?>
<html lang='en-US'>
  <head>
    <meta charset='utf-8'>
    <title>Quoting Dojo</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        background-color: #1abc9c;
        font-family: "Comic Sans MS", cursive, sans-serif;
      }
      .quote {
        border-bottom: 1px solid black;
      }
      #wrapper {
        margin: 10px auto;
        width: 800px;
      }
      h1 {
        text-align: center;
        font-size: 36px;
      }
      .by {
        margin-left: 50px;
      }
      form {
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <h1>Awesome Submitted Quotes:</h1>
      <form action='process.php' method='post'>
        <input type='hidden' name='id' value='back-to-submit'>
        <input type='submit' value='Submit a Quote'>
      </form>
      <?php foreach($quote as $element){ ?>
        <div class='quote'>
          <p>"<?= $element['quote'] ?>"</p>
          <p class='by'>- <?= $element['username'] ?> at <?php $out = strtotime($element['created_at']); echo date("g:ia F j Y", $out)?></p>
        </div>
      <?php } ?>
    </div>
  </body>
</html>
