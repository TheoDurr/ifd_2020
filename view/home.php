<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_home.css">

<section class="contents_page">
    
    <section id="presentation" class="box1">
        <p>Présentation du site :</p>
        <p>Bienvenue sur Jeu Critique, le forum n°1 de critiques de jeux de plateux dans la monde !</p>
        <p>Vous êtes actuellement n perosnnes à être connecté sur le forum. <br> Ce forum ressens n critiques portant sur n.</p>
        <p>Créez vous un compte au plus vite, pour pouvoir à votre tour poster des critiques et ajouter des nouveaux jeux <br><a href="index.php?action=register">Se créer un compte</a></p>
        <p></p>
    </section>

    <aside>
        <section id="last_reviews" class="box1">
            <p>Derniere critiques postées par les utilisateurs</p>
        </section>

        <section id="last_games" class="box1">
            <p>Derniers jeux ajoutés</p>
        </section>
    </aside>
</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>