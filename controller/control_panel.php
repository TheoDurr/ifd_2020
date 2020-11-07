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

$uM = new UserManager($db);
$data['users'] = $uM->get();

$gM = new GameManager($db);
$data['games'] = $gM->get();

// Stat model
require dirname(__FILE__) . '../../model/stats.php';

// View
require dirname(__FILE__) . '../../view/control_panel.php';
