<?php
/**
 * PHP router
 */

try {
    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'login':
                require 'controller/login.php';
            case 'register':
                require 'controller/register.php';
        }
    } else {
        // Home page
        require 'controller/home.php';
    }
} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    header('Location: error.php?errorMessage=' . $errorMessage);
}