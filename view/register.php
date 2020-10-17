<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_register_login.css">
   
<section class="contents_page">
    <section class="box1" id="form_register">
    <p id="register_title" class="title_box">Se créer un compte</p>
        <form action="post">
            <p>Nom :</p>
            <input type="text" name="nom">
            <p>Prénom :</p>
            <input type="text" name="prenom">
            <p>Email :</p>
            <input type="text" name="email">
            <p>date_naissance :</p>
            <input type="date" name="date_naissance">
            <p>Mot de passe :</p>
            <input type="password" name="password">
            <p>Veuillez confimer votre mot de passe :</p>
            <input type="password" name="password"> <br><br>
            <input type="submit" name="valider"> <br> <br>
            <a href="index.php?action=login">Se connecter</a>
        </form>
    </section>
</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>