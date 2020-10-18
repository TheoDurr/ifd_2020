<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_game_page.css">

<section class="contents_page">
    <section id="picture_title">
        <img src="public/img/monopoly.jpg">
        <p>Monopoly</p>
    </section>

    <section class="box1" id="info">
        <section class="info_content">
            <p class="name_info">Editor :</p>
            <p>Hasbro</p>
        </section>
        <section class="info_content">
            <p class="name_info">Catégorie :</p>
            <p>Capitalisme</p>
        </section>
        <section class="info_content">
            <p class="name_info">Prix :</p>
            <p>25 €</p>
        </section>
        <section class="info_content">
            <p class="name_info">Nombre joueurs :</p>
            <p>2 à 6</p>
        </section>
        <section Complexité="info_content">
            <p class="name_info">Complexité :</p>
            <p>4</p>
        </section>
        <section class="info_content">
            <p class="name_info">Concentration :</p>
            <p>6</p>
        </section>
        <section class="info_content">
            <p class="name_info">Ambiance :</p>
            <p>5</p>
        </section>
    </section>

    <section class="box1">
        <p class="title_box">Descritpion :</p>
        <p>Le Monopoly est un jeu de société américain édité par Hasbro. Le but du jeu consiste à ruiner ses concurrents par des opérations immobilières. Il symbolise les aspects apparents et spectaculaires du capitalisme, les fortunes se faisant et se défaisant au fil des coups de dés. Ce jeu de société est mondialement connu, et il en existe de multiples versions.</p>
    </section>

    <section class="box1">
        <section class="top_box_review"> 
            <p class="title_box">Avis :</p>
            <section class="sort_section">
                <p>Trier par :</p>
                <form action="post">
                    <select name="sort_by" id="sort_by">
                        <option value="reaction">Intérêt</option>
                        <option value="date_desc">Date (plus récent)</option>
                        <option value="date_asc">Date (plus vieux)</option>
                    </select>
                </form>
                <p>1 avis (sur 173 avis)</p>
            </section>
        </section>

        <!--Intégration php des avis if(isset($_GET[id_avis]) && isset($_GET[show]))-->

        <section class="review">
            <section class="top_review" id="review1">
                <p>Cyrille STROESSER (à 00:01 le 18/10/2020)</p>
                <p>Note : 8/10</p>
            </section>
            <p>Je trouve ce jeu psarvtek bien mais il serait quand même beaucoup mieux si l'argent qu'on avait dedans était vrai, genre t'achètes un jeu 25 balles et dedans t'as des millions d'euros, ce serait du génie wallah, tout le monde l'acheterai du coup !!! mais bon les directeurs marketing sont encore trop cons pour avoir pensé à ça du coup je sais même plus quoi dire mais bon faut que ce commentaire soit long pour pouvoir tester l'affichage des retour à la ligne et tt bref je pense que c'est assez long là</p>
            <section class="bottom_review">
                <a href="index.php?action=game_page&id=1&id_avis=1&show=true#review1">3 commentaires</a>
                <form action="post">
                    <input type="submit" name="like" value="Pertinent">
                    <input type="submit" name="dislike" value="Pas pertinent">
                </form>
            </section>
            
            <?php if(isset($_GET['id_avis'])){ if($_GET['id_avis']==1 && $_GET['show']==true){ ?>
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
            </section>

            <?php };}; ?>
            
        <section class="review">
            <section class="top_review">
                <p>Cyrille STROESSER (à 00:01 le 18/10/2020)</p>
                <p>Note : 8/10</p>
            </section>
            <p>Je trouve ce jeu psartek bien mais il serait quand même beaucoup mieux si l'argent qu'on avait dedans était vrai, genre t'achètes un jeu 25 balles et dedans t'as des millions d'euros, ce serait du génie wallah, tout le monde l'acheterai du coup !!! mais bon les directeurs marketing sont encore trop cons pour avoir pensé à ça du coup je sais même plus quoi dire mais bon faut que ce commentaire soit long pour pouvoir tester l'affichage des retour à la ligne et tt bref je pense que c'est assez long là</p>
            <section class="bottom_review">
                <a href="">0 commentaire</a>
                <form action="post">
                    <input type="submit" name="like" value="Pertinent">
                    <input type="submit" name="dislike" value="Pas pertinent">
                </form>
            </section>
        </section>

        
        </section>

    </section>

</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>
