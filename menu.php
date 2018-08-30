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

if(isset($_POST['clstsk'])){
  clsTsk($_POST['clstsk']);
  echo '<script type="text/javascript">
    M.toast({html: "Task closed!"});
  </script>
  ';
}

if(isset($_POST['email'])){
  dbEmail($_POST['l'], $_POST['email'], $_SESSION['user']);
  echo '<script type="text/javascript">
    M.toast({html: "Copied!"});
  </script>
  ';
}

if(isset($_POST['logout'])){
  session_destroy();
  header("Location: index.php");
}

if(isset($_POST['grpid'])){
  changeUser($_POST['x'], $_POST['grpid']);
}

if(isset($_POST['oldpass'])){
  $old = sha1($_POST['oldpass']);
  $pass = changePassFind($_SESSION['user']);
  foreach($pass as $rekord){
    $pass = $rekord[0];
  }
  if($old == $pass && $_POST['newpass1'] == $_POST['newpass2']){
    $pcs = changePass($_SESSION['user'], sha1($_POST['newpass1']));
    if($pcs == "PCS"){
      echo '<script type="text/javascript">
        M.toast({html: "Password changed successfully!"});
      </script>
      ';
    }
  }
  else{
    echo '<script type="text/javascript">
      M.toast({html: "Old password does not match"});
    </script>
    ';
  }
}

?>
<div class="kontener row">
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
        <div class="modal-content" style="overflow:hidden;">
          <div class="modal-banner">
            <center><span align="center" style="font-size: 6vh; color: white;">Change<br/> Password</span></center>
          </div>
          <div class="changepass row" style="margin-top: 25px;">
            <form id="passwordchanger" class="center-align col s12" action="" method="POST" ENCTYPE="multipart/form-data">
              <div class="loginfield input-field col s12">
                <input type=password id="oldpass" name=oldpass class="validate" required/>
                <label for="oldpass">Current Password</label>
              </div>
              <div class="loginfield input-field col s12">
                <input type=password id="newpass1" name=newpass1 class="validate" required/>
                <label for="newpass1">New Password</label>
              </div>
              <div class="loginfield input-field col s12">
                <input type=password id="newpass2" name=newpass2 class="validate" required/>
                <label for="newpass2">Confirm New Password</label>
                <span class="helper-text" data-error="Password not match" data-success="Password Match"></span>
              </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="waves-effect waves-green btn-flat">Submit</button>
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
        </div>
        </form>
      </div>


      <div id="modal3" class="modal modal-fixed-footer hide-on-small-only">
        <div class="modal-content" style="">
          <div class="modal-banner">
            <center><span align="center" style="font-size: 6vh; color: white;">Change<br/> Password</span></center>
          </div>

          <form class="col s12" id="changeUsr" style="" action="menu.php" method="POST" ENCTYPE="multipart/form-data">
            <div class="row" style="">
              <div class="input-field col s12 m10">
                <select name="x" required>
                  <option value="" disabled selected>Choose user</option>
                  <?php
                    $usery = clsUsr();
                    foreach($usery as $rekord){
                      if($rekord[0] != $_SESSION['user']){
                        echo '<option value="'.$rekord[0].'">'.$rekord[0].'</option>';
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


        </div>
        <div class="modal-footer">
          <a href="#!" class="waves-effect waves-green btn-flat" onclick="document.getElementById('passwordchanger').submit()">Submit</>
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
        </div>
      </div>


  <div class="formx col s12 m6 left" style="height:auto; overflow:hidden;">
    <span style="font-size: 3vh;"><b>Choose your task</b></span>
    <form class="col s12" style="" action="form.php" method="GET" ENCTYPE="multipart/form-data">
      <div class="row" style="">
        <div class="input-field col s12 m10">
          <select name="l" required>
            <option value="" disabled selected>Choose task</option>
            <?php
              if(dbTskEmail($_SESSION['user']) != "n"){
                foreach(dbTskEmail($_SESSION['user']) as $rec){
                  echo '<option value="'.$rec[0].'">'.$rec[1].'</option>';
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
        <div class="email input-field inline col s12 m10">
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
  <div class="rightpanel col s5 right" style="height: 80vh; overflow: scroll">
    <div class="rightbanner"><b>My Tasks</b></div>
    <div class="rightcon">
      <?php
      if(dbTskEmail($_SESSION['user']) != "n"){
        foreach(dbTskEmail($_SESSION['user']) as $rec){
          echo '<div class="tasksdiv"><a class="taskslist2" href="form.php?l='.$rec[0].'"><div class="taskslist">';
          echo $rec[1].' '.'</div></a><i class="assign material-icons right" value='.$rec[0].'>edit</i></div>';
        }
      }
      ?>
    </div>
  </div>
</div>
<?php


function dbTskEmail($user){
  global $db, $emails_table;
  $sql = "SELECT group_id, email FROM $emails_table WHERE user='$user'";
  $result = $db->query($sql);
  if(mysqli_num_rows($result)===0){
    return "n";
  }
  else{
    while($row = $result -> fetch_array()){
  	  $wynik[] = $row;
  	}
    return $wynik;
  }
}

function dbEmail($group, $email, $user){
  global $db, $emails_table;
  $sql = "INSERT INTO $emails_table VALUES ('$group', '$email', '$user') ";
	$db->query($sql);
}

function clsTsk($grp){
  global $db, $attachments_table;
  $sql = "DELETE FROM $attachments_table WHERE group_id='$grp'";
	$db->query($sql);
}

function clsUsr(){
  global $db, $users_table;
  $sql = "SELECT username FROM $users_table";
  $result = $db->query($sql);
	while($row = $result -> fetch_array()){
	  $wynik[] = $row;
	}
  return $wynik;
}

function changeUser($user, $group){
  global $db, $emails_table;
  $sql = "UPDATE $emails_table SET user='$user' WHERE group_id='$group'";
	if($db->query($sql) === TRUE){
    echo '<script type="text/javascript">
      M.toast({html: "Task user has been changed!"});
    </script>
    ';
  }
}

function changePass($user, $pass){
  global $db, $users_table;
  $sql = "UPDATE $users_table SET password='$pass' WHERE username='$user'";
	if($db->query($sql) === TRUE){
    return "PCS";
  }
}

function changePassFind($user){
  global $db, $users_table;
  $sql = "SELECT password FROM $users_table WHERE username = '$user'";
  $result = $db->query($sql);
	while($row = $result -> fetch_array()){
	  $wynik[] = $row;
	}
  return $wynik;
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

   $('.assign').click(function(){
     $('#changeUsr').append('<input type="hidden" name="grpid" value="'+$(this).attr('value')+'"/>');
     $('.modal').modal();
     $('#modal3').modal('open');

   });
      $("#newpass1").on("focusout", function (e) {
        if ($(this).val() != $("#newpass2").val()) {
            $("#newpass2").removeClass("valid").addClass("invalid");
        } else {
            $("#newpass2").removeClass("invalid").addClass("valid");
        }
     });

      $("#newpass2").on("keyup", function (e) {
          if ($("#newpass1").val() != $(this).val()) {
              $(this).removeClass("valid").addClass("invalid");
          } else {
              $(this).removeClass("invalid").addClass("valid");
          }
      });


  </script>
 </body>
</html>
