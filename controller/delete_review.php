<?php

if(!isset($_SESSION['user'])){
    // Not logged
    $_SESSION['errors']['auth'] = "Vous devez vous connecter";
    header('Location: index.php?action=login');
}

if(isset($_GET['id'])){
    $rM = new ReviewManager($db);
    $reviewToDelete = new Review(array('id' => (int) $_GET['id']));

    // Checking authorization
    if(!$result = $rM->get($reviewToDelete)){
        $_SESSION['errors']['invalidId'] = "Avis introuvable";
    } elseif($result[0]->userId() == $_SESSION['user']->id() || $_SESSION['user']->admin()){
        $rM->delete($reviewToDelete);
    } else {
        $_SESSION['errors']['authorization'] = "Vous n'êtes pas autorisé à supprimer cet avis";
    }
} else {
    $_SESSION['errors']['invalidId'] = "Avis introuvable";
}

if(isset($_GET['gameId'])){
    header('Location: index.php?action=game_page&id='. $_GET['gameId']);

} elseif(isset($_GET['userId'])){
    header('Location: index.php?action=account&userId='. $_GET['userId']);

} else {
    $_SESSION['errors']['redirection'] = "redirection impossible (l'avis a bien été supprimé)";
}

