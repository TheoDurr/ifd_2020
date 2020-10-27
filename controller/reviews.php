<?php

// Game's review
if($_GET['action']=='game_page' && isset($_GET['id'])){
    $rManager = new ReviewManager($db);
    $r = $rManager->get(new Review(array("gameId" => $_GET['id'])));
    if(isset($_GET['id_review']) && isset($_GET['show'])){
        $cManager = new CommentManager($db);
        $c = $cManager->get(new Comment(array('reviewId' => $_GET['id_review'])));
    }
}

// User's review
if($_GET['action']=='account' && isset($_SESSION['user'])){
    $rManager = new ReviewManager($db);
    $r = $rManager->get(new Review(array("userId" => $_SESSION['user']->id())));
    if(isset($_GET['id_review']) && isset($_GET['show'])){
        $cManager = new CommentManager($db);
        $c = $cManager->get(new Comment(array('reviewId' => $_GET['id_review'])));
    }
}

require dirname(__FILE__) . '../../view/reviews.php';