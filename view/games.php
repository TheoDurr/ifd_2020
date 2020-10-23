<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_games.css">

<section class="contents_page">

    <form action="post" class="box1">
        <section id="search_area">
            <p class="small_title">Rechercher : </p>
            <input type="text" name="search" placeholder="Nom, Editeur,...">
            <p class="small_title">Catégorie :</p>
            <select name="category" id="categroy">
                <option value="0">-Select-</option>
                <option value="adventure">Aventure</option>
                <option value="reflexion">Réflexion</option>
            </select>
            <p class="small_title">Prix min:</p>
            <input type="number" name="min_price" min="1" max="400" step="1">
            <p class="small_title">Prix max:</p>
            <input type="number" name="max_price" min="1" max="400" step="1">
            <p class="small_title">Nb joueur min :</p>
            <input type="number" name="players_min" min="1" max="20" step="1">
            <p class="small_title">Nb joueur max :</p>
            <input type="number" name="players_max" min="1" max="20" step="1">
            <input type="submit" value="Rechercher">
        </section>
        <p id="indication">*Vous n'êtes pas obligé de renseigner tous les champs    </p>
    </form>

    <section id="results" class="box1">
        <p id="results_title">Résultats :</p>

        <a href="index.php?action=game_page&id=1" class="result_game">
            <img src="public/img/monopoly.jpg">
            <section>
                <p id="game_title">Monopoly</p>
                <section id="games_info">
                    <section class="games_info_content">
                        <p class="category_name">Catégorie :</p>
                        <p>Capitalisme</p>
                    </section>
                    <section class="games_info_content">
                        <p class="category_name">Note Moyenne :</p>
                        <p>8/10</p>
                    </section> 
                    <section>
                        <p class="category_name">Description :</p>
                        <p>Le Monopoly est un jeu de société américain édité par Hasbro. Le but du jeu consiste à ruiner ses concurrents par des opérations immobilières. Il symbolise les aspects apparents et spectaculaires du capitalisme, les fortunes se faisant et se défaisant au fil des coups de dés. Ce jeu de société est mondialement connu, et il en existe de multiples versions.</p>
                    </section>
                </section>   
            </section>
        </a>

        <a href="index.php?action=game_page&id=1" class="result_game">
            <img src="public/img/monopoly.jpg">
            <section>
                <p id="game_title">Monopoly</p>
                <section id="games_info">
                    <section class="games_info_content">
                        <p class="category_name">Catégorie :</p>
                        <p>Capitalisme</p>
                    </section>
                    <section class="games_info_content">
                        <p class="category_name">Note Moyenne :</p>
                        <p>8/10</p>
                    </section> 
                    <section>
                        <p class="category_name">Description :</p>
                        <p>Le Monopoly est un jeu de société américain édité par Hasbro. Le but du jeu consiste à ruiner ses concurrents par des opérations immobilières. Il symbolise les aspects apparents et spectaculaires du capitalisme, les fortunes se faisant et se défaisant au fil des coups de dés. Ce jeu de société est mondialement connu, et il en existe de multiples versions.</p>
                    </section>
                </section>   
            </section>
        </a>

    </section>

</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>

