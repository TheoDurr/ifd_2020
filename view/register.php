<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_register_login.css">
   
<section class="contents_page">
    <section class="box1" id="form_register">
    <p id="register_title" class="big_title">Se créer un compte</p>
        <form method="post">
            <p>Nom :</p>
            <input type="text" name="lastName" required>
            <p>Prénom :</p>
            <input type="text" name="firstName" required>
            <p>Email :</p>
            <input type="email" name="email" required>
            <p>date_naissance :</p>
            <input type="date" name="birthDate" required>
            <p>Mot de passe :</p>
            <input type="password" name="password" required>
            <p>Veuillez confimer votre mot de passe :</p>
            <input type="password" name="passwordConfirm" required> <br><br>
            <input type="submit" name="submit" value="Valider"> <br> <br>
            <a href="index.php?action=login">Se connecter</a>
        </form>
    </section>
</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>