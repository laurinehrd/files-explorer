# Files Explorer
Le but de l'exercice est de créer un  explorateur de fichiers du type de l'Explorateur de fichiers Windows ou du Finder de macOs en utilisant PHP pour les fonctionnalités, HTML et CSS pour styliser (possibilité d'utiliser Bootstrap ou solutions équivalentes).

## Récupérer l'url et afficher le contenu du dossier
Pour récupérer et afficher l'url du dossier, on utilise la fonction ```getcwd()``` avec un ```echo``` :
```
echo getcwd() .'\n'
```
Pour afficher le contenu du dossier, on utilise ```scandir()``` qui génère un tableau des contenus du dossier, et on lui met en paramètre l'url de notre dossier, et on utilise ```print_r()``` pour afficher le tableau.
```
$dir = getcwd();
$files = scandir($dir);
print_r($files);

```

## Le répertoire de départ

### Générer le dossier «start» s'il n'existe pas quand le script s'exécute
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

### Ouvrir le répertoire start au lancement du script
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

## Faire en sorte que . et .. n'apparaissent pas
Dans un ```scandir()``` on récupère le tableau des fichiers contenus dans «start».
```
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

## Afficher le fil d'Ariane
On crée la variable ```$breadcrumbs``` à laquelle on assigne la fonction ```explode()```. Cette fonction permet de scinder une chaine de caractères, ici ```$path``` qui reprend l'url du dossier «start», en segments pour retourner un tableau, en utilisant un délimiteur, ici ```DIRECTORY_SEPARATOR``` :
```
$breadcrumbs = explode(DIRECTORY_SEPARATOR, $path);
```
Maintenant, nous allons créer une boucle pour afficher l'url qu'à partir de start. Pour cela, on utilise donc ```foreach()``` pour récupérer toutes les valeurs du tableau ```breadcrumbs``` :
```
foreach ($breadcrumbs as &$value2) {
  //code ici }
```
On créé ensuite une condition avec l'instruction ```switch()``` pour les valeurs de ce tableau, et pour chaque liens qui apparaissent avant le «start» on ne les affiche pas, grâce à chaque «case» que l'on va déclarer. Pour ceux que l'on va afficher, on lui crée un lien avec la balise html ```<a>```, et on les sépare avec le ```DIRECTORY_SEPARATOR``` :
```
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
```
