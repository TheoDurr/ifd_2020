<?php
/**
 * PHP router
 */
// Autoloader initialization
require_once 'function/autoload.php';
spl_autoload_register('autoloader');
session_start();

if(!isset($_SESSION['errors'])){
    $_SESSION['errors'] = array();
}
// DB Connection Initialization
$db = new PDO('mysql:host=90.126.235.250;dbname=ifd', 'admin', 'ifd2020');
$db->query("SET FOREIGN_KEY_CHECKS=0");

try {
    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'login':
                require 'controller/login.php';
            break;
            case 'logout':
                require 'controller/logout.php';
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
            break;
            case 'add_game':
                require 'controller/add_game.php';
            break;
            case 'control_panel':
                require 'controller/control_panel.php';
            break;
            case 'delete_user':
                require 'controller/delete_user.php';
            break;
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