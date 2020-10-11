<?php
/**
 * PHP router
 */
// Autoloader initialization
require_once 'function/autoload.php';
spl_autoload_register('autoloader');

try {
    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'login':
                require 'controller/login.php';
            case 'register':
                require 'controller/register.php';
            case 'games':
                require 'controller/games.php';
        }
    } else {
        // Home page
        require 'controller/home.php';
    }
} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    header('Location: error.php?errorMessage=' . $errorMessage);
}