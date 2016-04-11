<?php
  require_once('connection.php');
  $location = '';

  function validate_name($name) {
    $val_pass = false;
    for($i = 0; $i < strlen($name); $i++) {
      if(ctype_alpha($name[$i]) || ctype_digit($name[$i])) {
      } else {return false;}
    }
    return true;
  }
  function validate_quote($quote) {
    return ($quote ? true : false);
  }

  if($_POST['id'] == 'skip-to-quotes') {
    $location = 'main.php';
  } else if($_POST['id'] == 'back-to-submit') {
    $location = 'index.php';
  } else if($_POST['id'] == 'add-quote') {
    $pass = ((validate_name($_POST['name']) && validate_quote($_POST['quote'])) ? true : false);
    if($pass) {
      $query = "INSERT INTO quotes (username, quote, created_at, updated_at) values('{$_POST['name']}', '{$_POST['quote']}', NOW(), NOW())";
      if(run_mysql_query($query)){}
    }

    $location = ($pass ? 'main.php' : 'index.php');


  }


  header("Location: $location");

 ?>
