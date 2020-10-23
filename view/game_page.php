<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_game_page.css">

<section class="contents_page">
    <section id="picture_title">
        <img src="public/img/monopoly.jpg">
        <p>Monopoly</p>
    </section>

    <section class="box1" id="info">
        <section class="info_content">
            <p class="small_title">Editor :</p>
            <p>Hasbro</p>
        </section>
        <section class="info_content">
            <p class="small_title">Catégorie :</p>
            <p>Capitalisme</p>
        </section>
        <section class="info_content">
            <p class="small_title">Prix :</p>
            <p>25 €</p>
        </section>
        <section class="info_content">
            <p class="small_title">Nombre joueurs :</p>
            <p>2 à 6</p>
        </section>
        <section Complexité="info_content">
            <p class="small_title">Complexité :</p>
            <p>4</p>
        </section>
        <section class="info_content">
            <p class="small_title">Concentration :</p>
            <p>6</p>
        </section>
        <section class="info_content">
            <p class="small_title">Ambiance :</p>
            <p>5</p>
        </section>
    </section>

    <section class="box1">
        <p class="big_title">Descritpion :</p>
        <p>Le Monopoly est un jeu de société américain édité par Hasbro. Le but du jeu consiste à ruiner ses concurrents par des opérations immobilières. Il symbolise les aspects apparents et spectaculaires du capitalisme, les fortunes se faisant et se défaisant au fil des coups de dés. Ce jeu de société est mondialement connu, et il en existe de multiples versions.</p>
    </section>
            
    <?php include 'view/reviews.php'; ?>

</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>
