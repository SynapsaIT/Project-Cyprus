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

    <form class="center-align" action=pass.php'.'?l='.$l.' method="POST" ENCTYPE="multipart/form-data" style="margin:0 auto; width:50vh;">
    <div class="hide-on-large-only">
      <!-- Modal Structure -->
      <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content">
          <h4>Attention!</h4>
          <p>You are using a mobile device. If you want to send more than one photo you need to take pictures using your internal camera app.</p>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
      </div>
    </div>



     <div class="file-field input-field">
        <div class="btn">
          <span>Browse</span>
          <input type="file" name="file[]" multiple accept="image/*" capture="capture">
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




?>>
</div>
  <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $('.modal').modal();
      $('#modal1').modal('open');
    });


  </script>

  </body>
</html>
