<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/style_account.css">

<section class="contents_page">

    <section id="my_info" class="box1">
    <?php if(isset($_GET['modify']) && isset($_SESSION['user'])){ if($_SESSION['user']->id()==$_GET['userId'] || $_SESSION['user']->admin()){ ?>
        <form method="post" id="modify_info">
            <section>
                <p class="small_title">Prénom :</p>
                <input type="text" max="255" name="firstName" value="<?php echo $userInfo->firstName(); ?>">
            </section>
            <Section>
                <p class="small_title">Nom :</p>
                <input type="text" max="255" name="lastName" value="<?php echo $userInfo->lastName(); ?>">
            </Section>
            <section>
                <p class="small_title">Date de naissance :</p>
                <input type="date" name="birthDate" value="<?php echo $userInfo->birthDate(); ?>">
            </section>
            <section>
                <p class="small_title">Email :</p>
                <input type="email" name="email" value="<?php echo $userInfo->email(); ?>">
            </section>
            <?php if($_SESSION['user']->admin()){ ?>
            <section>
                <p class="small_title">Administrateur</p>
                <input type="checkbox" name="admin" <?= $userInfo->admin() ? "checked" : "" ?> >
            </section>
            <?php }?>
            <input type="submit" value="Valider">
        </form>
    <?php }}else{ ?>
        <p id="name_user"><?php echo $userInfo->firstName() . " " . $userInfo->lastName(); ?></p>
        <section>
            <p class="small_title">Date de naissance :</p>
            <p><?php echo $userInfo->birthDate(); ?></p>
        </section>
        <section>
            <p class="small_title">Email :</p>
            <p><?php echo $userInfo->email(); ?></p>
        </section>
        <section>
            <p class="small_title">Date de création du compte</p>
            <p> <?php echo $userInfo->creationDate();?></p>
        </section>
       <?php if(isset($_SESSION['user'])){
            if($_SESSION['user']->id()==$_GET['userId'] || $_SESSION['user']->admin()){ ?>
                <a href="index.php?action=account&userId=<?=$_GET['userId']?>&modify=true">Modifier</a>
            <?php }elseif(isset($_SESSION['user'])){ // Else, if he is connected he can follow/unfollow the user
                    $fManager = new FollowManager($db);
                    $f = new Follow(array(
                        'followingId' => $_SESSION['user']->id(),
                        'followedId' => $_GET['userId']
                    ));
                    if(is_bool($fManager->get($f))){ // If he doesn't already follow the user, he can follow?> 
                        <a href="index.php?action=account&userId=<?php echo $_GET['userId']; ?>&follow=follow">Suivre</a>
        <?php }else{ // If he already follows the user, he can unfollow?>
                <a href="index.php?action=account&userId=<?php echo $_GET['userId']; ?>&follow=unfollow">Ne plus suivre</a>
        <?php }
        }}} ?>
    </section>
    
    <section id="bottom_page">
        <?php require 'controller/reviews.php'; ?>
        <section id="follows" class="box1">
            <p class="big_title">Utilisateurs suivis :</p>
            <ul>
                <?php if(isset($followedUsers)){ 
                    foreach($followedUsers as $value){ ?>
                    <li><a href="index.php?action=account&userId=<?php echo $value->id(); ?>"><?php echo $value->firstName() . " " . $value->lastName(); ?></a></li>
                <?php }
                }else{ ?>
                    <p>Vous ne suivez encore personnes. Pour suivre un utilisateur, cliquez sur son nom et cliquez sur "suivre" sur sa page.</p>
                <?php } ?>
            </ul>
        </section>
    </section>

    
    <?php if(isset($rfollowed)){?>
        <section id="follows_last_reviews" class="box1">
            <p class="big_title">Derniers avis postés des personnes suivis :</p>
            <?php foreach($rfollowed as $followed){ 
                if(!empty($followed)){ ?>
                    <p class="small_title" id=""><?php echo $followed[0]->user()->firstName() . " " . $followed[0]->user()->lastName(); ?></p>
                    <?php $r=$followed;
                    require 'controller/reviews.php'; ?>
                <?php }  
            } ?>
        </section>
    <?php } ?>
    
</section>

<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>