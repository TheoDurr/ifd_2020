<?php
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