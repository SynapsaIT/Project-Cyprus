<?php
  $link = md5(time());
  header("Location: test.php?l=".$link); /* Redirect browser */
  /* Make sure that code below does not get executed when we redirect. */
  exit;


//

 ?>
