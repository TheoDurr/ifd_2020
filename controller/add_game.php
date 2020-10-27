<?php
if (!empty($_POST)){
    $GManager = new GameManager($db);
    if($_POST['name']==''){
        $errors['name']="Le nom du jeu n'est pas référencé";
    }
    else if ($GManager->search(array('name' =>$_POST['name']))){
        // If the name exits in the DB
        $errors['name'] = "Ce jeu a déjà été ajouté"; 
    }


    if($_POST['editor']==''){
        $errors['editor']="L'éditeur du jeu n'a pas été référencé";
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['editor'])){
            // If the editor doesn't respect the synthax
            $errors['editor'] = "L'éditeur contient des caractères spéciaux invalides";
    }


    if($_POST['description']==''){
        $errors['description']="Veuillez ajouter une courte description";
    }

    if ($_FILES['image']['name']!='') // if there is a picture
    {
        $mesErrors='';
        $GManager->UploadPicture($mesErrors);
        $errors['image']=$mesErrors;
    }
    

    if($_POST['category']==0){
        $errors['category']="La catégorie n'a pas été référencée";
    }


    if($_POST['price']==''){
        $errors['price']="Le prix du jeu n'a pas été référencé";
    }


    if($_POST['playersMin']==''){
        $errors['playersMin']="Veuillez rentrer le nombre de joueur minimum";
    }
    if($_POST['playersMax']==''){
        $errors['playersMax']="Veuillez rentrer le nombre de joueur maximum";
    }
    else if($_POST['playersMin']>$_POST['playersMax']){
        $errors['playersMin']="Vous devez entrer un nombre de joueur minimum inférieure au nombre maximum";
    }

    if(empty($errors)){
        $g = new Game($_POST);
        $g->setImg(file_get_contents("/xampp/htdocs/ifd_2020/public/img/" . $_FILES['image']['name']));
        $GManager->add($g);
    }


}
require dirname(__FILE__) . '../../view/add_game.php';
