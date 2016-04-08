<?php
  session_start();
  $passed = false;

  function val_email($l) {
    $at = false;
    $dot = false;
    for($i = 0; $i < strlen($l); $i++) {
      if($l[$i] == '@'){$at = true;}
      else if($l[$i] == '.'){$dot = true;}
    }
    if($at == true && $dot == true)
      return true;
    else if($at == false || $dot == false)
      return false;
  }
  function val_name($l) {
    return ctype_alpha($l);
  }
  function val_password($l, $lc) {
    $true = array();
    $true[0] = (strlen($l) > 6 ? true : false);
    $true[1] = ($l == $lc ? true : false);

    return $true;
  }
  // function val_birthday($l) {
  //
  // }
  // var_dump($_POST);

  if($_POST['id'] == 'registrar') {
  /*
    ELEMENT VALIDATION
  */
    //VALIDATION LOGIC
      //EMAIL
        $email_valid = val_email($_POST['email']);
      //NAME
        $first_valid = val_name($_POST['first_name']);
        $last_valid = val_name($_POST['last_name']);
      //PASSWORD
        $password_valid = val_password($_POST['password'], $_POST['password-confirm']);

    //VALIDATION MESSAGES
      //EMAIL
        $em_valid = 'The email you entered is ' . ($email_valid ? 'valid' : 'invalid') . '.<br>';
      //NAME
        $fn_valid = 'The characters in your first name are ' . ($first_valid ? 'valid' : 'invalid') . '.<br>';
        $ln_valid = 'The characters in your last name are ' . ($last_valid ? 'valid' : 'invalid') . '.<br>';
      //PASSWORD
        $pw_valid = 'Your password is ' . ($password_valid[0] ? 'an acceptable length!' : 'too short') . '.<br>';
        $pwc_valid = 'Your passwords ' . ($password_valid[1] ? 'matched' : "didn't match") . '.<br>';
  /*
    USER AWARENESS
  */
    if(!$email_valid || !$first_valid || !$last_valid || !$password_valid[0] || !$password_valid[1])
      $_SESSION['validation_messages'] = [$em_valid, $fn_valid, $ln_valid, $pw_valid, $pwc_valid];
    else
      $passed = true;
  /*
    SET VALID ELEMENTS TO DEFAULT VALUE IN <INPUT>
  */
    $_SESSION['valids'] = array();
    $_SESSION['valids'][0] = ($email_valid ? $_POST['email'] : '');
    $_SESSION['valids'][1] = ($first_valid ? $_POST['first_name'] : '');
    $_SESSION['valids'][2] = ($last_valid ? $_POST['last_name'] : '');
  }
  if($passed)
    header('Location: profile.php');
  else
    header('Location: index.php');
?>
