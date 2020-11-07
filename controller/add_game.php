<?php
if(!isset($_SESSION['user'])){
    // User not logged
    header("Location: index.php?action=login");
}

if (!empty($_POST)){ // We check if something has been transmitted
    $GManager = new GameManager($db); 
    $error=0; // checks the errors
    // we check the data on the form 
    if($_POST['name']==''){ 
        $_SESSION['errors']['name']="Le nom du jeu n'est pas référencé";
        $error=1;
    }
    else if ($GManager->get(new Game(array('name' =>$_POST['name'])))){
        // If the name exits in the DB
        $_SESSION['errors']['name'] = "Ce jeu a déjà été ajouté";
        $error=1;
    }

    if($_POST['editor']==''){
        $_SESSION['errors']['editor']="L'éditeur du jeu n'a pas été référencé";
        $error=1;
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['editor'])){
         // If the editor doesn't respect the synthax
        $_SESSION['errors']['editor'] = "L'éditeur contient des caractères spéciaux invalides";
        $error=1;
    }

    
    if($_POST['description']==''){
        $_SESSION['errors']['description']="Veuillez ajouter une courte description";
        $error=1;
    }

    $picturePresent=0;
    if ($_FILES['image']['name']!='') // if there is a picture
    {
        $mesErrors='';
        $GManager->UploadPicture($mesErrors); // we upload the picture
        $_SESSION['errors']['image']=$mesErrors;
        if ($_SESSION['errors']['image']!=" Le fichier a bien été téléchargé."){
            $error=1;
        }
        $picturePresent=1; // there is a picture
    }
    

    if($_POST['category']=='0'){
        $_SESSION['errors']['category']="La catégorie n'a pas été référencée";
        $error=1;
    }


    if($_POST['price']==''){
        $_SESSION['errors']['price']="Le prix du jeu n'a pas été référencé";
        $error=1;
    }


    if($_POST['playersMin']==''){
        $_SESSION['errors']['playersMin']="Veuillez rentrer le nombre de joueur minimum";
        $error=1;
    }
    if($_POST['playersMax']==''){
        $_SESSION['errors']['playersMax']="Veuillez rentrer le nombre de joueur maximum";
        $error=1;
    }
    else if($_POST['playersMin']>$_POST['playersMax']){
        $_SESSION['errors']['playersMin']="Vous devez entrer un nombre de joueur minimum inférieure au nombre maximum";
        $error=1;
    }

    if ($error==0){ // if no error previously

        $eManager = new EditorManager($db);
        $editorFind=$eManager->get(new Editor(array('name' => $_POST['editor']))); // we look for and get if and editor is already in the db
        $editorId=0;
        if ($editorFind){ // if it is
           $editorId=$editorFind[0]; // we get the id
        }
        else // if it isn't
        {
            $e = new Editor(array(
                'name' => $_POST['editor']
            )); 
            $eManager->add($e);// we add the new editor
            $editorFind=$eManager->get(new Editor(array('name' => $_POST['editor'])));
            if ($editorFind){
                $editorId=$editorFind[0];
            } // we get the new id
        }


        $cManager = new CategoryManager($db);
        $categoryFind=$cManager->get(new Category(array('name' => $_POST['category']))); // we get the category on the db
        $categoryId=$categoryFind[0]; // we get its id

        $picture="0";
        if($picturePresent==1){ // if user adds a picture
            $picture=file_get_contents("/xampp/htdocs/ifd_2020/public/img/" . $_FILES['image']['name']); // we will have his picture
        }
        else { //if not
            $picture=file_get_contents("/xampp/htdocs/ifd_2020/public/img/NoPicture.png"); // a default image is added 
        }  

        $g = new Game(array( // we create a new game object
            'name' => $_POST['name'],
            'editorId' => $editorId->id(),
            'description' => $_POST['description'],
            'img' =>$picture,
            'categoryId' => $categoryId->id(),
            'price'=> strval($_POST['price']),
            'playersMin' => $_POST['playersMin'],
            'playersMax' => $_POST['playersMax'],
            'userId' => $_SESSION['user']->id(),
            'complexity' => $_POST['complexity'],
            'concentration' => $_POST['concentration'],
            'ambiance' => $_POST['ambiance']
        ));
        $rManager = new GameManager($db);
        $rManager->add($g); // we add g at the db
    
    }
}

$tabName = "Ajouter un jeu";
require dirname(__FILE__) . '../../view/add_game.php';
