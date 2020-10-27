<?php

if(isset($_SESSION['user'])){
    if(!empty($_POST)){ // If there is data
        if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['firstName'])){
            // one or more of the 'special characters' found in $_POST['firstName']
            $_SESSION['errors']['firstName'] = "Le prénom contient des caractères invalides";
        }
        if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['lastName'])){
            // one or more of the 'special characters' found in $_POST['lastName']
            $_SESSION['errors']['lastName'] = "Le nom contient des caractères invalides";
        }
        if(empty($errors)){
            $_SESSION['user']->setFirstName($_POST['firstName']);
            $_SESSION['user']->setLastName($_POST['lastName']);
            $_SESSION['user']->setBirthDate($_POST['birthDate']);
            $_SESSION['user']->setEmail($_POST['email']);
            $uManager = new UserManager($db);
            $uManager->update($_SESSION['user']);
            header('location: index.php?action=account');
        }
    }
}else{
    $_SESSION['errors']['connection'] = "Pour accéder à votre compte, vous devez d'abord vous connecter";
    header('location : index.php');
}

require dirname(__FILE__) . '../../view/account.php';