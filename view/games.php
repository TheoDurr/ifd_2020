<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_games.css">

<section class="contents_page">

    <form method="post" class="box1" enctype="multipart/form-data">
        <section id="search_area">
            <p class="small_title">Rechercher : </p>
            <input name = "search" list="se" type="text">
            <datalist id="se">
                <?php 
                $gManager = new GameManager($db);
                $game=$gManager->get(); //We are going to look for all the referenced games in the database.
                foreach($game as $g){ // They are listed in the search bar ?> 
                <option value="<?php echo $g->name(); ?>"><?php echo $g->name(); ?></option>
                <?php } ?>
            </datalist>
            <p class="small_title">Catégorie :</p>
            <select name="category" id="categroy">
                <?php 
                $CManager = new CategoryManager($db);
                $category=$CManager->get(); //We are going to look for all the referenced category in the database.
                foreach($category as $c){// They are listed and the user can choose?>
                <option value="<?php echo $c->name(); ?>"><?php echo $c->name(); ?></option>
                <?php } ?>
            </select>
            <p class="small_title">Prix min:</p>
            <input type="number" name="priceMin" min="1" max="400" step="1">
            <p class="small_title">Prix max:</p>
            <input type="number" name="priceMax" min="1" max="400" step="1">
            <p class="small_title">Nb joueur min :</p>
            <input type="number" name="playersMin" min="1" max="20" step="1">
            <p class="small_title">Nb joueur max :</p>
            <input type="number" name="playersMax" min="1" max="20" step="1">
            <input type="submit" value="Rechercher">
        </section>
        <p id="indication">*Vous n'êtes pas obligé de renseigner tous les champs    </p>
    </form>

    <section id="results" class="box1">
        <?php
            if(isset($data['result'])){?>
                <p id="results_title">Résultats :</p>
            <?php } else {?>
                <p id="results_title">Jeux</p>
            <?php }
        ?>
        <?php if(!empty($data['games'])){ // If we found one or more games?>
        <?php foreach($data['games'] as $game){ // We show the different games?>
        <a href="index.php?action=game_page&id=<?= $game->id() ?>" class="result_game">
            <img src="data:image/jpeg;base64, <?= base64_encode($game->img())?>"/>
            <section class="content_text">
                <p id="game_title"><?= $game->name() ?></p>
                <section id="games_info">
                    <section class="games_info_content">
                        <p class="small_title">Catégorie :</p>
                        <p><?= $game->category()->name() ?></p>
                    </section>
                    <section class="games_info_content">
                        <p class="small_title">Note Moyenne :</p>
                        <p><?= $game->avgScore() ?>/5</p>
                    </section> 
                    <section class="description">
                        <p class="small_title">Description :</p>
                        <p><?= $game->description() ?></p>
                    </section>
                </section>   
            </section>
        </a>
        <?php } ?>
        <?php } else {// If no game was found we mark no result?>
            <p class="big_title">Aucun Résultat</p>
            <?php }?>
    </section>

</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>

