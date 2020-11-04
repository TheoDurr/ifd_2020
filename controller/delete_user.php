<?php
if(!isset($_SESSION['user'])){
    // Not logged
    $_SESSION['errors']['auth'] = "Vous devez vous connecter";
    header('Location: index.php?action=login&target=control_panel');
} elseif(!$_SESSION['user']->admin()){
    // Not admin
    $_SESSION['errors']['permission'] = "Vous n'êtes pas autorisé à accéder à cette page";
    header('Location: index.php');
}

if(isset($_GET['id'])){
    $u = new User(array(
        'id' => (int) $_GET['id']
    ));
    // Deletes user's reviews
    $rM = new ReviewManager($db);
    $reviews = $rM->get(new Review(array(
        'userId' => $u->id()
    )));

    foreach($reviews as $r){
        $rM->delete($r);
    }

    $rM = new CommentManager($db);
    $comments = $rM->get(new Comment(array(
        'userId' => $u->id()
    )));

    foreach($comments as $c){
        $rM->delete($c);
    }

    $uM = new UserManager($db);
    $uM->delete($u);

} else {
    $_SESSION['errors']['invalidId'] = "Utilisateur introuvable";
}

header('Location: index.php?action=control_panel');
