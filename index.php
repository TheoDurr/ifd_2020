<?php
/**
 * PHP router
 */
// Autoloader initialization
require_once 'function/autoload.php';
spl_autoload_register('autoloader');

// Autoloader initialization
require_once 'function/autoload.php';
spl_autoload_register('autoloader');

// DB Connection Initialization
$db = new PDO('mysql:host=92.140.139.116;dbname=ifd', 'admin', 'ifd2020');

try {
    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'login':
                require 'controller/login.php';
            break;
            case 'register':
                require 'controller/register.php';
            break;
            case 'games':
                require 'controller/games.php';
            break;
            case 'account':
                require 'controller/account.php';
            break;
            case 'game_page':
                    require 'controller/game_page.php';
            default:
                echo "error name action";
        }
    } else {
        // Home page
        require 'controller/home.php';
    }
} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    header('Location: error.php?errorMessage=' . $errorMessage);
}