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
            <section class="dropdown">
                <a href="index.php?action=games" class="btn" id="btn-jeux">Jeux</a>
                <a href="index.php?action=add_game" class="btn" id="add_game">Ajouter un jeu</a>
            </section>
        </section>
        
        <a href="index.php" id="main_title">Jeu critique - réseau social de ciritques de jeux de plateau</a>
        <section id="header_right">
            <?php if(isset($_SESSION)){ ?>
            <section class="dropdown">
                <a href="index.php?action=account" class="btn" id="my_account">Mon compte</a>
                <a href="#" class="btn" id="logout">Déconnexion</a>
            </section>
            

            <?php }else{ ?>
                <a href="index.php?action=login" class="btn">Connexion</a>
            <?php } ?>
        </section>
    </ul>
</nav>