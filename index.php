<?php
/**
 * PHP router
 */

try {
    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'login':
                require 'view/login.php';
            case 'register':
                require 'view/register.php';
        }
    }
} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require 'view/error.php';
}