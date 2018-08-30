<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href="css/main.css"/>
      <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="materialize/js/materialize.js"></script>
    </head>
    <?php

    $l = $_GET['l'];
    if(isset($_GET['t'])){
      if($_GET['t'] == 't'){
        echo '<script type="text/javascript">
        $(document).ready(function(){
          $(".hide-on-large-only").hide();
          $(".hide-on-med-and-down").hide();
          $("#formupl").append("<center><div class=\"z-depth-5\" style=\"margin-top:30vh; background-color:white; width:40vw; padding-bottom:1px;\"><h1>Uploaded Succesfully!</h1></div></center>");
        });
        </script>';
      }
      if($_GET['t'] == 'f'){
        echo '<script type="text/javascript">
        $(document).ready(function(){
          $(".hide-on-large-only").hide();
          $(".hide-on-med-and-down").hide();
          $("#formupl").append("<center><div class=\"z-depth-5\" style=\"margin-top:30vh; background-color:white; width:40vw; padding-bottom:1px;\"><h1>Your pictures have already been sent!</h1></div></center>");
        });
        </script>';
      }
    }
    if(!isset($_POST['file'])){
    ?>
    <body class="row">
      <div class="kontener" style="background-image: url('backo.png'); background-size: cover; height: 100vh;">
        <div class="banner" style="height: 12vh; width: 100%; display: inline-block; background-color: white; box-shadow: 1px 2px 30px 4px rgba(0,0,0,0.75);"><img src="tecomalogo.png" style="height: 12vh; padding: 5px;"/> </div>
    <?php echo'<form class="center-align" id="formupl" action=pass.php'.'?l='.$l.' method="POST" ENCTYPE="multipart/form-data" style="">'; ?>

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

    <!-- MOBILE SECTION -->

    <div class="mobile" style="width: 100vw; height: auto;">
      <div style="width: 50vw; height: 100vh; margin: 0 auto;">
        <div class="file-field input-field uploader" style="background-color: white; height:20vh; width: 50vw; border: 2px solid black; border-radius: 25px; float: left; margin-top: 15vh; box-shadow: 1px 2px 10px 6px rgba(0,0,0,0.75);">
          <div class="icon" style="height: 20vh; width: 50vw; margin: 0 auto; text-align: center;">
            <i class="material-icons" style="font-size: 15vh; color: #3a77d2;margin-top: 2vh; ">add_a_photo</i>
          </div>
          <input type="file" name="file[]"  id="in" multiple accept="image/*" />
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="action" style="background-color: white; height:20vh; width: 50vw; border: 2px solid black; border-radius: 25px; margin-top: 15vh; box-shadow: 1px 2px 10px 6px rgba(0,0,0,0.75);">
          <div class="icon" style="height: 20vh; width: 50vw; margin: 0 auto; text-align: center;">
            <i class="material-icons" style="height: auto; font-size: 15vh; color: #3a77d2; margin-left: -20px;margin-top: 7vh;">send</i>
          </div>
        </button>
      </div>
    </div>
  </div>

  <div class="hide-on-med-and-down formx" style="position: absolute; height: auto; width: 100vw; top: 14vh;">
  <img id="up1" src="1.png" alt="send" style="width: 25vw; margin-top: 57vh; float: left; margin-left: 8vw;"/>
  <img id="send1" src="2.png" alt="send" style="width: 22vw; float: right; margin-right: 8vw; margin-bottom: 80vh;"/>
    <div style="width: 40vw; height: 75vh; margin: 0 auto; margin-top: 5vh;">
      <div class="file-field input-field uploader" style="background-color: white; height:40vh; width: 15vw; border: 2px solid black; border-radius: 25px; float: left; margin-top: 15vh; box-shadow: 1px 2px 10px 6px rgba(0,0,0,0.75);">
        <div class="icon" style="margin-top: 10vh; display: inline-block;">
          <i class="material-icons" style="font-size: 20vh; color: #3a77d2;">add_a_photo</i>
        </div>
        <input type="file" name="file[]"  id="in2" multiple accept="image/*" />
      </div>

      <button class="btn waves-effect waves-light" type="submit" name="action" style="background-color: white; margin-top: 15px; height:40vh; width: 15vw; border: 2px solid black; border-radius: 25px; float: right; margin-top: 15vh; box-shadow: 1px 2px 10px 6px rgba(0,0,0,0.75);">
        <div class="icon" style="display: inline-block; margin-top: 10vh;">
          <i class="material-icons" style="font-size: 18vh; color: #3a77d2;">send</i>
        </div>
      </button>
    </div>
</form>

</div>

<?php

}

?>

</div>
<div id="ph" class="center-align" style="margin-top: 100vh; width:80vw; height:auto; margin: 0 auto;"></div>




  <script type="text/javascript">

    $(document).ready(function(){
      $('.modal').modal();
      $('#modal1').modal('open');
      $('')
    });

    function readURL(input) {
            if (input.files) {
              var z=0;
              for(var i=0; i<input.files.length; i++){
                console.log(i);
                var reader = new FileReader();
                reader.onload = function(e) {
                  $('#ph').append('<div class="imgs center-align" style="float:left;"><img class="materialboxed" src='+e.target.result+' style="max-width: 50%; padding: 5px; float: left; object-fit:cover;"></div>');
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
        $("#in2").change(function(){
            readURL(this);
        });
        $("#in2").click(function(){
          $('.imgs').remove();
        });
        $("#in").change(function(){
            readURL(this);
        });
        $("#in").click(function(){
          $('.imgs').remove();
        });

  </script>

  </body>
</html>
