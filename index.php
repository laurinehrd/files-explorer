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

foreach ($breadcrumbs as &$value2) {
  switch ($value2) {
    case 'C:':
      echo ' ';
      break;
    case 'wamp64' :
      echo ' ';
      break;
    case 'www' :
      echo ' ';
      break;
    case 'files-explorer' :
      echo ' ';
      break;
    default:
      echo '<a href="#">' .DIRECTORY_SEPARATOR .$value2 .'</a> ';
      break;
  }
}
 ?>

<br><br>

<form class="" action="index.php" method="post">
  <input type="checkbox" name="cache" value="cache" checked>
  <label for="cache">Afficher les fichiers cachés</label>
  <br>
  <button type="submit" name="button">Envoyer</button>
</form>

<?php

  $cache = NULL;

  if(isset($_POST['cache'])){
    $cache = $_POST['cache'];

    var_dump($cache);
  }


  $files_start = scandir($path);

  $delimiter = '.DIRECTORY_SEPARATOR.';



  foreach ($files_start as &$value){
    if($value=='.' || $value=='..'){
      echo ' ';

    }else if($cache == NULL && $value == '.*'){
      echo ' ';
    }
    else {
      print_r('<br>' .$value .'<br>');
    }
  }


 ?>















  </body>
</html>
