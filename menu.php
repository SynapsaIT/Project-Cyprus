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
  <div class="banner" style="position: relative; height: 12vh; width: 100%; display: inline-block; background-color: white; box-shadow: 1px 2px 30px 4px rgba(0,0,0,0.75);">
    <img src="tecomalogo.png" style="height: 12vh; padding: 5px; float: left;"/>

    <!-- <ul constrainWidth="false" id="dropdown1" class="dropdown-content" style="">

      <li><a href="https://www.facebook.com">TAK</a></li>
    </ul>

    <a class="dropdown-trigger" href="#" data-target="dropdown1"><div class="right-align dropdown-trigger" href="#!" data-target="dropdown1" style="display: table; width: auto; height: 12vh; float: right; background-color: red;">
<span class="hide-on-small-only" style="font-size: 3vh; display: table-cell; vertical-align: middle;">Logged In as <b><?php echo $_SESSION['user'] ?></b></span> <i class="material-icons" style="font-size: 5vh; padding-top: 5vh; position: relative; padding-top: 3.2vh;background-color: blue;">keyboard_arrow_down </i>
    </div></a>

  </div> -->
  <form id="log" method=POST action="">
    <input type="hidden" name="logout" value="1"/>
  </form>

  <ul id="dropdown1" class="dropdown-content">
    <li class="hide-on-small-only"><a id="passwd" href="#!">Change password <i class="material-icons right">lock</i></a></li>
    <li class="divider"></li>
    <li><a data-constrainwidth="false" href="#" onclick="document.getElementById('log').submit()">Logout<i class="material-icons right">exit_to_app</i></a></li>
  </ul>
  <nav style="height: 12vh;">
    <div class="tak">
      <ul class="right">
        <!-- Dropdown Trigger -->
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1" style="height: 12vh; color: black; font-size: 3vh; display: table-cell; vertical-align: middle;"><span class="hide-on-small-only" >Logged In as <b><?php echo $_SESSION['user'] ?></b></span><i class="material-icons right" style="margin-left: -5px;font-size: 6vh;">arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>

  <div class="">
      <!-- Modal Structure -->
      <div id="modal2" class="modal modal-fixed-footer hide-on-small-only">
        <div class="modal-content" style="">
          <div class="modal-banner">
            <center><span align="center" style="font-size: 6vh; color: white;">Change<br/> Password</span></center>
          </div>
          <div class="changepass row" style="margin-top: 25px;">
            <form id="passwordchanger" class="center-align col s12" action="" method="POST" ENCTYPE="multipart/form-data">
              <div class="loginfield input-field col s12">
                <input type=password id="oldpass" name=oldpass class="validate" required/>
                <label for="password">Current Password</label>
              </div>
              <div class="loginfield input-field col s12">
                <input type=password id="newpass1" name=newpass1 class="validate" required/>
                <label for="password">New Password</label>
              </div>
              <div class="loginfield input-field col s12">
                <input type=password id="newpass2" name=newpass2 class="validate" required/>
                <label for="password">Confirm New Password</label>
              </div>
            </form>
          </div>

        </div>
        <div class="modal-footer">
          <a href="#!" class="waves-effect waves-green btn-flat" onclick="document.getElementById('passwordchanger').submit()">Submit</>
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
        </div>
      </div>
      <?php
        $oldpass = $_POST['oldpass'];
        $newpass1 = $_POST['newpass1'];
        $newpass2 = $_POST['newpass2'];
       ?>


  <div class="row form" style="height:auto; width: 100vw; overflow:hidden;">
    <span style="padding-left: 10px; font-size: 3vh;"><b>Choose your task</b></span>
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
      <span style="padding-left: 10px; font-size: 3vh;"><b>Generate link for Client</b></span>
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
   $('.dropdown-trigger').dropdown();


   $('#passwd').click(function(){
     $('.modal').modal();
     $('#modal2').modal('open');
   });
  </script>
 </body>
</html>
