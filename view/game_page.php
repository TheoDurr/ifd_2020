<?php ob_start(); ?>
<?php $g = $data['game']; ?>

<link rel="stylesheet" type="text/css" href="public/css/style_game_page.css">

<section class="contents_page">
    <section id="picture_title">
        <img src="data:image/jpeg;base64, <?= base64_encode($g->img())?>"/>
        <p><?= $g->name() ?></p>
    </section>

    <section class="box1" id="info">
        <section class="info_content">
            <p class="small_title">Editeur :</p>
            <p><?= $g->editor()->name() ?></p>
        </section>
        <section class="info_content">
            <p class="small_title">Catégorie :</p>
            <p><?= $g->category()->name() ?></p>
        </section>
        <section class="info_content">
            <p class="small_title">Prix :</p>
            <p><?= $g->price() ?> €</p>
        </section>
        <section class="info_content">
            <p class="small_title">Nombre joueurs :</p>
            <p><?= $g->playersMin() ?> à <?= $g->playersMax() ?></p>
        </section>
        <section Complexité="info_content">
            <p class="small_title">Complexité :</p>
            <p><?= $g->complexity() ?></p>
        </section>
        <section class="info_content">
            <p class="small_title">Concentration :</p>
            <p><?= $g->concentration() ?></p>
        </section>
        <section class="info_content">
            <p class="small_title">Ambiance :</p>
            <p><?= $g->ambiance() ?></p>
        </section>
    </section>

    <section class="box1">
        <p class="big_title">Descritpion :</p>
        <p><?= $g->description() ?></p>
    </section>
            
    <?php include 'view/reviews.php'; ?>

</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>
