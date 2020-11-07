<!DOCTYPE html>
<html>
    <head>
        <title><?php if(isset($tabName)){echo $tabName;} else {echo "Jeu critique";} ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
    </head>
    <body>
    
<nav id="menu_nav">
    <ul>
        <section id="header_left">
            <a href="index.php" class="img"><img src="public/img/logo.jpg"></a>
            <a href="index.php" class="btn" id="btn-accueil">Accueil</a>
            <section class="dropdown">
                <a href="index.php?action=games" class="btn" id="btn-jeux">Jeux</a>
                <a href="index.php?action=add_game" class="btn" id="add_game">Ajouter un jeu</a>
            </section>
        </section>
        
        <a href="index.php" id="main_title">Jeu critique - réseau social de critiques de jeux de plateau</a>
        <section id="header_right">
            <?php if(isset($_SESSION['user'])){ ?>
            <section class="dropdown">
                <a href="index.php?action=account&userId=<?php echo $_SESSION['user']->id();?>" class="btn" id="my_account">Mon compte</a>
                <a href="index.php?action=logout" class="btn" id="logout">Déconnexion</a>
            </section>
            

            <?php }else{ ?>
                <a href="index.php?action=login" class="btn">Connexion</a>
            <?php } ?>
        </section>
    </ul>
</nav>