<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <div class="container">



<?php

$l = $_GET['l'];
if(!isset($_POST['file'])){
  echo '
    <form action=pass.php'.'?l='.$l.' method="POST" ENCTYPE="multipart/form-data">

     <div class="file-field input-field">
        <div class="btn">
          <span>File</span>
          <input type="file" name="file[]" multiple accept="image/*">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" placeholder="Upload one or more files">
        </div>
      </div>

     <button class="btn waves-effect waves-light" type="submit" name="action">Submit
     <i class="material-icons right">send</i>
     </button>

    </form>';
}




?>
</div>
  <script type="text/javascript" src="materialize/js/materialize.min.js"></script>

  </body>
</html>
