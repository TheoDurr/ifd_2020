<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_add_game.css">
<section class="contents_page">
    <?php if(isset($_SESSION['user'])) { ?>
        <section id="add_game_box" class="box1">

        <p class="big_title">Ajouter un jeu :</p>
        <form method="post" enctype="multipart/form-data">
            <p class="small_title">Nom :</p>
            <input type="text" max="255" name="name" required>
            <p class="small_title">Editeur :</p>
            <input name = "editor" list="ed" type="text" required>
            <datalist id="ed">
                <?php 
                $EManager = new EditorManager($db);
                $editors=$EManager->get(); //We are going to look for all the referenced editors in the database.
                foreach($editors as $e){ // They are listed in the search bar?>
                <option value="<?php echo $e->name(); ?>"><?php echo $e->name(); ?></option>
                <?php } ?>
            </datalist>
            <p class="small_title">Description :</p>
            <textarea name="description" cols="150" rows="10" name="description"></textarea>
            <p class="small_title">Image (ratio 1:1) :</p>
            <input type="file" name="image">
            <p class="small_title">Catégorie :</p>
            <select name="category" id="categroy">
            <?php 
                $CManager = new CategoryManager($db);
                $category=$CManager->get(); //We are going to look for all the referenced category in the database.;
                foreach($category as $c){// They are listed and the user can choose?>
                <option value="<?php echo $c->name(); ?>"><?php echo $c->name(); ?></option>
                <?php } ?>
            </select>
            <p class="small_title">Prix :</p>
            <input type="number" min="1" max="400" name="price" required>
            <p class="small_title">Nombre de joueur minimum:</p>
            <input type="number" min="1" max="100" name="playersMin" required>
            <p class="small_title">Nombre de joueur maximum:</p>
            <input type="number" min="1" max="100" name="playersMax" required>
            <p class="small_title">Complexité :</p>
            <input type="range" min="1" max="5" name="complexity">
            <p class="small_title">Conentration :</p>
            <input type="range" min="1" max="5" name="concentration">
            <p class="small_title">Ambiance :</p>
            <input type="range" min="1" max="5" name="ambiance"> <br><br>
            <input type="submit" value="Ajouter">
        </form>

        </section>

    

    <?php } else {?>
        <section id="add_game_box" class="box1">
        <p class="big_title">Veuillez vous connecter pour ajouter un jeu</p>
        </section>
    <?php } ?>
</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>