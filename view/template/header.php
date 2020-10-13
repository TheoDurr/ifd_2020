!DOCTYPE html>
<html>
    <head>
        <title>Jeu critique - Connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    
<nav id="menu-nav">
    <ul>
        <section id="header-gauche">
            <img src="img/logo.jpg">
            <a href="accueil.php" class="btn" id="btn-accueil">Accueil</a>
            <a href="jeux.php" class="btn" id="btn-jeux">Jeux</a>
        </section>
        <a href="#" id="title-principale">Jeu critique - réseau social de ciritques de jeux de plateau</a>
        <section id="header-droit">
            <?php if($_SESSION){
                <a href="index.php?action=account" class="btn" id="btn-connexion">Mon compte</a>
            }else{
                <a href="index.php?action=login" class="btn" id="btn-connexion">Connexion</a>
            }
            ?>
            
        </section>
    </ul>
</nav>