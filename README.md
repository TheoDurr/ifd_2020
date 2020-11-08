# ifd_2020
Projet d'IFD visant à créer un site de critique de jeux de plateau en ligne en PHP et MySQL

## Procédure d'installation du site
Durant toute la phase de développement, nous avons travaillé sur la même base de données (hébergée sur un Raspberry (cf. Rapport de projet)). Il s'agit de la base de données par défaut.

Cependant, des lenteurs dûes aux performances de la carte peuvent occurer, cela peut également dépendre de la rapidité de votre connexion. Il est donc parfois plus judicieux de travailler avec la base de données intégrée à XAMPP. Les deux bases de données sont fonctionnelles.

Pour se faire, il suffit de remplacer dans `index.php` la ligne `$db = new PDO('mysql:host=90.126.235.250;dbname=ifd', 'admin', 'ifd2020');` par `$db = new PDO('mysql:host=localhost;dbname=ifd', 'root', '');` et d'importer le fichier `bdd.sql` via phpMyAdmin.

Tous les comptes ont comme mot de pass `admin`, un compte admnistrateur est `prof@admin.fr`.