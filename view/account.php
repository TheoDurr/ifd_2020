<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_account.css">

<section class="contents_page">

    <section id="my_info" class="box1">
    <?php if(isset($_GET['modify'])){ ?>
        <form method="post" id="modify_info">
            <section>
                <p class="small_title">Prénom :</p>
                <input type="text" max="255" name="firstName" value="<?php echo $_SESSION['user']->firstName(); ?>">
            </section>
            <Section>
                <p class="small_title">Nom :</p>
                <input type="text" max="255" name="lastName" value="<?php echo $_SESSION['user']->lastName(); ?>">
            </Section>
            <section>
                <p class="small_title">Date de naissance :</p>
                <input type="date" name="birthDate" value="<?php echo $_SESSION['user']->birthDate(); ?>">
            </section>
            <section>
                <p class="small_title">Email :</p>
                <input type="email" name="email" value="<?php echo $_SESSION['user']->email(); ?>">
            </section>
            <input type="submit" value="Valider">
        </form>
    <?php }else{ ?>
        <p id="name_user"><?php echo $_SESSION['user']->firstName() . " " . $_SESSION['user']->lastName(); ?></p>
            <section>
                <p class="small_title">Date de naissance :</p>
                <p><?php echo $_SESSION['user']->birthDate(); ?></p>
            </section>
            <section>
                <p class="small_title">Email :</p>
                <p><?php echo $_SESSION['user']->email(); ?></p>
            </section>
            <section>
                <p class="small_title">Date de création du compte</p>
                <p> <?php echo $_SESSION['user']->creationDate();?></p>
            </section>
            <a href="index.php?action=account&modify=true">Modifier</a>
       
    <?php }; ?>
    </section>

    <?php include 'view/reviews.php'; ?>
    
</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>