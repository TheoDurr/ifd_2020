<?php

//Add a review

if(isset($_POST['contentReview']) && isset($_SESSION['user'])){
    $r = new Review(array(
        'gameId' => $_GET['id'],
        'score' => $_POST['score'],
        'content' => $_POST['contentReview'],
        'userId' => $_SESSION['user']->id()
    ));
    $rManager = new ReviewManager($db);
    $rManager->add($r);
}

// Add a Comment 
if(isset($_POST['contentComment']) && isset($_SESSION['user'])){
    $c = new Comment(array(
        'userId' => $_SESSION['user']->id(),
        'content' => $_POST['contentComment'],
        'reviewId' => $_GET['reviewId']
    ));
    $cManager = new CommentManager($db);
    $cManager->add($c);
}

// Add a reaction

if(isset($_GET['reaction']) && isset($_SESSION['user'])){
    $rManager = new ReactionManager($db); 
    $a = $rManager->get(new Reaction(array("userId" => $_SESSION['user']->id(), "reviewId" => $_GET['reviewId'])));
    if(!is_bool($a)){
        $rManager->update(new Reaction(array(
            "userId" => $_SESSION['user']->id(),
            "reviewId" => $_GET['reviewId'],
            "type" => $_GET['reaction']
        )));
    }else{
    $rManager->add(new Reaction(array(
        "userId" => $_SESSION['user']->id(),
        "reviewId" => $_GET['reviewId'],
        "type" => $_GET['reaction']
    )));
    }
}

// Game's review
if($_GET['action']=='game_page' && isset($_GET['id'])){
    $rManager = new ReviewManager($db);
    $r = $rManager->get(new Review(array("gameId" => $_GET['id'])));
    if(isset($_GET['reviewId']) && isset($_GET['show'])){
        $cManager = new CommentManager($db);
        $c = $cManager->get(new Comment(array('reviewId' => $_GET['reviewId'])));
    }
}

// User's review
if($_GET['action']=='account'){
    $rManager = new ReviewManager($db);
    if(isset($_GET['userId'])){
        $r = $rManager->get(new Review(array('userId' => $_GET['userId'])));
    }elseif(isset($_SESSION['user'])){
        $r = $rManager->get(new Review(array('userId' => $_SESSION['user']->id())));
    }else{
        $r = false;
    }
}

require dirname(__FILE__) . '../../view/reviews.php';