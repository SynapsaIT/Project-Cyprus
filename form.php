<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>

    <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="jquery/jQueryRotate.js"></script>
    <script type="text/javascript" src="jquery/jquery.elevatezoom.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>



    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
    <title></title>
    <script type="text/javascript" src='jquery/jquery.slides.min.js'></script>
  </head>
  <body>


<?php
require_once 'config/conf.php';
require_once 'config/mysql.class.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
  header("Location: error.php");
}

if(isset($_GET['l'])){
  $grp = $_GET['l'];
}

if(isset($_POST['logout'])){
  session_destroy();
  header("Location: index.php");
}

if(isset($_POST['is'])){
  dbWrite($grp, $_POST['name'], $_POST['surname'], $_POST['sex'], $_POST['dob'], $_POST['pob'], $_POST['passport'], $_POST['doi'], $_POST['doe'], $_SESSION['user']);
}

$att = dbRead($grp);

?>
<div class="kontener">
  <div class="banner" style="height: 12vh; width: 100%; display: inline-block; background-color: white; box-shadow: 1px 2px 30px 4px rgba(0,0,0,0.75);"><a href="index.php"><img src="tecomalogo.png" style="height: 12vh; padding: 5px; float: left;"/></a>
    <form id="log" method=POST action="">
      <input type="hidden" name="logout" value="1"/>
    </form>

    <ul id="dropdown1" class="dropdown-content">
      <li id="passwd"><a href="#!">Change password <i class="material-icons right">lock</i></a></li>
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
  </div>
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
<div class="row formz" style="height:100vh; overflow:hidden; padding-top: 5vh;">
<div class="col s5 apnd">
  <form action="" method="POST" ENCTYPE="multipart/form-data" id="mform">

  <div id="all">
      <div class="row">
        <div class="input-field col s6">
          <input type=text id="name" name="name" class="validate" required/>
          <label for="name">Name</label>
        </div>
        <div class="input-field col s6">
          <input type="text" id="surname" name=surname class="validate" required/>
          <label for="surname">Surname</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4">
          <input type="text" id="dob" name="dob" class="datepicker" required/>
          <label for="dob">Date of birth</label>
        </div>
        <div class="input-field col s4">
          <input type="text" id="pob" name="pob" class="validate" required/>
          <label for="pob">Place of birth</label>
        </div>
        <div class="input-field col s4">
          <select name="sex" id="sex" required>
            <option value="" disabled selected>Choose sex</option>
            <option value="0">Male</option>
            <option value="1">Female</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type=text id="passport" name="passport" class="validate" required/>
          <label for="passport">Passport (or id) number</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input type="text" id="doi" name="doi" class="datepicker" required/>
          <label for="doi">Date of issue</label>
        </div>
        <div class="input-field col s6">
          <input type="text" id="doe" name="doe" class="datepicker" required/>
          <label for="doe">Date of expiry</label>
        </div>
      </div>
    </div>
    <input type="hidden" name="is"/>
    <div class="submit col s12 center-align" style="padding: 10px; display: inline-block; height: auto;"><button class="btn waves-effect waves-light" type="submit" name="action" style="background-color: #3a77d2;">Submit<i class="material-icons right">send</i></button></div>
  </form>
  <form method="POST" action="menu.php">
    <input type=hidden name=clstsk value="<?php echo"$grp"; ?>" />
    <div class="submit col s12 center-align" style="padding: 10px; display: inline-block; height: auto;"><button class="btn waves-effect waves-light" type="submit" name="action" onclick="return confirm('Are you sure you would like close this ticket and delete all pictures?');" style="background-color: #3a77d2;">Close task<i class="material-icons right">send</i></button></div>
  </form>
</div>
  <div id="slides" class="col s7" style="margin-top:1vh;">
        <?php
    foreach($att as $rekord){
      echo "<img src='pass/".$rekord[1]."/".$rekord[0]."' class=\"imaga\" style=\"max-width: 100%; max-height: 100%;\"/>";
    }
    ?>


</div>
<script type="text/javascript" src="jquery/jquery.slides.min.js"></script>
<script>
function slide(){
  $("#slides").slidesjs({
    width: 100,
    height: 56,
    effect:{
      fade:{
        speed: 500
      }
    },
    navigation: {
      active: true,
      effect: "fade"
    },
  });
};
</script>
<script>slide();</script>
<button class="btn waves-effect waves-light" type="submit" id="b1" style="background-color: #3a77d2;">
  <i class="material-icons">rotate_left</i>
</button>
<button class="btn waves-effect waves-light" type="submit" id="b2" style="background-color: #3a77d2;">
  <i class="material-icons">rotate_right</i>
</button>
<div class="row col s12">
<?php
$taa = dbCRead($grp);
if(!empty($taa)){
  foreach($taa as $rekord){
    echo $rekord[0].". ".$rekord[1]." ".$rekord[2]." ".$rekord[3]."</br>";
  }
}
 ?>
</div>
</div>
<?php

function dbRead($grp){
  global $db, $attachments_table;
  $sql = "SELECT filename, group_id FROM $attachments_table WHERE group_id='".$grp."'";
  $result = $db->query($sql);
	while($row = $result -> fetch_array()){
	  $wynik[] = $row;
	}
  return $wynik;
}
function dbCreate($id){
  global $db;
  $id = "l".$id;
  $query = "SELECT ID FROM $id";
  $result = $db->query($query);
  if(empty($result)){
    $sql = "CREATE TABLE ".$id." (
      ID int(10) AUTO_INCREMENT PRIMARY KEY,
      name varchar(64),
      surname varchar(64),
      passport varchar(28)
    )";
  	$db->query($sql);
  }
}
function dbCWrite($id, $name, $surname, $passport){
  global $db;
  $id = "l".$id;
  $sql = "INSERT INTO $id VALUES (NULL, '$name', '$surname', '$passport')";
  $db->query($sql);
}
function dbCRead($id){
  global $db;
  $id = "l".$id;
  $sql = "SELECT * FROM $id";
  $result = $db->query($sql);
  if(!empty($result)){
    while($row = $result -> fetch_array()){
  	  $wynik[] = $row;
  	}
    return $wynik;
  }
}

function dbWrite($grp, $name, $surname, $sex, $dob, $pob, $passport, $doi, $doe, $iu){
  global $db, $personaldata_table;
  $sql = "INSERT INTO $personaldata_table VALUES (NULL, '$name', '$surname', '$passport', DATE '$doi', DATE'$doe', $sex, DATE '$dob', '$pob', '$iu')";
  if ($db->query($sql) === TRUE) {
    echo '<script type="text/javascript">
      M.toast({html: "Uploaded to Database"});
    </script>';
    dbCreate($grp);
    dbCWrite($grp, $_POST['name'], $_POST['surname'], $_POST['passport']);
  }
  else{
    echo '<script type="text/javascript">
      M.toast({html: "Error, something went wrong"});
    </script>';
  }
}

 ?>


 <script type="text/javascript">

   $(document).ready(function(){


     // $("#next").hide();
     // $("#prev").hide();
     // $("#all").hide();
     $('.datepicker').datepicker();
     $('#doe').prop('disabled', true);
     $('#doi').change(function(){
       $('#doe').prop('disabled', false);
       var Data = new Date($('#doi').val());
       $('#doe').datepicker({minDate: Data});
     });
     $('select').formSelect();
     // $('.slider').slider({
     //   height: 450,
     //   full_width: true
     // });
     // $('.slider').slider('pause');
     // $('.indicator-item').on('click',function(){
     //   $('.slider').slider('pause');
     // });
     $(document).keydown(function(e) {
      switch(e.which) {
          case 37: // left
            $('.slider').slider('prev');
            $('.slider').slider('pause');
          break;
          case 39: // right
            $('.slider').slider('next');
            $('.slider').slider('pause');
          break;
          default: return; // exit this handler for other keys
      }
     });
    $(".imaga").css({"object-fit":"scale-down"});
     // $(".imaga").elevateZoom({
     //   zoomWindowPosition: 9,
     //   responsive: true,
     //   tint: true
     // });
     $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
     var value = 0;
      $("#b1").rotate({
        bind:
        {
          click: function(){
            value -=90;
            $(".imaga").rotate({ animateTo:value})
          }
        }
      });
      $("#b2").rotate({
        bind:
        {
          click: function(){
            value +=90;
            $(".imaga").rotate({ animateTo:value})
          }
        }
      });

      // $("#pval").click(function(){
      //   tyt = $("#test5").val();
      //   if(tyt>1){
      //     $(".frange").hide()
      //     $("#all").show();
      //     $("#prev").append("<div class=\"col s12 center-align\" style=\"padding: 10px; display: inline-block; height: auto;\"><button class=\"btn waves-effect waves-light\" id=\"prev\">Prev<i class=\"material-icons right\">send</i></button></div>");
      //     $("#prev").hide();
      //     $("#next").show();
      //   }
      //   else {
      //     $(".frange").hide()
      //     $("#mform").append("<div class=\"col s12 center-align\" style=\"padding: 10px; display: inline-block; height: auto;\"><button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Submit<i class=\"material-icons right\">send</i></button></div>");
      //     $("#all").show();
      //   }
      // });
      // var cnt = 0;
      // $("#next").click(function(){
      //   tab = tablica_dwuwymiarowa(tyt);
      //   if(!tab[cnt+1]['name']){
      //     tab[cnt]['name'] = $("#name").val();
      //     tab[cnt]['surname'] = $("#surname").val();
      //     tab[cnt]['dob'] = $("#dob").val();
      //     tab[cnt]['pob'] = $("#pob").val();
      //     tab[cnt]['sex'] = $("#sex").val();
      //     tab[cnt]['passport'] = $("#passport").val();
      //     tab[cnt]['doi'] = $("#doi").val();
      //     tab[cnt]['doe'] = $("#doe").val();
      //     $('#mform')[0].reset();
      //     $("#prev").show();
      //     cnt++;
      //   }
      // });
      // $("#prev").click(function(){
      //   $("#name").val("dupa");
      //   $("#surname").val(tab[cnt]['surname']);
      //   $("#dob").val(tab[cnt]['dob']);
      //   $("#pob").val(tab[cnt]['pob']);
      //   $("#sex").val(tab[cnt]['sex']);
      //   $("#passport").val(tab[cnt]['passport']);
      //   $("#doi").val(tab[cnt]['doi']);
      //   $("#doe").val(tab[cnt]['doe']);
      // });
      var im=$(".imaga");
      //$(".imaga").css({"background-size": "contain", "background-repeat": "no-repeat"});
      //$(im).css({"width": im.height()});

  });

  function tablica_dwuwymiarowa(liczba_wierszy) {
    var tab = new Array(liczba_wierszy);
    for (var i = 0; i < liczba_wierszy; i++) {
      tab[i] = [];
    }
    return tab;
  }
  $('.dropdown-trigger').dropdown();
  $('#passwd').click(function(){
    $('.modal').modal();
    $('#modal2').modal('open');
  });
 </script>


</div>
</body>
</html>
