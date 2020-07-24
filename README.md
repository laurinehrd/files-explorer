# Files Explorer
Le but de l'exercice est de créer un  explorateur de fichiers du type de l'Explorateur de fichiers Windows ou du Finder de macOs en utilisant PHP pour les fonctionnalités, HTML et CSS pour styliser (possibilité d'utiliser Bootstrap ou solutions équivalentes).

## L'AFFICHAGE

### Récupérer l'url et afficher le contenu du dossier
Pour récupérer et afficher l'url du dossier, on utilise la fonction ```getcwd()``` avec un ```echo``` :
```
echo getcwd()
```
Pour afficher le contenu du dossier, on utilise ```scandir()``` qui génère un tableau des contenus du dossier, et on lui met en paramètre l'url de notre dossier, et on utilise ```print_r()``` pour afficher le tableau.
```
$dir = getcwd();
$files = scandir($dir);
print_r($files);

```

### Le répertoire de départ

#### Générer le dossier «start» s'il n'existe pas quand le script s'exécute
Faire une condition pour vérifier si le dossier existe ou non, en utilisant la fonction ```is_dir()```, qui veut dire si ça existe, donc on met un ```!``` pour dire s'il n'existe pas, où on met en paramètre le nom du dossier recherché.
```
if (!is_dir('start')) {
  //code ici }
```
Pour la création du dossier, on utilise la fonction ```mkdir()``` avec le nom du dossier voulu en paramètre.
```
mkdir(start);
```
Le code :
```
if (!is_dir('start')) {
  mkdir(start);
}
```

#### Ouvrir le répertoire start au lancement du script
Utiliser ```chdir()``` pour se déplacer dans le dossier «start» :
```
chdir('start');
```
Que le dossier «start» existe ou pas on demande au script de s'y diriger.
```
if (!is_dir('start')) {
  mkdir(start);
  chdir('start');
} else {
  chdir('start');
}
```

### Faire en sorte que . et .. n'apparaissent pas
Dans un ```scandir()``` on récupère le tableau des fichiers contenus dans «start», on mettant en paramètre la variable ```$path``` qui contient l'url du dossier «start» :
```
$path = $dir  . DIRECTORY_SEPARATOR . 'start';
$files_start = scandir($path);
```
Puis, on compare chaque valeur du tableau avec un ```foreach``` :
```
foreach ($files_start as &$value){
  //code ici
```
On ajoute une condition pour dire que si c'est égal au . ou .. et bien on ne les affiche pas, et sinon on affiche les valeurs des fichiers c'est-à-dire les noms des fichiers :
```
if($value=='.' || $value=='..'){
  echo ' ';

}else {
  print_r('<br>' .$value .'<br>');
}
```
Le code :
```
$files_start = scandir($path);

foreach ($files_start as &$value){
  if($value=='.' || $value=='..'){
    echo ' ';

  }else {
    print_r('<br>' .$value .'<br>');
  }
}
```

### Afficher le fil d'Ariane
On crée la variable ```$breadcrumbs``` à laquelle on assigne la fonction ```explode()```. Cette fonction permet de scinder une chaine de caractères, ici ```$path``` qui reprend l'url du dossier «start», en segments pour retourner un tableau, en utilisant un délimiteur, ici ```DIRECTORY_SEPARATOR``` :
```
$breadcrumbs = explode(DIRECTORY_SEPARATOR, $path);
```

On crée une variable ```$start_keys``` à laquelle on attribut un tableau contenant la clé du dossier «start» grâce à la fonction ```array_keys()```. On place en paramètre la variable du tableau ```$breadcrumbs``` et la valeur «start» :
```
$start_keys = array_keys($breadcrumbs,'start');
```
Maintenant, nous allons créer une boucle pour afficher l'url qu'à partir de start. Pour cela, on utilise donc ```foreach()``` pour récupérer chaque clé des valeurs du tableau ```breadcrumbs``` :
```
foreach ($breadcrumbs as $key => $value2) {
  //code ici }
```
On créé une condition avec ```if()``` pour permettre de ne pas afficher les dossiers se trouvant avant «start». Pour cela, on compare les clés des dossiers contenus dans ```$breadcrumbs``` avec la clé de «start». Toutes les clées se trouvant avant ne seront pas affichés.
```
if($key < $start_keys[0]){
  echo ' ';
```
Et sinon, on affiche le nom des fichiers à partir de «start» et au-delà dans notre fil d'Ariane :
```
else {
  echo '<a href="#">' .DIRECTORY_SEPARATOR .$value2 .'</a> ';
}
```
Le code :
```
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
```


### Afficher / masquer les fichiers cachés
On crée une checkbox où que l'on peut cocher pour afficher les dossiers cachés :
```
<form class="" action="index.php" method="post">
  <input type="checkbox" name="cache" value="coche">
  <label for="cache">Afficher les fichiers cachés</label>
  <br>
  <button type="submit" name="button">Envoyer</button>
</form>
```
On crée une variable ```$cache``` à laquelle on affecte l'abscence de valeur : NULL. Cette abscence de valeur correspond à l'état initial non coché de la checkbox.
```
$cache = NULL;
```
On récupère ensuite, avec la fonction ```isset()```,  la valeur de la superglobale ```$_POST['cache']``` dans la variable ```$cache```. Si la checkbox n'est pas cochée, alors la variable reste NULL. Si la checkbox est cochée, la variable prend la valeur mise dans l'input : «coche».
```
if(isset($_POST['cache'])){
  $cache = $_POST['cache'];
}
```
Puis, dans la boucle ```foreach()``` qui permet d'afficher les fichiers, on rajoute une condition ```else if()``` où l'on vérifie deux conditions pour masquer les fichiers cachés : il faut que ```$cache``` soit NULL et que le nom du fichier commence par un point. Pour vérifier que le nom d'un fichier commence par un point, on utilise ```$value[0] == '.'``` qui permet de récupérer et tester le premier caractère du nom du fichier, grâce au «[0]»; voir exemple :

// Accéder à un simple caractère dans une chaîne
// peut également être réalisé en utilisant des crochets
$string = 'abcdef';
echo $string[0]; // a
echo $string[3]; // d
echo $string[strlen($string)-1]; // f

```
else if($cache == NULL && $value[0] == '.'){
  echo ' ';
}
```

## LA NAVIGATION

### Naviguer dans les dossiers en cliquant dessus
