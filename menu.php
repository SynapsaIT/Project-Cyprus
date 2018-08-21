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
    <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.md5.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.js"></script>
  </head>
  <body>

<?php
session_start();
require_once 'config/conf.php';
require_once 'config/mysql.class.php';

if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
  header("Location: error.php");
}

if(isset($_POST['email'])){
  dbEmail($_POST['l'], $_POST['email']);
  echo '<script type="text/javascript">
    M.toast({html: "Copied!"});
  </script>
  ';
}

if(isset($_POST['logout'])){
  session_destroy();
  header("Location: index.php");
}
?>
<div class="kontener">
  <div class="banner" style="height: 12vh; width: 100%; display: inline-block; background-color: white; box-shadow: 1px 2px 30px 4px rgba(0,0,0,0.75);">
    <img src="tecomalogo.png" style="height: 12vh; padding: 5px; float: left;"/>
    <div class="right-align" style="padding: 20px">

      <form method=POST action="">
        <input type="hidden" name="logout" value="1"/>
        <span class="hide-on-small-only" style="font-size: 3vh; margin-right: 3vw;">Logged In as <b><?php echo $_SESSION['user'] ?></b></span>
        <button class="btn waves-effect waves-light" type="submit" name="action" style=" background-color: #021f47; height: 6vh;">Logout
          <i class="material-icons right">exit_to_app</i>
        </button>
      </form>
    </div>
  </div>

  <div class="row form" style="height:auto; width: 100vw; overflow:hidden;">
    <form class="col s12" style="" action="form.php" method="GET" ENCTYPE="multipart/form-data">
      <div class="row" style="">
        <div class="input-field col s12 m4">
          <select name="l" required>
            <option value="" disabled selected>Choose task</option>
            <?php
            $tsk = dbTsk();
            foreach($tsk as $rekord){
              echo '<option value="'.$rekord[0].'">';
              foreach(dbTskEmail($rekord[0]) as $rec){
                echo $rec[0].' '.'</option>';
              }
            }
            ?>
          </select>
          <div class="submit" style="padding: 10px; display: inline-block; height: auto; float: right;">
            <button class="btn waves-effect waves-light" type="submit" name="action" style="background-color: #3a77d2;">Submit
            <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
      </div>
    </form>
    <div class="row">
      <form method="POST" action="">
        <div class="email input-field inline col s12 m6">
          <input value="" name="email" id="email" type="email" class="validate" required/>
          <label class="active mail" for="email">Insert mail</label>
<?php
echo'
          <input type=hidden name="l" id="l" value="'.md5(time()).'"/>'
          ?>
          <div class="submit" style="padding: 10px; display: inline-block; height: auto; float: right;">
            <button class="btn waves-effect waves-light generate" type="submit" name="action" style="background-color: #3a77d2;">Generate and Copy
            <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php

function dbTsk(){
  global $db, $attachments_table;
  $sql = "SELECT DISTINCT group_id FROM $attachments_table";
  $result = $db->query($sql);
	while($row = $result -> fetch_array()){
	  $wynik[] = $row;
	}
  return $wynik;
}

function dbTskEmail($group){
  global $db, $emails_table;
  $sql = "SELECT email FROM $emails_table WHERE group_id='$group'";
  $result = $db->query($sql);
	while($row = $result -> fetch_array()){
	  $wynik[] = $row;
	}
  return $wynik;
}

function dbEmail($group, $email){
  global $db, $emails_table;
  $sql = "INSERT INTO $emails_table VALUES ('$group', '$email') ";
	$db->query($sql);
}

 ?>

 <script type="text/javascript">
   $('select').formSelect();
   $('.generate').click(function(){
     if(!$('#email').hasClass("invalid") && $('#email').val()!= ''){
       var $temp = $("<input>");
       $("body").append($temp);
       $temp.val("http://localhost/test.php?l="+$('#l').val()).select();
       document.execCommand("copy");
       $temp.remove();
     }
     else{
       $('#email').addClass("invalid");
     }
   });
   $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
  </script>
 </body>
</html>
