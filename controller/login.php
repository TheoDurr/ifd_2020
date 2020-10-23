<?php

if(!empty($_POST)){
    $uManager = new UserManager($db);
    $result = $uManager->search(array('email' => $_POST['email']));
    if(!$result){
        $errors['email'] = "Compte introuvable";
    }else{
        if(password_verify($_POST['password'], $result[0]->password())){
            $_SESSION['user'] = $result;
            header("Location: index.php");
        }else{
            $errors['password'] = "Le mot de passe est incorrect";
        }
    }
}

require dirname(__FILE__) . '../../view/login.php';