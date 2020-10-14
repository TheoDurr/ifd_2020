<!DOCTYPE html>
<html>
    <head>
        <title>Jeu critique - Connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
    </head>
    <body>
    
<nav id="menu-nav">
    <ul>
        <section id="header-gauche">
            <img src="public/img/logo.jpg">
            <a href="index.php" class="btn" id="btn-accueil">Accueil</a>
            <a href="index.php?action=games" class="btn" id="btn-jeux">Jeux</a>
        </section>
        <a href="#" id="title-principale">Jeu critique - réseau social de ciritques de jeux de plateau</a>
        <section id="header-droit">
            <?php if(isset($_SESSION)){ ?>
                <a href="index.php?action=account" class="btn" id="btn-connexion">Mon compte</a>
            <?php }else{ ?>
                <a href="index.php?action=login" class="btn" id="btn-connexion">Connexion</a>
            <?php } ?>
        </section>
    </ul>
</nav>