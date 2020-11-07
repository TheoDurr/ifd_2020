<?php

// Get the game's informations
if(isset($_GET['id']) && (int) $_GET['id']){
    $gManager = new GameManager($db);
    $result = $gManager->get(new Game(array(
        'id' => (int) $_GET['id']
    )));
    if($result){
        $data['game'] = $result[0]; 
    } else {
        $_SESSION['errors']['game'] = "Jeu introuvable";
        header('Location: index.php?action=games');
    }
} else {
    header('Location: index.php?action=games');
}

// Get the game's reviews
if(isset($_GET['id'])){
    $rManager = new ReviewManager($db);
    $r = $rManager->get(new Review(array("gameId" => $_GET['id'])));
    if(isset($_GET['reviewId']) && isset($_GET['show'])){
        $cManager = new CommentManager($db);
        $c = $cManager->get(new Comment(array('reviewId' => $_GET['reviewId'])));
    }
}

$tabName = $data['game']->name();

require dirname(__FILE__) . '../../view/game_page.php';