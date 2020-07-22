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

$files_start = scandir($path);

$delimiter = '.DIRECTORY_SEPARATOR.';

foreach ($files_start as &$value){
  if($value=='.' || $value=='..'){
    echo ' ';

  }else {
    print_r('<br>' .$value .'<br>');
  }
}

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















  </body>
</html>
