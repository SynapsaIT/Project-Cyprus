<?php
require_once 'config/conf.php';
require_once 'config/mysql.class.php';
$l = $_GET['l'];
$dir = 'pass/'.$l;
if (!file_exists($dir) && !is_dir($dir)) {
  $max_rozmiar = 10240*10240;
  $total = count($_FILES['file']['name']);
  for($i = 0; $i < $total; $i++){
    if ($i==0){
      mkdir('pass/'.$l);
    }

    if (is_uploaded_file($_FILES['file']['tmp_name'][$i])) {
        $path = $_FILES['file']['name'][$i];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext != 'jpg' && $ext !='png' || $_FILES['file']['size'][$i] > $max_rozmiar) {
            echo '<h1>Invalid file extension or file too large</h1>';
        }
        else {

        //     echo 'File uploaded successfully. File name: '.$_FILES['file']['name'][$i];
        //     echo '<br/>';
        //     if (isset($_FILES['file']['type'][$i])) {
        //         echo 'Type: '.$_FILES['file']['type'][$i].'<br/>';
        //     }

             move_uploaded_file($_FILES['file']['tmp_name'][$i], 'pass/'.$l.'/'.$_FILES['file']['name'][$i]);
             dbAtt($_FILES['file']['name'][$i], $l);
        }

    }
    else {
       header('Location: test.php?l='.$l.'&t=t');
    }

  }
}
else {
  header('Location: test.php?l='.$l.'&t=f');
}
function dbAtt($file, $group_id){
  global $db, $attachments_table;
  $sql = "INSERT INTO $attachments_table VALUES (NULL, '$file', '$group_id')";
  if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
  }
  else{
    echo "nope";
  }
}
 ?>
