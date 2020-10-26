<?php

if(isset($_GET['id']) && (int) $_GET['id']){
    $gManager = new GameManager($db);
    $result = $gManager->get(new Game(array(
        'id' => (int) $_GET['id']
    )));
    if($result){
        $data['game'] = $result; 
    } else {
        $_SESSION['errors']['game'] = "Jeu introuvable";
        header('Location: index.php?action=games');
    }
} else {
    header('Location: index.php?action=games');
}

require dirname(__FILE__) . '../../view/game_page.php';