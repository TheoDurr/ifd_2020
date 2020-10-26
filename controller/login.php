<?php

if(!empty($_POST)){
    $uManager = new UserManager($db);
    $result = $uManager->get(new User(array('email' => $_POST['email'])));
    if(!$result){
        $_SESSION['errors']['email'] = "Compte introuvable";
    }else{
        if(password_verify($_POST['password'], $result[0]->password())){
            $_SESSION['user'] = $result[0];
            header("Location: index.php");
        }else{
            $_SESSION['errors']['password'] = "Le mot de passe est incorrect";
        }
    }
}

require dirname(__FILE__) . '../../view/login.php';