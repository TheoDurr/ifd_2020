<?php
if(isset($_SESSION['user'])){
    // User already logged
    header("Location: index.php?action=account");
}

// If there is data
if(!empty($_POST)){
    if($_POST['password'] != $_POST['passwordConfirm']) {
        $_SESSION['errors']['password'] = "Les mots de passe ne concordent pas.";
    }
    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['firstName'])){
        // one or more of the 'special characters' found in $_POST['firstName']
        $_SESSION['errors']['firstName'] = "Le prénom contient des caractères invalides";
    }
    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['lastName'])){
        // one or more of the 'special characters' found in $_POST['firstName']
        $_SESSION['errors']['lastName'] = "Le nom contient des caractères invalides";
    }
    
    if(empty($_SESSION['errors'])){
        $uManager = new UserManager($db);
        if($uManager->get(new User(array('email' => $_POST['email'])))){
            $_SESSION['errors']['exists'] = "Un compte avec cet email existe déjà";
        } else {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $u = new User($_POST);
            $uManager->add($u);
            $u = $uManager->get(new User(array('email' => $_POST['email'])));

            header('Location: index.php');
        }
    }    
}
require dirname(__FILE__) . '../../view/register.php';