<?php

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

$tabName = $data['game']->name();
require dirname(__FILE__) . '../../view/game_page.php';