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
        <div class="banner"><img src="tecomalogo.jpg" style="width:25%;"/> </div>
<?php

$l = $_GET['l'];
if(!isset($_POST['file'])){
  echo '
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


  <div class="form" style="background-color: green; height: 44vh; width: 55vw; margin: 0 auto; margin-top: 15vh;">
    <form class="center-align" action=pass.php'.'?l='.$l.' method="POST" ENCTYPE="multipart/form-data" style="">


    <div class="file-field input-field uploader" style="position: relative; background-color: aqua; height:40vh; width: 30vh; border: 2px solid black; border-radius: 25px; float: left;">
      <div class="icon" style="height: 40vh; padding-top: 30%"> <i class="material-icons" style="font-size: 8rem;">add_a_photo</i></div>
          <input type="file" name="file[]"  id="in" multiple accept="image/*" />
    </div>

      <button class="btn waves-effect waves-light" type="submit" name="action" style="margin-top: 15px; background-color: aqua; height:40vh; width: 30vh; border: 2px solid black; border-radius: 25px; position: relative; float: right;">
      </button>


</form></div>';

}

?>
<div class="ph center-align" style="width:60vh ;height:auto; background-color: red; margin:0 auto;"></div>
</div>
</div>


  <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $('#xD').css('background-color', 'gray');
      $('.modal').modal();
      $('#modal1').modal('open');

    });

    function readURL(input) {
            if (input.files) {
              var z=0;
              for(var i=0; i<input.files.length; i++){
                console.log(i);
                var reader = new FileReader();
                reader.onload = function (e) {
                  $('.ph').append('<div class="imgs center-align" style="width:20vh; height:22vh;float:left;"><img class="materialboxed" src='+e.target.result+' style="width:20vh; height:22vh;padding: 5px; float: left; object-fit:cover;"></div>');
                  if(z==input.files.length-1){
                    $('.materialboxed').materialbox();
                    $('body').css('overflow-y','scroll');
                  }
                  z++;
                }
                reader.readAsDataURL(input.files[i]);
              }
            }

        }
        $("#in").change(function(){
            readURL(this);
        });
        $("#in").click(function(){
          $('.imgs').remove();
        });

  </script>

  </body>
</html>
