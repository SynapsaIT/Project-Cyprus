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

    <body class="row" style="background-color: grey;" style="margin: 0;">
      <div class="kontener" style="background-color: blue" style="width: 100%;">
        <div class="banner"><img src="tecomalogo.jpg" style="width:30%;"/> </div>

<?php

$l = $_GET['l'];
if(!isset($_POST['file'])){
  echo '
  <div class="form" style="background-color: green;">
    <form class="center-align" action=pass.php'.'?l='.$l.' method="POST" ENCTYPE="multipart/form-data" style="margin:0 auto; width:auto;">
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
        <div class="btn" style="width: 20%; height: 20%; margin: 0 auto;">
          <input type="file" name="file[]"  id="in" multiple accept="image/*" />
        </div>
        <!--<div class="file-path-wrapper">
          <input class="file-path validate" type="text" placeholder="Upload one or more files">
        </div>-->
<div class="submit" style="display: inline-block; height: auto;">
          <button class="btn waves-effect waves-light " type="submit" name="action">Submit
            <i class="material-icons right">send</i>
          </button>
          </div>

</div>
</form></div>';

}

?>
<div class="ph" style="background-color: red;"></div>
</div>
</div>


  <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $('#xD').css('background-color', 'gray');
      $('.modal').modal();
      $('#modal1').modal('open');
      $('.materialboxed').materialbox();

    });

    function readURL(input) {
            if (input.files) {
              for(var i=0; i<input.files.length; i++){
                console.log(i);
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.ph').append('<img class="materialboxed" src='+e.target.result+' style="width:20vh; height:22vh;padding: 5px; float: left; object-fit:cover;">');
                }
                reader.readAsDataURL(input.files[i]);

              }
              $('.materialboxed').materialbox();
            }

        }
        $("#in").change(function(){
            readURL(this);
        });









  </script>

  </body>
</html>
