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
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" placeholder="Upload one or more files">
        </div>


       <button class="btn waves-effect waves-light" type="submit" name="action">Submit
       <i class="material-icons right">send</i><br/>
       </button>
        <div id="xD" class="z-depth-2 file-field input-field" style="width:20vh; height:22vh; overflow: hidden"><input id="in" type="file" name="file[]" multiple accept="image/*" capture="capture"><img style="width: 100%; height: 22vh; object-fit: cover;" id="ph" class="materialboxed"/><i id="pc" class="material-icons responsive" style="margin-top:4vh; color:white;font-size:14vh;">add_a_photo</i></div>
      </form>
    </div>';




}




?>
</div>
  <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $('#xD').css('background-color', 'gray');
      $('.modal').modal();
      $('#modal1').modal('open');
      $('.materialboxed').materialbox();
      $('#ph').hide();



    });

    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#ph').attr('src', e.target.result);
                    $('#pc').hide();
                    $('#in').hide();
                    $('#xD').removeClass('file-field input-field');
                    //$('#ph').css('max-width', '100%', 'height', '100%');

                }
                $('#ph').show();
                reader.readAsDataURL(input.files[0]);
            }
        }


        $("#in").change(function(){
            readURL(this);
        });





  </script>

  </body>
</html>
