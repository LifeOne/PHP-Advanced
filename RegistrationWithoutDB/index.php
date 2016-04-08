<?php
session_start();
  $auto = (isset($_SESSION['valids']) ? true : false);
?>
<!DOCTYPE html>
<html lang='en-US'>
  <head>
    <meta charset="utf-8">
    <title>Register | abc.xyz</title>
    <style>
      * {
        padding: 0;
        margin: 0;
      }
      #wrapper {
        width: 800px;
        margin: 0px auto;
      }
      form {
        border: 1px solid black;
        width: 500px;
        margin: 25px auto;

      }
      span {
        display: block;
        font-size: 18px;
        margin-left: 25px;
        margin-bottom: 15px;
      }
      input {
        float: right;
        margin: 2px 20px 0 0;
      }
      #submit input {
        float: none;
      }
      #submit {
        text-align: center;
      }
      #error-log {
        text-align: center;
        width: 300px;
        margin: 25px auto;
        font-size: 16px;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <form action="process.php" method="post">
        <input type='hidden' name='id' value='registrar'>
        <span>Email: <input type='text' name='email' value="<?php if($auto) { echo $_SESSION['valids'][0];}?>"></span>
        <span>First Name: <input type ='text' name='first_name' value="<?php if($auto) { echo $_SESSION['valids'][1];}?>"></span>
        <span>Last Name: <input type ='text' name='last_name' value="<?php if($auto) { echo $_SESSION['valids'][2];}?>"></span>
        <span>Password: <input type ='password' name='password'></span>
        <span>Confirm Password: <input type ='password' name='password-confirm'></span>
        <span id="submit"><input type='submit'></span>
        <!-- <span>Birthday: <input type ='date' name='birthday'></span> -->
      </form>
      <?php if(isset($_SESSION['validation_messages'])) {?>
        <div id='error-log'>
          <?php $dump = $_SESSION['validation_messages'];
          foreach($dump as $log) {
            echo '<p>' . $log . '</p>';
          }?>
        </div>
      <?php
        }
      ?>
    </div>
  </body>
</html>
<?php
session_destroy();
 ?>
