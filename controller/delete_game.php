<?php
if(!isset($_SESSION['user'])){
    // Not logged
    $_SESSION['errors']['auth'] = "Vous devez vous connecter";
    header('Location: index.php?action=login&target=control_panel');
} elseif(!$_SESSION['user']->admin()){
    // Not admin
    $_SESSION['errors']['permission'] = "Vous n'êtes pas autorisé à accéder à cette page";
    header('Location: index.php');
}

if(isset($_GET['id'])){
    $gM = new GameManager($db);
    $gM->delete(new Game(array('id' => (int) $_GET['id'])));

} else {
    $_SESSION['errors']['invalidId'] = "Utilisateur introuvable";
}

header('Location: index.php?action=control_panel');
