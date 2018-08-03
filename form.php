<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
    <title></title>
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
$att = dbRead($grp);
echo '
<div class="row form" style="background-color: green; height:100vh; overflow:hidden;">
  <form class="col s5" action="menu.php" method="POST" ENCTYPE="multipart/form-data">
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
        <select name="sex" required>
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
    <div class="submit col s12 center-align" style="padding: 10px; display: inline-block; height: auto;">
      <button class="btn waves-effect waves-light" type="submit" name="action">Submit
      <i class="material-icons right">send</i>
      </button>
    </div>
    <input type=hidden name=val />




  </form>

  <div class="col s7 slider" style="margin-top:1vh">
    <ul class="slides">';
  foreach($att as $rekord){
    echo "<li style=\"\"><img src='pass/".$rekord[1]."/".$rekord[0]."' class=\"img-responsive\"/></li>";
  }

echo '</ul></div>';


function dbRead($grp){
  global $db, $attachments_table;
  $sql = "SELECT filename, group_id FROM $attachments_table WHERE group_id='".$grp."'";
  $result = $db->query($sql);
	while($row = $result -> fetch_array()){
	  $wynik[] = $row;
	}
  return $wynik;
}

 ?>

 <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
 <script type="text/javascript" src="materialize/js/materialize.js"></script>
 <script type="text/javascript">
   $(document).ready(function(){
     $('.datepicker').datepicker();
     $('select').formSelect();
     $('.slider').slider({
       height: 450,
       width: 300
     });
     $('.slider').slider('pause');
     $('.indicator-item').on('click',function(){
       $('.slider').slider('pause');
     });
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
     $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});


  });
 </script>
</body>
</html>
