<?php ob_start(); ?>

<section id="search-area">
    <form action="post">
        <p>Rechercher : </p>
        <input type="text" name="search" placeholder="Nom, Editeur,...">
        <p>Catégorie :</p>
        <select name="category" id="categroy">
            <option value="0">-Select-</option>
            <option value="adventure">Aventure</option>
            <option value="reflexion">Réflexion</option>
        </select>
        <p>Prix :</p>
        <input type="number" name="price" min="1" max="200" step="1">
        <p>Nombre de joueur minimum :</p>
        <input type="number" name="players_min" min="1" max="20" step="1">
        <p>Nombre de joueur maximum :</p>
        <input type="number" name="players_max" min="1" max="20" step="1">
        <p>Complexité :</p>
        <input type="number" name="complextiy" min="1" max="10" step="1">
        <p>Concentration :</p>
        <input type="number" name="concentration" min="1" max="10" step="1">
        <p>Ambiance :</p>
        <input type="number" name="ambiance" min="1" max="10" step="1"> <br> <br>
        <input type="submit" value="sent">
    </form>

</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>