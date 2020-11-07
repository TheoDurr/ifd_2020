<link rel="stylesheet" type="text/css" href="public/css/style_reviews.css">
<section class="box1" id="reviews">
    <section class="top_box_review">
        <?php if($_GET['action']=='account'){ ?>
            <p class="big_title">Derniers avis postés :</p>
        <?php }else{ ?>
            <p class="big_title">Avis :</p>
        <?php } ?>
        <section class="sort_section">
            <p>Trier par :</p>
            <form method="post">
                <select name="sortBy" id="sort_by" onchange="this.form.submit();">
                    <option value="reaction">Intérêt</option>
                    <option value="dateAsc" <?php if(isset($_POST['sortBy'])){if($_POST['sortBy']=='dateAsc'){ echo 'selected'; }} ?>>Date (plus récent)</option>
                    <option value="dateDesc"<?php if(isset($_POST['sortBy'])){if($_POST['sortBy']=='dateDesc'){ echo 'selected'; }} ?>>Date (plus vieux)</option>
                </select>
            </form>
            <p> <?php if(!empty($r)){echo sizeof($r); }else{ echo "0"; } ?> avis</p>
            <?php if($_GET['action']=='game_page'){
                if(isset($_SESSION['user'])){ if($_GET['action']=='game_page' && !isset($_GET['addReview'])){ ?>
                <a href="index.php?action=game_page&id=<?php echo $_GET['id']; ?>&addReview=true#addReview" class="btn1">Ajouter un avis</a>
                <?php }}else{ ?>
                <a href="index.php?action=login" class="btn1">Connectez-vous pour ajouter un avis</a>
                <?php } ?>
            <?php } ?>
        </section>
    </section>

    <!-- Add review -->

    <?php if(isset($_GET['addReview']) && $_GET['action']=='game_page'){ ?>
        <form method="post" class="review" id="addReview" action=<?=$_SERVER['REQUEST_URI']?>>
            <p class="small_title">Ajouter un avis :</p>
            <textarea cols="150" rows="8" placeholder="Ecrivez votre avis ici" name="contentReview"></textarea>
            <p>Note (Entre 0 et 10) :</p>
            <input type="number" min="0" max="10" step="1" name="score"> <br> <br>
            <input type="submit" value="Ajouter">
        </form>
    <?php } ?>

    <!--Integration reviews -->
    <?php if(!empty($r)){  //?>
    <?php foreach($r as $value){ ?> 
        <section class="review" id="review<?php echo $value->id(); ?>">
            <section class="top_review" id="review1">
                <p><a href="index.php?action=account&userId=<?php echo $value->user()->id(); ?>"><?php echo $value->user()->firstName() . " " . $value->user()->lastName(); ?></a> <?php echo " (" . $value->creationDate() . ")"; ?></p>
                <p>
                    Note : <?php echo $value->score(); ?>/10
                    <?php if(isset($_SESSION['user'])){
                        if($value->user()->id() == $_SESSION['user']->id()){ ?>                    
                    <span class="actions">
                        <a href="index.php?action=delete_review&id=<?=$value->id()?>"><img src="public/img/garbage.png" alt="garbage"></a>
                    </span>
                        <?php }
                    }?>
                </p>
            </section>
            <p><?php echo $value->content(); ?></p>
            <?php if($_GET['action']=='game_page'){ ?>
            <section class="bottom_review">
                <a href="index.php?action=game_page&id=<?php echo $_GET['id']; ?>&reviewId=<?php echo $value->id(); ?>&show=true#review<?php echo $value->id(); ?>">Commentaires</a>
                <?php if(isset($_SESSION['user'])){
                    $rManager = new ReactionManager($db); 
                    $a = $rManager->get(new Reaction(array("userId" => $_SESSION['user']->id(), "reviewId" => $value->id())));
                    if(!is_bool($a)){ ?>
                        <a <?php if($a[0]->type()==-1){?>href="index.php?action=game_page&id=<?php echo $_GET['id'];?>&reviewId=<?php echo $value->id();?>&reaction=1#review<?php echo $value->id();?>" <?php } ?>><img src="public/img/up.png"></a>
                        <p>Pertinence: <?php echo $value->totalReaction(); ?></p>
                        <a <?php if($a[0]->type()==1){?>href="index.php?action=game_page&id=<?php echo $_GET['id'];?>&reviewId=<?php echo $value->id();?>&reaction=-1#review<?php echo $value->id();?>" <?php } ?>><img src="public/img/down.png"></a>    
                    <?php }else{ ?>
                        <a href="index.php?action=game_page&id=<?php echo $_GET['id'];?>&reviewId=<?php echo $value->id();?>&reaction=1#review<?php echo $value->id();?>"><img src="public/img/up.png"></a>
                        <p>Pertinence: <?php echo $value->totalReaction(); ?></p>
                        <a href="index.php?action=game_page&id=<?php echo $_GET['id'];?>&reviewId=<?php echo $value->id();?>&reaction=-1#review<?php echo $value->id();?>"><img src="public/img/down.png"></a>
                    <?php }
                    }else{ ?>
                        <a href="index.php?action=login"><img src="public/img/up.png"></a>
                        <p>Pertinence: <?php echo $value->totalReaction(); ?></p>
                        <a href="index.php?action=login"><img src="public/img/down.png"></a>

                    <?php } ?>
            </section>
            <?php }; ?>

            <!-- Display reviews's comments -->
            
            <?php if(isset($_GET['reviewId'])&& isset($_GET['show'])){ if($_GET['reviewId']==$value->id() && $_GET['show']=='true'){ ?>
            <section class="comments_box">
                <?php if(!empty($c)){ foreach($c as $comment){ ?> 
                    <section class="comment">
                        <p class="comment_top"><?php echo $comment->user()->firstName() . " " . $comment->user()->lastName() . " (" .  $comment->creationDate() . ") :" ?></p>
                        <p> <?php echo $comment->content();?> </p>
                    </section>
                <?php }; };?>

                <!-- Add comments -->

                <?php if(isset($_SESSION['user'])){ 
                    if(!isset($_GET['addComment'])){ ?>
                    <a href="index.php?action=game_page&id=<?php echo $_GET['id']; ?>&reviewId=<?php echo $value->id(); ?>&show=true&addComment=true#review<?php echo $value->id(); ?>" class="btn1">Ajouter un commentaire</a>
                <?php }; }else{ ?>
                    <a href="index.php?action=login" class="btn1">Pour ajouter un commentaire, connectez-vous</a>
                <?php }; ?>
                <?php if(isset($_GET['show'])){ if(isset($_GET['addComment']) && $_GET['reviewId']==$value->id()){ ?>
                    <form method="post" cible="index.php?action=game_page&id=<?php echo $_GET['id'];?>&reviewId=<?php echo $value->id();?>&show=true#review<?php echo $value->id();?>">
                        <textarea cols="150" rows="8" placeholder="Ecrivez votre commenatire ici" name="contentComment"></textarea>
                        <input type="submit" value="Ajouter">
                    </form>
                <?php };}; ?>

            </section>
            <?php };}; ?>
        </section>
    <?php };};?>
</section>