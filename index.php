<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;1,300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="main.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>Files Explorer</title>
  </head>
  <body>

<div class="window" id="close">

  <div class="icon_window">
      <input type="image" class="button_window" src="images/back.png" alt="icon back window">
      <input type="image" class="button_window" onclick="closeWindow()" src="images/close.png" alt="icon close window">
  </div>


  <div class="breadcrumbs">


<?php

//echo getcwd() .'<br>';
//echo getcwd() . DIRECTORY_SEPARATOR .'boris'. '<br>';

$dir = getcwd();
$files = scandir($dir);
//print_r($files);
$path = $dir  . DIRECTORY_SEPARATOR . 'start';
if (!is_dir('start')) {
  mkdir('start');
  chdir('start');
} else {
  chdir('start');
}
//echo '<br>' .getcwd() .'<br>';


?>

<br>

<?php



$breadcrumbs = explode(DIRECTORY_SEPARATOR, $path);


$start_keys = array_keys($breadcrumbs,'start');
//print_r($start_keys);

foreach ($breadcrumbs as $key => $value2) {
  if($key < $start_keys[0]){
    echo ' ';
  }else {
    echo '<a href="#">' .DIRECTORY_SEPARATOR .$value2 .'</a> ';
  }
}


 ?>
  </div>

<br>

<form class="" action="index.php" method="post">
  <input type="checkbox" name="cache" value="coche">
  <label class="text_hide" for="cache">Afficher les fichiers cachés</label>
  <button class="button" type="submit" name="button">Envoyer</button>
</form>

<?php

  $cache = NULL;

  if(isset($_POST['cache'])){
    $cache = $_POST['cache'];
  }


  $files_start = scandir($path);

  $delimiter = '.DIRECTORY_SEPARATOR.';


  foreach ($files_start as &$value){
    //var_dump($value);
    if($value=='.' || $value=='..'){
      echo ' ';

    }else if($cache == NULL && $value[0] == '.'){
      echo ' ';
    }
    else {
      if(is_dir($value) == true){
        echo '<br><a href="'.chdir($path .DIRECTORY_SEPARATOR .$value).'">' .$value .'</a><br>';
      }else{
        echo '<br><a href="'.$value.'">' .$value .'</a><br>';
      }
    }
  }


 ?>

</div>







<!-- <div class="logo">
  <img src="images/logo_acs_noir.png" alt="logo acs">
</div> -->











  </body>
</html>
