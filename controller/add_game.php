<?php
if (!empty($_POST)){
    $GManager = new GameManager($db);
    if($_POST['name']==''){
        $_SESSION['errors']['name']="Le nom du jeu n'est pas référencé";
    }
    else if ($GManager->get(new Game(array('name' =>$_POST['name'])))){
        // If the name exits in the DB
        $_SESSION['errors']['name'] = "Ce jeu a déjà été ajouté"; 
    }


    if($_POST['editor']==''){
        $_SESSION['errors']['editor']="L'éditeur du jeu n'a pas été référencé";
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['editor'])){
            // If the editor doesn't respect the synthax
            $_SESSION['errors']['editor'] = "L'éditeur contient des caractères spéciaux invalides";
    }


    if($_POST['description']==''){
        $_SESSION['errors']['description']="Veuillez ajouter une courte description";
    }

    if ($_FILES['image']['name']!='') // if there is a picture
    {
        $mesErrors='';
        $GManager->UploadPicture($mesErrors);
        $_SESSION['errors']['image']=$mesErrors;
    }
    

    if($_POST['category']==0){
        $_SESSION['errors']['category']="La catégorie n'a pas été référencée";
    }


    if($_POST['price']==''){
        $_SESSION['errors']['price']="Le prix du jeu n'a pas été référencé";
    }


    if($_POST['playersMin']==''){
        $_SESSION['errors']['playersMin']="Veuillez rentrer le nombre de joueur minimum";
    }
    if($_POST['playersMax']==''){
        $_SESSION['errors']['playersMax']="Veuillez rentrer le nombre de joueur maximum";
    }
    else if($_POST['playersMin']>$_POST['playersMax']){
        $_SESSION['errors']['playersMin']="Vous devez entrer un nombre de joueur minimum inférieure au nombre maximum";
    }

    if(empty($errors)){
        $g = new Game($_POST);
        $g->setImg(file_get_contents("/xampp/htdocs/ifd_2020/public/img/" . $_FILES['image']['name']));
        $GManager->add($g);
    }


}
require dirname(__FILE__) . '../../view/add_game.php';
