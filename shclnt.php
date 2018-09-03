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

if(isset($_POST['logout'])){
  session_destroy();
  header("Location: index.php");
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
  <div class="banner" style="height: 12vh; width: 100%; display: inline-block; background-color: white; box-shadow: 1px 2px 30px 4px rgba(0,0,0,0.75);"><a href="index.php"><img src="tecomalogo.png" style="height: 12vh; padding: 5px; float: left;"/></a>


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
    </div>
    <table class="responsive-table highlight" style="margin-top: 10px;">
        <thead>
          <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Surname</th>
              <th>Passport</th>
              <th>Date of issue</th>
              <th>Date of expiry</th>
              <th>Sex</th>
              <th>Date of birth</th>
              <th>Place of birth</th>
              <?php
                if($_SESSION['user'] == 'kotlet'){
                  echo "<th>User</th>";
                }
               ?>
          </tr>
        </thead>

        <tbody>
          <?php
            $k = 0;
            if($_SESSION['user'] == 'kotlet'){
              echo sha1;
              if(shTable2() != "n"){
                foreach(shTable2() as $rekord){
                  if($rekord[6] == 0){
                    $rekord[6] = "Male";
                  }
                  else{
                    $rekord[6] = "Female";
                  }
                  echo '<tr><td>'.$k.'</td><td>'.$rekord[1].'</td><td>'.$rekord[2].'</td><td>'.$rekord[3].'</td><td>'.$rekord[4].'</td><td>'.$rekord[5].'</td><td>'.$rekord[6].'</td><td>'.$rekord[7].'</td><td>'.$rekord[8].'</td><td>'.$rekord[9].'</td></tr>';
                  $k++;
                }
              }
            }
            else{
              if(shTable($_SESSION['user']) != "n"){
                foreach(shTable($_SESSION['user']) as $rekord){
                  if($rekord[6] == 0){
                    $rekord[6] = "Male";
                  }
                  else{
                    $rekord[6] = "Female";
                  }
                  echo '<tr><td>'.$k.'</td><td>'.$rekord[1].'</td><td>'.$rekord[2].'</td><td>'.$rekord[3].'</td><td>'.$rekord[4].'</td><td>'.$rekord[5].'</td><td>'.$rekord[6].'</td><td>'.$rekord[7].'</td><td>'.$rekord[8].'</td></tr>';
                  $k++;
                }
              }
            }


           ?>
        </tbody>
      </table>
  </div>
</div>


<?php
function clsUsr(){
  global $db, $users_table;
  $sql = "SELECT username FROM $users_table";
  $result = $db->query($sql);
	while($row = $result -> fetch_array()){
	  $wynik[] = $row;
	}
  return $wynik;
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

function shTable($user){
  global $db, $personaldata_table;
  $sql = "SELECT * FROM $personaldata_table WHERE input_usr='$user'";
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

function shTable2(){
  global $db, $personaldata_table;
  $sql = "SELECT * FROM $personaldata_table";
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
 ?>


      <script type="text/javascript">
        $('select').formSelect();
        $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
        $('.dropdown-trigger').dropdown();


        $('#passwd').click(function(){
          $('.modal').modal();
          $('#modal2').modal('open');
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
