<?php
    $uManager = new UserManager($db);
    $fManager = new FollowManager($db);
    $rManager = new ReviewManager($db);
    $gManager = new GameManager($db);

    // If no user is specify, redirection to his own page
    if(!isset($_GET['userId']) && isset($_SESSION['user'])){
        $_GET['userId'] = $_SESSION['user']->id();
    }elseif(!isset($_GET['userId']) && !isset($_SESSION['user'])){
        $_SESSION['errors']['account'] = "Pour accéder à votre compte, vous devez d'abord vous connecter";
        header('location : index.php');
    }

    // If the user want to modify his information (if there is data)
    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['birthDate']) && isset($_POST['email'])){
        if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['firstName'])){
            // one or more of the 'special characters' found in $_POST['firstName']
            $_SESSION['errors']['firstName'] = "Le prénom contient des caractères invalides";
        }
        if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['lastName'])){
            // one or more of the 'special characters' found in $_POST['lastName']
            $_SESSION['errors']['lastName'] = "Le nom contient des caractères invalides";
        }
        if(empty($errors)){
            $_SESSION['user']->setFirstName($_POST['firstName']);
            $_SESSION['user']->setLastName($_POST['lastName']);
            $_SESSION['user']->setBirthDate($_POST['birthDate']);
            $_SESSION['user']->setEmail($_POST['email']);
            $uManager->update($_SESSION['user']);
            header('location: index.php?action=account');
        }
    }

    // Look for the user in the db
    if(isset($_GET['userId'])){
        $userInfo = $uManager->get(new User(array("id" => $_GET['userId'])));
        if(is_bool($userInfo)){
            $_SESSION['errors']['userId']="L'utilisateur que vous cherchez n'existe pas";
            header('Location: index.php');
        }else{
            $userInfo = $userInfo[0];
        }
    }

    // Follow/Unfollow
    if(isset($_GET['follow']) && isset($_SESSION['user'])){
        $f = new Follow(array(
            'followingId' => $_SESSION['user']->id(),
            'followedId' => $_GET['userId']
        ));
        if($_GET['follow']=='follow'){
            if(is_bool($fManager->get($f))){
                $fManager->add($f);
            }else{
                $_SESSION['errors']['follow']="Vous suivez déjà ce compte";
            }
        }elseif($_GET['follow']=='unfollow'){
            if(!empty($fManager->get($f))){
                $fManager->delete($f);
            }else{
                $_SESSION['errors']['follow']="Vous ne suivez pas ce compte";
            }
        }
    }

    // Get the followed user's name
    if(isset($_GET['userId'])){
        $a = $fManager->get(new Follow(array('followingId' => $_GET['userId'])));
        if(!empty($a)){
            $followedIds = array();
            foreach($a as $value){
                $followedIds[] = $value->followedId();
            }
            $followedUsers = array();
            foreach($followedIds as $value){
                $followedUsers[] = $uManager->get(new User(array('id'=> $value)))[0]; 
            }
        }
    }

    // Get the user's reviews
    if(isset($_GET['userId'])){
        $r = $rManager->get(new Review(array('userId' => $_GET['userId'])));
        if(!is_bool($r)){
            $gamesNames = array();
            foreach($r as $value){ // Get each corresponding game's name
                $gamesNames[] = $gManager->get(new Game(array('id' => $value->gameId())))[0]->name();
            }
        }
    }

    // Get the followed users' reviews 
    if(isset($_GET['userId']) && isset($followedUsers[0])){
        if(!is_bool($followedUsers[0])){
            $rfollowed = array();
            foreach($followedUsers as $value){
                $rfollowed[] = $rManager->get(new Review(array('userId' => $value->id())));
            }
        }
    }


    require dirname(__FILE__) . '../../view/account.php';