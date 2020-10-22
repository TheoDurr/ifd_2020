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

    <section id="last_reviews" class="box1">

        <p class="big_title">My last reviews</p>

        <!--Integration reviews with if(isset($_GET[id_review]) && isset($_GET[show]))-->

        <section class="review">
            <section class="top_review" id="review1">
                <p>Cyrille STROESSER (à 00:01 le 18/10/2020)</p>
                <p>Note : 8/10</p>
            </section>
            <p>Je trouve ce jeu psarvtek bien mais il serait quand même beaucoup mieux si l'argent qu'on avait dedans était vrai, genre t'achètes un jeu 25 balles et dedans t'as des millions d'euros, ce serait du génie wallah, tout le monde l'acheterai du coup !!! mais bon les directeurs marketing sont encore trop cons pour avoir pensé à ça du coup je sais même plus quoi dire mais bon faut que ce commentaire soit long pour pouvoir tester l'affichage des retour à la ligne et tt bref je pense que c'est assez long là</p>
            <section class="bottom_review">
                <a href="index.php?action=game_page&id=1&id_review=1&show=true#review1">3 commentaires</a>
                <form action="post">
                    <input type="submit" name="like" value="Pertinent">
                    <input type="submit" name="dislike" value="Pas pertinent">
                </form>
            </section>

            <!-- Display reviews's comments -->
            
            <?php if(isset($_GET['id_review'])){ if($_GET['id_review']==1 && $_GET['show']=='true'){ ?>
            <section class="comments_box">
                <section class="comment">
                    <p class="comment_top">Théo DURR (à 23:17 le 18/10/2020) :</p>
                    <p>Je suis ton plus grand fan Cyrille !!!!!</p>
                </section>
                <section class="comment">
                    <p class="comment_top">Esteban LELIBOUX (à 23:19 le 18/10/2020) :</p>
                    <p>Wouah mais ce site est tellement bien fait ! Comment fas-tu pour être si bon en html/css siril ?!?! </p>
                </section>
                <section class="comment">
                    <p class="comment_top">Cyrille STROESSER (à 23:21 le 18/10/2020) :</p>
                    <p>FIRST</p>
                </section>
                <section class="comment">
                    <p class="comment_top">Cyrille STROESSER (à 23:21 le 18/10/2020) :</p>
                    <p>FIRST</p>
                </section>
                <section class="comment">
                    <p class="comment_top">Cyrille STROESSER (à 23:21 le 18/10/2020) :</p>
                    <p>FIRST</p>
                </section>
                <section class="comment">
                    <p class="comment_top">Cyrille STROESSER (à 23:21 le 18/10/2020) :</p>
                    <p>FIRST</p>
                </section>

                <!-- Add comments -->

                <?php if(isset($_SESSION)){?>
                    <?php if(!isset($_GET['modify'])){ ?>
                    <a href="index.php?action=game_page&id=1&id_review=1&show=true&modify=true#review1" class="add_comment">Ajouter un commentaire</a>
                <?php }; }else{ ?>
                    <a href="index.php?action=login" class="add_comment">Pour ajouter un commentaire, connectez-vous</a>
                <?php }; ?>
                <?php if(isset($_GET['show']) && isset($_GET['modify']) ){ ?>
                    <form action="post" >
                        <textarea cols="150" rows="8" placeholder="Ecrivez votre commenatire ici"></textarea>
                        <input type="submit" value="Ajouter">
                    </form>
                <?php }; ?>
            </section>
            <?php };}; ?>
        </section>
            
       <!--Integration reviews with if(isset($_GET[id_review]) && isset($_GET[show]))-->

       <section class="review">
            <section class="top_review" id="review2">
                <p>Cyrille STROESSER (à 00:01 le 18/10/2020)</p>
                <p>Note : 8/10</p>
            </section>
            <p>Je trouve ce jeu psarvtek bien mais il serait quand même beaucoup mieux si l'argent qu'on avait dedans était vrai, genre t'achètes un jeu 25 balles et dedans t'as des millions d'euros, ce serait du génie wallah, tout le monde l'acheterai du coup !!! mais bon les directeurs marketing sont encore trop cons pour avoir pensé à ça du coup je sais même plus quoi dire mais bon faut que ce commentaire soit long pour pouvoir tester l'affichage des retour à la ligne et tt bref je pense que c'est assez long là</p>
            <section class="bottom_review">
                <a href="index.php?action=game_page&id=2&id_review=2&show=true#review2">0 commentaire</a>
                <form action="post">
                    <input type="submit" name="like" value="Pertinent">
                    <input type="submit" name="dislike" value="Pas pertinent">
                </form>
            </section>

            <!-- Display reviews's comments -->
            
            <?php if(isset($_GET['id_review'])){ if($_GET['id_review']==2 && $_GET['show']=='true'){ ?>
            <section class="comments_box">

                <!-- Add comments -->

                <?php if(isset($_SESSION)){?>
                    <?php if(!isset($_GET['modify'])){ ?>
                    <a href="index.php?action=game_page&id=1&id_review=2&show=true&modify=true#review2" class="add_comment">Ajouter un commentaire</a>
                <?php  }; }else{ ?>
                    <a href="index.php?action=login" class="add_comment">Pour ajouter un commentaire, connectez-vous</a>
                <?php }; ?>
                <?php if(isset($_GET['modify'])){ if($_GET['id_review']){ ?>
                    <form action="post" >
                        <textarea cols="150" rows="8" placeholder="Ecrivez votre commenatire ici"></textarea>
                        <input type="submit" value="Ajouter">
                    </form>
                <?php }; }; ?>
            </section>
            <?php };}; ?>
        </section>

</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>