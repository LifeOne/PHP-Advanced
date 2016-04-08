<?php
  session_start();
  session_destroy();
?>
<html>
  <body>
    <p> OMG HEY, WELCOME BACK! </p>
    <form action='index.php'>
      <input type='submit' value='Goto Login'>
    </form>
  </body>
</html>
