<!DOCTYPE html>
<html lang="en">
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
    <title>Test</title>
  </head>
  <body>

<?php
  require_once 'config/conf.php';
  require_once 'config/mysql.class.php';
  echo '
  <div class="form row" style="background-color: green; width:33vw; height:40vh; margin: 0 auto;">
    <form class="center-align col s12" action="" method="POST" ENCTYPE="multipart/form-data">
      <div class="row">
        <div class="input-field col s6">
          <input type=text id="login" name=log class="validate"/>
          <label for="login">Login</label>
        </div>
        <div class="input-field col s6">
          <input type=password id="password" name=pas class="validate"/>
          <label for="password">Password</label>
        </div>
      </div>
      <div class="submit" style="padding: 10px; display: inline-block; height: auto;">
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
        </button>
      </div>




    </form>

  ';
  if(isset($_POST['log']) || isset($_POST['pas'])){
    $wyniki = login($_POST['log']);
    foreach($wyniki as $rekord){
      $test = sha1($_POST['pas']);
      if($rekord[0] == $_POST['log'] && $rekord[1] == $test){
        session_start();
        $_SESSION["user"]=$rekord[0];
        header("Location: menu.php");
      }
      elseif($rekord[0] == "IU"){
        echo "Invalid username";
        break;
      }
      else{
        echo "Ełoł";
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
 <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
 <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
 <script type="text/javascript">

 </script>



   </body>
 </html>
