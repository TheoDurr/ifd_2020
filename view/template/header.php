<!DOCTYPE html>
<html>
    <head>
        <title>Jeu critique - Connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
    </head>
    <body>
    
<nav id="menu_nav">
    <ul>
        <section id="header_left">
            <img src="public/img/logo.jpg">
            <a href="index.php" class="btn" id="btn-accueil">Accueil</a>
            <a href="index.php?action=games" class="btn" id="btn-jeux">Jeux</a>
        </section>
        <a href="index.php" id="main_title">Jeu critique - réseau social de ciritques de jeux de plateau</a>
        <section id="header_right">
            <?php if(isset($_SESSION)){ ?>
                <a href="index.php?action=account" class="btn">Mon compte</a>
            <?php }else{ ?>
                <a href="index.php?action=login" class="btn">Connexion</a>
            <?php } ?>
        </section>
    </ul>
</nav>