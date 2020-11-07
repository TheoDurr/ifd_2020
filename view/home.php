<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_home.css">

<section class="contents_page">
    
    <section id="presentation" class="box1">
        <img id= "PrincipalPicture" src="public/img/imagePrésentation.jpg">
        
        <section id="title">Bienvenue sur Jeu Critique</section>
        <div class="subtitle">Le forum n°1 de critiques de jeux de société dans le monde !</div><br>
        <div id ="explication">
            <div id="explicationPicture">
                <img id= "BlocPicture" src="public/img/MiddlePage.jpg"> 
            </div>
            <div id="explicationText">
                <div class="small_title">Jeu Critique, pour quoi faire ?</div><br>
                Connectez vous ou créez vous un compte au plus en cliquant sur le lien suivant :
                <a href="index.php?action=register">Se créer un compte</a><br><br>
                Ensuite <div class="evidence"> ajoutez, recherchez, commentez et notez </div> des millions de jeux
            </div>

        </div>

        <div id="counter">
            <div class="position">
                Commentaires postés : <div class="nombre"> <?= $stats['comments']?></div>
            </div>
            <div class="position">
                Critiques postées : <div class="nombre"><?=$stats['reviews']?></div>
            </div>
            <div class="position">
                 Jeu référencés : <div class="nombre"><?=$stats['games']?></div>
            </div>
        </div>

        
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