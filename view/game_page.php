<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_game_page.css">

<section class="contents_page">
    <section class="box" id="game">
        <img src="" alt="">
        <p id="name">Monopoly</p>
        <p>Editor :</p>
        <p>Catégorie :</p>
        <p>Prix :</p>
        <p>Nb joueur max :</p>
        <p>Nb joueur min :</p>
        <p>Complexité :</p>
        <p>Concentration :</p>
        <p>Ambiance</p>
        <p>Descritpion :</p>
    </section>
    <section id="avis">
        
    </section>
</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>
