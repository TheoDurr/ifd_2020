<?php

if(!isset($_SESSION['user'])){ // Not logged
    $_SESSION['errors']['auth'] = "Vous devez vous connecter";
    header('Location: index.php?action=login&target=control_panel');
    die;
} elseif(!$_SESSION['user']->admin()){ // Not admin
    $_SESSION['errors']['permission'] = "Vous n'êtes pas autorisé à accéder à cette page";
    header('Location: index.php');
    die;
}

if(isset($_GET['id'])){
    $uM = new UserManager($db);
    $uM->delete(new User(array('id' => (int) $_GET['id'])));

} else {
    $_SESSION['errors']['invalidId'] = "Utilisateur introuvable";
}

header('Location: index.php?action=control_panel');
