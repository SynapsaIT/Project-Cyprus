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
    <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.md5.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.js"></script>
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

if(isset($_POST['val'])){
  dbWrite($_POST['name'], $_POST['surname'], $_POST['sex'], $_POST['dob'], $_POST['pob'], $_POST['passport'], $_POST['doi'], $_POST['doe'], $_SESSION['user']);
}

echo '
<div class="row form" style="background-color: green; height:100vh; width: 50vw; overflow:hidden;">
  <div class="row" style="float:right;">
    <form method=POST action="">
      <input type="hidden" name="logout" value="1"/>
      <button class="btn waves-effect waves-light" type="submit" name="action">Logout
        <i class="material-icons right">exit_to_app</i>
      </button>
    </form>
  </div>
  <form class="col s10" style="margin: 0 auto;" action="form.php" method="GET" ENCTYPE="multipart/form-data">
    <div class="row" style="margin: 0 auto;">
      <div class="input-field col s6">
        <select name="l" required>
          <option value="" disabled selected>Choose task</option>';
          $tsk = dbTsk();
          foreach($tsk as $rekord){
            echo '<option value="'.$rekord[0].'">';
            foreach(dbTskEmail($rekord[0]) as $rec){
              echo $rec[0].' '.'</option>';
            }
          }

echo'
        </select>
        <div class="submit col s6 style="padding: 10px; display: inline-block; height: auto;">
          <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
    </div>
  </form>
  <div class="row">
    <form method="POST" action="">
      <div class="input-field inline col s6">
        <input value="" name="email" id="email" type="email" class="validate" required/>
        <label class="active" for="email">Insert mail</label>
        <input type=hidden name="l" id="l" value="'.md5(time()).'"/>
        <div class="generate" style="padding: 10px; display: inline-block; height: auto;">
          <button class="btn waves-effect waves-light" type="submit" name="action">Generate and copy
          <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

';

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

function dbWrite($name, $surname, $sex, $dob, $pob, $passport, $doi, $doe, $iu){
  global $db, $personaldata_table;
  $sql = "INSERT INTO $personaldata_table VALUES (NULL, '$name', '$surname', '$passport', DATE '$doi', DATE'$doe', $sex, DATE '$dob', '$pob', '$iu')";
  if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
  }
  else{
    echo "nope";
  }
}

 ?>

 <script type="text/javascript">
   $('select').formSelect();
   $('.generate').click(function(){
     if(!$('#email').hasClass("invalid") && $('#email').val()!= ''){
       var $temp = $("<input>");
       $("body").append($temp);
       $temp.val("http://192.168.169.149/Project-Cyprus/test.php?l="+$('#l').val()).select();
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
