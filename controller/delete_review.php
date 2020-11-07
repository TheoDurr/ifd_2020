<?php

if(!isset($_SESSION['user'])){
    // Not logged
    $_SESSION['errors']['auth'] = "Vous devez vous connecter";
    header('Location: index.php?action=login');
    die;
} elseif(!$_SESSION['user']->admin()){
    // Not admin
    $_SESSION['errors']['permission'] = "Vous n'êtes pas autorisé à effectuer cette action";
    header('Location: index.php');
    die;
}

if(isset($_GET['id'])){
    $uM = new ReviewManager($db);
    $uM->delete(new Review(array('id' => (int) $_GET['id'])));

} else {
    $_SESSION['errors']['invalidId'] = "Avis introuvable";
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
