<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_account.css">

<section class="contents_page">

    <section id="my_info" class="box1">
    <?php if(isset($_GET['modify'])){ ?>
        <form action="post" id="modify_info">
            <section>
                <p class="small_title">Prénom :</p>
                <input type="text" max="255">
            </section>
            <Section>
                <p class="small_title">Nom :</p>
                <input type="text" max="255">
            </Section>
            <section>
                <p class="small_title">Date de naissance :</p>
                <input type="date">
            </section>
            <section>
                <p class="small_title">Email :</p>
                <input type="email">
            </section>
            <input type="submit" value="Valider">
        </form>
    <?php }else{ ?> 
        <p id="name_user">Cyrille STROESSER</p>
            <section>
                <p class="small_title">Date de naissance :</p>
                <p>18/06/01</p>
            </section>
            <section>
                <p class="small_title">Email :</p>
                <p>cyrille.stroesser@orange.fr</p>
            </section>
            <section>
                <p class="small_title">Date de naissance</p>
                <p>18/06/01</p>
            </section>
            <section>
                <p class="small_title">Date de création du compte</p>
                <p>18/10/2020</p>
            </section>
            <a href="index.php?action=account&modify=true">Modifier</a>
       
    <?php }; ?>
    </section>

    <?php include 'view/reviews.php'; ?>
    
</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>