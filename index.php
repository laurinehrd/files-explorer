<?php session_start(); ?>
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
      <input type="image" class="button_window" src="images/back.png" alt="icon back window" name="back">
      <!-- <button type="submit" class="button_reload" name="reload"><img class="refresh" src="images/refresh.png" alt="icon refresh"></button> -->
      <input type="image" class="button_close" onclick="closeWindow()" src="images/close.png" alt="icon close window">
  </div>


  <div class="breadcrumbs">


<?php

 // echo getcwd() .'<br>';
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

if(!isset($_SESSION['before'])){
  $path = $dir  . DIRECTORY_SEPARATOR . 'start';
}else{
  $path = $_SESSION['before'];
}


if(isset($_GET['folder'])){
  $path = $_GET['folder'];
  $_SESSION['before'] = $path;
}

$dir_temps = $path;

if(isset($_GET['ariane'])){
  $breadcrumbs_temps = explode(DIRECTORY_SEPARATOR, $dir_temps);
  $key_temps = array_keys($breadcrumbs_temps, $_GET['ariane']);
  $elements = array_slice($breadcrumbs_temps,0,$key_temps[0]+1);
  $path = implode(DIRECTORY_SEPARATOR, $elements);
  $_SESSION['before'] = $path;
}


chdir($path);


$breadcrumbs = explode(DIRECTORY_SEPARATOR, $path);

$start_keys = array_keys($breadcrumbs,'start');
// print_r($start_keys);
// print_r($breadcrumbs);
echo '<form action="index.php" method="GET">';

foreach ($breadcrumbs as $key => $value2) {
  if($key < $start_keys[0]){
    echo ' ';
  }else {
    print_r('<button class="button_ariane" type="submit" name="ariane" value="'.$value2 .'">'.$value2.'</button>');
  }
}
echo '</form>';




 ?>
  </div>

<br>

<form class="barAction" action="index.php" method="GET">
  <input type="text" name="newFolderName" placeholder="Nom du dossier">
  <button class="button btn_creerDossier" type="submit" name="newFolder" value="newFolder">Créer le dossier</button>
  <button class="button" type="submit" name="paste" value="paste">Coller</button>
  <button class="button" type="submit" name="upload" value="upload">Télécharger</button>
  <!-- <button class="button" type="submit" name="delete" value="delete">Supprimer</button> -->
  <input type="checkbox" name="cache" value="coche">
  <label class="text_hide" for="cache">Afficher les fichiers cachés</label>
  <button class="button btn-envoyer" type="submit" name="button">Envoyer</button>
</form>

<?php

  $cache = NULL;

  if(isset($_GET['cache'])){
    $cache = $_GET['cache'];
  }


  $delimiter = '.DIRECTORY_SEPARATOR.';

$pathfile = NULL;
$openFile = NULL;
$image = NULL;

$files_start = scandir($path);

echo '<form class="form_dossier" action="index.php" method="GET">';

  foreach ($files_start as &$value){
    //var_dump($value);
    if($value=='.' || $value=='..'){
      echo ' ';

    }else if($cache == NULL && $value[0] == '.'){
      echo ' ';
    }
    else {
      if(is_dir($value) == true){
        print_r('<button class="button_folder" type="submit" name="folder" value="' .$path. DIRECTORY_SEPARATOR .$value .'">'."<img class='img_folder' src='images/folder.png'>" .$value.'</button><br>');
      }else{
        $filetype = pathinfo($value, PATHINFO_EXTENSION);
        $pathfile = $path. DIRECTORY_SEPARATOR .$value;
        // echo $pathfile;

        if($filetype == 'jpg' || $filetype == 'png'){
          echo '<button class="btn" type="submit" name="openImg" value="'.$pathfile.'">
          <img class="icon_image" src="images/image.png" alt="icone fichier image">' .$value .'</button><br>
          <button class="btn btn_copy" type="submit" name="copy" value="'.$pathfile.'" id="copyButton">Copier</button><br>
          <button class="btn btn_copy" type="submit" name="rename" value="'.$value.'" id="renameButton">Renommer</button><br>
          <button class="btn btn_copy" type="submit" name="delete" value="'.$pathfile.'" id="deleteButton">Supprimer</button>';
        }else if($filetype == 'txt'){
          echo '<button class="btn" type="submit" name="openTxt" value="'.$pathfile.'">
          <img class="icon_image" src="images/texte.png" alt="icone fichier texte">' .$value .'</button><br>
          <button class="btn btn_copy" type="submit" name="copy" value="'.$pathfile.'" id="copyButton">Copier</button><br>
          <button class="btn btn_copy" type="submit" name="rename" value="'.$pathfile.'" id="renameButton">Renommer</button><br>
          <button class="btn btn_copy" type="submit" name="delete" value="'.$pathfile.'" id="deleteButton">Supprimer</button>';

        }else{
          echo '<br>' .$value .'<br>';
        }
      }
    }
  }
echo '</form>';

//ouvrir des fichiers :
function openFile($pathfile){
  echo nl2br(file_get_contents($pathfile));
}
function openImg($pathfile){
  // var_dump($pathfile);
  $image = $_GET['openImg'];
  $imageIndex = explode(DIRECTORY_SEPARATOR, $image);
  $image = array_slice($imageIndex, 4);
  var_dump($image);
  $image = implode(DIRECTORY_SEPARATOR, $image);
  echo '<img src="'.$image.'">';
}

if(isset($_GET['openTxt'])){
  openFile($pathfile);
}
if(isset($_GET['openImg'])){
  openImg($_GET['openImg']);
}

//copier coller fichiers :
if(isset($_GET['copy'])){
  $pathfile = $_GET['copy'];
  $_SESSION['copy'] = $pathfile;
}
if(isset($_GET['paste'])){
  copypaste($path);
}
function copypaste($path){
  $pathfile = $_SESSION['copy'];
  $nameCopy = explode(DIRECTORY_SEPARATOR, $pathfile);
  $nameCopy = end($nameCopy);
  if($pathfile == NULL){
    echo ' ';
  }else{
    copy($pathfile, $path .DIRECTORY_SEPARATOR. $nameCopy);
  }
  $_SESSION['copy'] = NULL;
  /*header('location : C:\wamp64\www\files-explorer\index.php');
  Problème : Internal Server Error
  The server encountered an internal error or misconfiguration and was unable to complete your request.
  Après recherche : voir le fichier error log pour savoir le soucis*/
}

//création nouveau dossier :
function newFolder($path){
  $nameFolder = $_GET['newFolderName'];
  if ($nameFolder == NULL){
    echo '';
  }else if(!is_dir($nameFolder)){
    mkdir($nameFolder, 0777);
  }
}
if(isset($_GET['newFolderName'])){
  newFolder($path);
}

//renommer un fichier
if(isset($_GET['rename'])){
  $getname = $_GET['rename'];
  echo '<form method="GET" action="index.php">
          <input type="text" name="newName" placeholder="Nouveau nom">
          <button class="btn-rename" type="submit">Ok</button>
        </form>';
  $_SESSION['rename'] = $getname;
}
if(isset($_GET['newName'])){
  $oldname = $_SESSION['rename'];
  $newname = $_GET['newName'];
  if($oldname == NULL || $newname == NULL){
    echo '';
  }else{
    rename($oldname,$newname);
  }
  $_SESSION['rename'] = NULL;
}

// supprimer un fichier
if(isset($_GET['delete'])){
  $urlfichier = $_GET['delete'];
  $nomfichier = explode(DIRECTORY_SEPARATOR,$urlfichier);
  $nomfichier = end($nomfichier);
  $urlB = explode(DIRECTORY_SEPARATOR, $urlfichier);
  $keyFe = array_keys($urlB, 'files-explorer');
  $urlB = array_slice($urlB,0,$keyFe[0]+1);
  $urlB = implode(DIRECTORY_SEPARATOR,$urlB);
  $urlBasket = $urlB.DIRECTORY_SEPARATOR.'basket';
  if ($urlfichier != NULL && $nomfichier != NULL){
    if(copy($urlfichier,$urlBasket.DIRECTORY_SEPARATOR.$nomfichier)){
      echo 'Fichier supprimé';
    }else{
      echo 'Fichier encore lààààà';
    }
    unlink($urlfichier);
  }else{
    echo '';
  }
}

// télécharger un fichier
if(isset($_GET['upload'])){
  echo '<form class="formUpload" enctype="multipart/form-data" method="POST" action="index.php">
          <input type="hidden" name="MAX_FILE_SIZE" value="30000">
          <input type="file" name="file">
          <input type="submit" name="test" value="Envoyer le fichier">
        </form>';
}
if(isset($_POST['test'])){
  $folderUpload = getcwd().DIRECTORY_SEPARATOR;
  $fileUploadName = basename($_FILES['file']['name']);
  if(move_uploaded_file($_FILES['file']['tmp_name'],$folderUpload.$fileUploadName)){
    echo 'Fichier arrivé dans téléchargement';
  }else{
    echo 'Echec de l\'envoi';
  }
}

 ?>



</div>


<div class="start">
  <input onclick="openWindow()" id="start" type="image" src="images/folder.png" alt="icon folder">
  <p class="p_start">START</p>
</div>

<!-- <div class="upload">
  <input onclick="openWindow()" id="start" type="image" src="images/folder-upload.png" alt="icon folder upload">
  <p class="p_start">UPLOAD</p>
</div> -->

<div class="basket">
  <input onclick="openNewWindow()" type="image" src="images/delete.png" alt="icon basket">
  <p class="p_start">CORBEILLE</p>
</div>

<!-- ************************Fenetre corbeille***************************** -->
<div class="window windowBasket" id="newOpen">
  <div class="icon_window">
      <input type="image" class="button_close" onclick="closeNewWindow()" src="images/close.png" alt="icon close window">
  </div>
  <?php
  $arrayBasket = explode(DIRECTORY_SEPARATOR,$path);
  $basketkey = array_keys($arrayBasket, 'files-explorer');
  $urlbaskettemp = array_slice($arrayBasket,0,$basketkey[0]+1);
  $urlbaskettemp = implode(DIRECTORY_SEPARATOR, $urlbaskettemp);
  $urlbasket = $urlbaskettemp.DIRECTORY_SEPARATOR.'basket';
  $filesBasket = scandir($urlbasket);
  var_dump($urlbasket);

  foreach ($filesBasket as &$value3) {
    if($value3=='.' || $value3=='..'){
      echo ' ';
    }else{
    if(is_dir($value3) == true){
      print_r('<button class="button_folder" type="submit" name="folder" value="' .$path. DIRECTORY_SEPARATOR .$value3 .'">'."<img class='img_folder' src='images/folder.png'>" .$value3.'</button><br>');
  }else{
    $filetypeb = pathinfo($value3, PATHINFO_EXTENSION);
    $pathfileb = $urlbasket. DIRECTORY_SEPARATOR .$value3;
    // echo $pathfile;

    if($filetypeb == 'jpg' || $filetypeb == 'png'){
      echo '<button class="btn" type="submit" name="openImg" value="'.$pathfileb.'">
      <img class="icon_image" src="images/image.png" alt="icone fichier image">' .$value3 .'</button><br>
      <button class="btn btn_copy" type="submit" name="restaurer" value="'.$pathfileb.'" id="restaureButton">Restaurer</button>';
    }else if($filetypeb == 'txt'){
      echo '<button class="btn" type="submit" name="openTxt" value="'.$pathfileb.'">
      <img class="icon_image" src="images/texte.png" alt="icone fichier texte">' .$value3 .'</button><br>
      <button class="btn btn_copy" type="submit" name="restaurer" value="'.$pathfileb.'" id="restaureButton">Restaurer</button>';

    }else{
      echo '<br>' .$value3 .'<br>';
      }
    }
  }
}



   ?>
</div>


<!-- bar outil -->
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
