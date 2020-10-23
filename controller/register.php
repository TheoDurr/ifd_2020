<?php
// If there is data
if(!empty($_POST)){
    if($_POST['password'] != $_POST['passwordConfirm']) {
        $errors['password'] = "Les mots de passe ne concordent pas.";
    }
    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['firstName'])){
        // one or more of the 'special characters' found in $_POST['firstName']
        $errors['firstName'] = "Le prénom contient des caractères invalides";
    }
    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['lastName'])){
        // one or more of the 'special characters' found in $_POST['firstName']
        $errors['lastName'] = "Le nom contient des caractères invalides";
    }
    
    if(empty($errors)){
        $uManager = new UserManager($db);
        if($uManager->search(array('email' => $_POST['email']))){
            $errors['exists'] = "Un compte avec cet email existe déjà";
        } else {
            $u = new User($_POST);
            $uManager->add($u);
            header('Location: index.php');
        }
    }    
}
require dirname(__FILE__) . '../../view/register.php';