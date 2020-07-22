<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Files Explorer</title>
  </head>
  <body>

<?php

echo getcwd() .'<br>';
//echo getcwd() . DIRECTORY_SEPARATOR .'boris'. '<br>';

$dir = getcwd();
$files = scandir($dir);
print_r($files);
$path = $dir  . DIRECTORY_SEPARATOR . 'start';
if (!is_dir('start')) {
  mkdir('start');
  chdir('start');
} else {
  chdir('start');
}
echo '<br>' .getcwd() .'<br>';



?>
<br>

<?php

$breadcrumbs = explode(DIRECTORY_SEPARATOR, $path);

// foreach ($breadcrumbs as &$value2) {
//   switch ($value2) {
//     case 'C:':
//       echo ' ';
//       break;
//     case 'wamp64' :
//       echo ' ';
//       break;
//     case 'www' :
//       echo ' ';
//       break;
//     case 'files-explorer' :
//       echo ' ';
//       break;
//     default:
//       echo '<a href="#">' .DIRECTORY_SEPARATOR .$value2 .'</a> ';
//       break;
//   }
// }

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

<br><br>

<form class="" action="index.php" method="post">
  <input type="checkbox" name="cache" value="coche">
  <label for="cache">Afficher les fichiers cachés</label>
  <br><br>
  <button type="submit" name="button">Envoyer</button>
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
      print_r('<br>' .$value .'<br>');
    }
  }


 ?>















  </body>
</html>
