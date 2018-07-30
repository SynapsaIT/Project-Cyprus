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
if(isset($_POST['val'])){
  dbWrite($_POST['name'], $_POST['surname'], $_POST['sex'], $_POST['dob'], $_POST['pob'], $_POST['passport'], $_POST['doi'], $_POST['doe']);
}
echo '
<div class="row form" style="background-color: green; height:100vh; width: 50vw; overflow:hidden;">
  <form class="col s10" style="margin: 0 auto;" action="form.php" method="POST" ENCTYPE="multipart/form-data">
    <div class="row" style="margin: 0 auto;">
      <div class="input-field col s6">
        <select name="grp">
          <option value="" disabled selected>Choose task</option>';
          $tsk = dbTsk();
          foreach($tsk as $rekord){
            echo '<option value="'.$rekord[0].'">'.$rekord[0].'</option>';
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
    <div class="input-field inline col s6">
      <input value="Alvin" id="link_inline" type="text" class="validate">
      <label class="active" for="link_inline">First Name</label>
      <div class="submit" style="padding: 10px; display: inline-block; height: auto;">
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
        </button>
      </div>
    </div>
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

function dbWrite($name, $surname, $sex, $dob, $pob, $passport, $doi, $doe){
  global $db, $personaldata_table;
  $sql = "INSERT INTO $personaldata_table VALUES (NULL, '$name', '$surname', '$passport', DATE '$doi', DATE'$doe', $sex, DATE '$dob', '$pob')";
  if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
  }
  else{
    echo "nope";
  }
}

 ?>
 <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
 <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
 <script type="text/javascript">
   $('select').formSelect();
   $('select').material_select();
 </script>
 </body>
</html>
