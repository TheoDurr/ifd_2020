<?php ob_start(); ?>

<section id="corps">
    <section id="contenu">
        <p id="titre_connexion">Connexion</p>
            <form action="post">
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