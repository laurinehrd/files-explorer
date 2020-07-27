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

$path = $dir  . DIRECTORY_SEPARATOR . 'start';

if(isset($_POST['folder'])){
  $path = $_POST['folder'];
}

$dir_temps = $path;

if(isset($_POST['ariane'])){
  $breadcrumbs_temps = explode(DIRECTORY_SEPARATOR, $dir_temps);
  $key_temps = array_keys($breadcrumbs_temps, $_POST['ariane']);
  var_dump($breadcrumbs_temps);
  // $path = $_POST['ariane'];
}


chdir($path);
$breadcrumbs = explode(DIRECTORY_SEPARATOR, $path);

$start_keys = array_keys($breadcrumbs,'start');
// print_r($start_keys);
// print_r($breadcrumbs);
echo '<form action="index.php" method="post">';

foreach ($breadcrumbs as $key => $value2) {
  if($key < $start_keys[0]){
    echo ' ';
  }else {
    print_r('<button type="submit" name="ariane" value="'.$value2 .'">'.$value2.'</button>');
  }
}
echo '</form>';




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


  $delimiter = '.DIRECTORY_SEPARATOR.';


$files_start = scandir($path);

echo '<form action="index.php" method="POST">';

  foreach ($files_start as &$value){
    //var_dump($value);
    if($value=='.' || $value=='..'){
      echo ' ';

    }else if($cache == NULL && $value[0] == '.'){
      echo ' ';
    }
    else {
      if(is_dir($value) == true){
        print_r('<button type="submit" name="folder" value="' .$path. DIRECTORY_SEPARATOR .$value .'">' .$value.'</button><br>');
      }else{
        echo '<br>' .$value .'<br>';
      }
    }
  }
echo '</form>';

 ?>



</div>


<div class="start">
  <input onclick="openWindow()" id="start" type="image" src="images/folder.png" alt="icon folder">
  <p class="p_start">START</p>

</div>



<div class="bar_outils">

  <img class="logo_acs" src="images/logo-acs.png" alt="logo access code school">
  <div class="acs"><img class="icon_diplome" src="images/mortarboard.png" alt="icone diplome"><p class="p_acs">Access Code School</p></div>
  <img class="logo_php_js" src="images/php.png" alt="logo php">
  <img class="logo_php_js" src="images/javascript.png" alt="logo javascript">

  <div class="julie_laurine">
    <img class="icon_woman" src="images/people.png" alt="icon woman"><p>Julie BOULENGER</p>
    <img class="icon_woman icon_laurine" src="images/woman.png" alt="icon woman"><p>Laurine HERARD</p>
  </div>

  <div class="today">
    <div class="time"><?php date_default_timezone_set("Europe/Paris"); echo date("H:i")?></div>
    <div class="date"><?php echo date("d/m/Y")?></div>
  </div>

</div>








  </body>
</html>
