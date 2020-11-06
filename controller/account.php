<?php
    // If no user is specify, redirection to his own page
    if(!isset($_GET['userId']) && isset($_SESSION['user'])){
        $_GET['userId'] = $_SESSION['user']->id();
    }elseif(!isset($_GET['userId']) && !isset($_SESSION['user'])){
        $_SESSION['errors']['account'] = "Pour accéder à votre compte, vous devez d'abord vous connecter";
        header('location : index.php');
    }

    $uManager = new UserManager($db);

    if($_SESSION['user']->id()==$_GET['userId']){ // The account page is the user's account
        if(!empty($_POST)){ // If the user want to modify his information (if there is data)
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
                $uManager->update($_SESSION['user']);
                header('location: index.php?action=account');
            }
        }
        $userInfo = $_SESSION['user'];
    }else{
        $userInfo = $uManager->get(new User(array("id" => $_GET['userId'])));
    }



    

    require dirname(__FILE__) . '../../view/account.php';