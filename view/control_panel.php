<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/admin_pages.css">


<section class="contents_page">
    
<div class="content">
    <h1>Panneau d'administration</h1>

    <h2>Statistiques</h2>

    <div class="stats">
        <div class="stat_elt">
            <h3>Utilisateurs</h3>
            <span><strong><?= $stats['users'] ?></strong></span>
        </div>
        <div class="stat_elt">
            <h3>Jeux </h3>
            <span><strong><?= $stats['games'] ?></strong></span>
        </div>
        <div class="stat_elt">
            <h3>Avis</h3>
            <span><strong><?= $stats['reviews'] ?></strong></span>
        </div>
        <div class="stat_elt">
            <h3>Commentaires</h3>
            <span><strong><?= $stats['comments'] ?></strong></span>
        </div>
    </div>

    <div class="column">
    <div class="users">
        <table>
            <caption>Utilisateurs</caption>
            <thead>
                <th class="action">Actions</th>
                <th>Nom</th>
                <th>Adresse mail</th>
                <th>Date de création du compte</th>
            </thead>

            <?php

            foreach($data['users'] as $u){?>
            <tr>
                <td>
                    <?php if($_SESSION['user']->id() != $u->id()){ ?>
                    <a href="index.php?action=delete_user&id=<?=$u->id()?>">
                        <img src="public/img/garbage.png" alt="delete user" class="action_icon">
                    </a>
                    <a href="index.php?action=edit_user&id=<?=$u->id()?>">
                        <img src="public/img/edit.png" alt="edit user" class="action_icon">
                    </a>
                    <?php }?>
                </td>
                <td>
                    <?= $u->firstName() . " " . $u->lastName()?> <?php if($_SESSION['user']->id() == $u->id()){echo "(Vous)";}?>
                </td>
                <td>
                    <?= $u->email()?>
                </td>
                <td>
                    <?= $u->creationDate() ?>
                </td>
            </tr>
            <tr>
                
            </tr>
            <?php }

            ?>
        </table>
    </div>

    <div class="games">
        <table>
                <caption>Jeux enregistrés</caption>
                <thead>
                    <th class="action">Actions</th>
                    <th>Nom</th>
                    <th>Editeur</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                </thead>

                <?php

                foreach($data['games'] as $g){?>
                <tr>
                    <td>
                        <a href="index.php?action=delete_game&id=<?=$g->id()?>">
                            <img src="public/img/garbage.png" alt="delete game" class="action_icon">
                        </a>
                        <a href="index.php?action=edit_game&id=<?=$g->id()?>">
                            <img src="public/img/edit.png" alt="edit game" class="action_icon">
                        </a>
                    </td>
                    <td>
                        <?= $g->name()?>
                    </td>
                    <td>
                        <?= $g->editor()->name()?>
                    </td>
                    <td>
                        <?= $g->category()->name() ?>
                    </td>
                    <td>
                        <?= $g->price() ?>€
                    </td>
                </tr>
                <tr>
                    
                </tr>
                <?php }

                ?>
        </table>
    </div>
    </div>
</div>

</section>  

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>