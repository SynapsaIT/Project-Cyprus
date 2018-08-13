<!DOCTYPE html>
<html lang="en">
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.css"  media="screen,projection"/>
    <ling rel="stylesheet" type="text/css" href="css/main.css"/>


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
    <title>Test</title>
  </head>
  <body>
    <script type="text/javascript" src="jquery/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.js"></script>
<?php
  session_start();
  if(isset($_SESSION['user'])){
    header("Location: menu.php");
  }
  else{
    header("Location: login.php");
  }

 ?>
</div>

 <script type="text/javascript">

 </script>



   </body>
 </html>
