<?php
$l = $_GET['l'];
$dir = 'pass/'.$l;
if (!file_exists($dir) && !is_dir($dir)) {
  $max_rozmiar = 10240*10240;
  $total = count($_FILES['file']['name']);
  mkdir('pass/'.$l);
  for($i = 0; $i < $total; $i++){

    if (is_uploaded_file($_FILES['file']['tmp_name'][$i])) {
        $path = $_FILES['file']['name'][$i];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext != 'jpg' && $ext !='png' || $_FILES['file']['size'][$i] > $max_rozmiar) {
            echo 'Invalid file extension or file too large';
        } else {
            echo 'Odebrano file. Początkowa nazwa: '.$_FILES['file']['name'][$i];
            echo '<br/>';
            if (isset($_FILES['file']['type'][$i])) {
                echo 'Typ: '.$_FILES['file']['type'][$i].'<br/>';
            }
            move_uploaded_file($_FILES['file']['tmp_name'][$i],
                    'pass/'.$l.'/'.$_FILES['file']['name'][$i]);
        }
    }
    else {
       echo 'Błąd przy przesyłaniu danych!';
    }

  }
}
else {
  echo " <h1>Sejm szit egzists</h1>";
}

 ?>
