<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_add_game.css">

<section class="contents_page">

    <section id="add_game_box" class="box1">

    <p class="big_title">Ajouter un jeu :</p>
    <form action="post" enctype="multipart/form-data">
        <p class="small_title">Nom :</p>
        <input type="text" max="255" name="name">
        <p class="small_title">Editeur :</p>
        <input type="text" max="255" name="editor">
        <p class="small_title">Description :</p>
        <textarea name="description" cols="150" rows="10" name="description"></textarea>
        <p class="small_title">Image (ratio 1:1) :</p>
        <input type="file" name="image">
        <p class="small_title">Catégorie :</p>
        <select name="category" id="categroy">
            <option value="0">-Select-</option>
            <option value="adventure">Aventure</option>
            <option value="reflexion">Réflexion</option>
        </select>
        <p class="small_title">Prix :</p>
        <input type="number" min="1" max="400" name="price">
        <p class="small_title">Nombre de joueur minimum:</p>
        <input type="number" min="1" max="100" name="players_min">
        <p class="small_title">Nombre de joueur maximum:</p>
        <input type="number" min="1" max="100" name="players_min">
        <p class="small_title">Complexité :</p>
        <input type="range" min="1" max="5" name="complexity">
        <p class="small_title">Conentration :</p>
        <input type="range" min="1" max="5" name="concentration">
        <p class="small_title">Ambiance :</p>
        <input type="range" min="1" max="5" name="ambiance">

    </form>

    </section>

</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>