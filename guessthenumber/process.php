<?php
session_start();
if($_POST['id'] == 'game') {
  $_SESSION['guess'] = $_POST['guess'];
  if(!isset($_SESSION['answer'])) {
    $_SESSION['answer'] = mt_rand(1,100);
  }

  if($_SESSION['guess'] == $_SESSION['answer']) {
    $_SESSION['return'] = "Congratulations! You guessed the correct number.";
    $_SESSION['return-class'] = 'green';
  } else if($_SESSION['guess'] > $_SESSION['answer']) {
    $_SESSION['return'] = "Too high!";
    $_SESSION['return-class'] = 'red';
  } else if($_SESSION['guess'] < $_SESSION['answer']) {
    $_SESSION['return'] = "Too low!";
    $_SESSION['return-class'] = 'red';
  } else {
    $_SESSION['return'] = 'Unknown error.';
  }
} else if($_POST['id'] == 'restart') {
  session_destroy();
}

header('Location: index.php');

 ?>
