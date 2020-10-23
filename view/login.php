<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_register_login.css">

<section class="contents_page">
    <section id="form_login" class="box1">
        <p id="connexion_title" class="title_box">Connexion</p>
            <form method="post">
                <p>Email :</p>
                <input type="text" name="email">
                <p>Mot de passe :</p>
                <input type="password" name="password"> <br><br>
                <input type="submit" name="valider"> <br> <br>
                <a href="index.php?action=register">Nouveau ? Se créer un compte</a>
            </form>
    </section>
 </section>

 <?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>