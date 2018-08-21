<!DOCTYPE html>
<html lang="en">
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
    <title>Test</title>
  </head>
  <body>
    <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.js"></script>
<?php
  session_start();
  require_once 'config/conf.php';
  require_once 'config/mysql.class.php';
  ?>
  <div class="form row">
    <img id="logo" src="tecomalogo.png"/>
    <form class="center-align col s12" action="" method="POST" ENCTYPE="multipart/form-data">
      <div class="row">
        <div class="loginfield input-field col s12">
          <input type=text id="login" name=log class="validate" required/>
          <label for="login">Login</label>
        </div>
        <div class="loginfield input-field col s12">
          <input type=password id="password" name=pas class="validate" required/>
          <label for="password">Password</label>
        </div>
      </div>
      <div class="submit">
        <button class="btn waves-effect waves-light logout" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
<?php
  if(isset($_POST['log']) || isset($_POST['pas'])){
    $wyniki = login($_POST['log']);
    foreach($wyniki as $rekord){
      $pass = sha1($_POST['pas']);
      if($rekord[0] == $_POST['log'] && $rekord[1] == $pass){
        session_start();
        $_SESSION["user"]=$rekord[0];
        header("Location: menu.php");
      }
      if ($rekord[0] != $_POST['log']) {
        echo"
          <script type='text/javascript'>
            $('#login').addClass('invalid');
            $('#login').after('<span class=\"helper-text\" data-error=\"Wrong username\"></span>');
          </script>
        ";
      }
      if ($rekord[1] != $pass) {
        echo'
          <script type="text/javascript">
            $("#password").addClass("invalid");
          </script>
        ';
      }
    }
  }



function login($user){
  global $db, $users_table;
  $sql = "SELECT username, password FROM $users_table WHERE username='".$user."'";
  $result = $db->query($sql);
	while($row = $result -> fetch_array()){
	  $wynik[] = $row;
	}
  if(isset($wynik)){
    return $wynik;
  }
  else {
    $wynik[0] = "IU";
    return $wynik;
  }
}

 ?>
</div>

 <script type="text/javascript">

 </script>



   </body>
 </html>
