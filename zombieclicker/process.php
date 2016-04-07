<?php

  session_start();
  function get_brains($min, $max, $canLose) {
    if($canLose) {
      $t = mt_rand($min, $max);
      $wL = mt_rand(1,2);
      if($wL == 1) {
        return $t;
      } else {
        if($t > $_SESSION['brains']) {
          $t = $_SESSION['brains'];
        }
        return -$t;
      }
    } else {
      return mt_rand($min, $max);
    }
  }

  function set_log($act, $x, $isRaid) {
    $arr = $_SESSION['log'];
    $date = date('m/d/Y h:i:s', time());

    if(count($arr) == 8) {
      //shift
      for($i = 0; $i < count($arr) - 1; $i++) {
        $arr[$i] = $arr[$i+1];
      }
      array_pop($arr);
    }
    if($isRaid) {
      if($x >= 0) {
        $arr[] = 'You successfully looted ' . $x . ' brains from an enemy zombie during your raid! - (' . $date . ')';
      } else {
        $x = abs($x);
        $arr[] = 'You failed your raid and lost ' . $x . ' brains. RIP. - (' . $date . ')';
      }
    } else {
      $arr[] = 'You explored a ' . $act . ' and got ' . $x . ' brains! - (' . $date . ')';
    }

    return $arr;
  }

  if(!isset($_SESSION['log'])) {
    $_SESSION['log'] = array();
  }
  // 8 total logs at any given time

  if(isset($_SESSION['brains'])) {

    if($_POST['action'] == 'farm') {
      $get_b = get_brains(1,2,false);
      $_SESSION['brains'] += $get_b;
      $_SESSION['log'] = set_log('farm', $get_b, false);

    } else if($_POST['action'] == 'town') {
      $get_b = get_brains(4,10,false);
      $_SESSION['brains'] += $get_b;
      $_SESSION['log'] = set_log('town', $get_b, false);

    } else if($_POST['action'] == 'city') {
      $get_b = get_brains(10,50,false);
      $_SESSION['brains'] += $get_b;
      $_SESSION['log'] = set_log('city', $get_b, false);

    } else if($_POST['action'] == 'raid') {
      $get_b = get_brains(0,150,true);
      $_SESSION['brains'] += $get_b;
      $_SESSION['log'] = set_log('raid', $get_b, true);

    } else if($_POST['action'] == 'restart') {
      session_destroy();
      session_start();
    }

  }
  header('Location: index.php');


 ?>
