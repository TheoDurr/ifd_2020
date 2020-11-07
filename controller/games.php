<?php

$gManager = new GameManager($db);
$cManager = new CategoryManager($db);


if (!empty($_POST)){ // If we received data from the form 
    if($_POST['search']==''){ // if the user has not typed anything in the search bar

        // the user is not forced to fill in all the boxes, 
        // if he has not filled in a box, we assign it the maximum or minimum value
        // so that does not lose any game in the search. 
        if( $_POST['priceMin']!='') { $Prmin=$_POST['priceMin']; } else{ $Prmin=0;} 
        if( $_POST['priceMax']!='') { $Prmax=$_POST['priceMax']; } else{ $Prmax=400;}
        if( $_POST['playersMin']!='') { $Plmin=$_POST['playersMin']; } else{ $Plmin=0;}
        if( $_POST['playersMax']!='') { $Plmax=$_POST['playersMax']; } else{ $Plmax=20;}

        $dBt=array(  //the table to be sent to the function is filled in. 
            'priceMin' => $Prmin,
            'priceMax' =>$Prmax,
            'playersMin' => $Plmin,
            'playersMax' => $Plmax
        );

        //we search for the game(s) in the database 
        //whose price and player values are within the requested intervals
        $dataBetween = $gManager->getBetween($dBt); 

        if($_POST['category']!='0') { // if the user has filled in the category box
            //we are looking for all the games corresponding to this type of category 
            $dataCategory=$cManager->get(new Category(array('name' =>$_POST['category'])));
        }
        else {
            //We get all the games
            $dataCategory=$cManager->get();
        }
        $i=0;
        $dName['games']=array(); // array memorizing names of game // use to comparaison
        $data['games']=array(); // array memorizing games to send 
        if($dataBetween!=false && $dataCategory!=false) // if the user has entered both types of data 
        {
            foreach($dataBetween as $dtBetween){ // We go through the indexes of the two tables
                foreach($dataCategory as $dtCategory){
                    if($dtBetween->category()->id()==$dtCategory->id()){ // If they have the same ID.
                        if(!in_array($dtBetween->name(),$dName['games'])){ // If the game has not already been selected 
                            array_push($dName['games'],$dtBetween->name()); // We memorize the name du jeu 
                            array_push($data['games'],$dtBetween); // We memorize the game and all its characteristics.
                        }
                    }
                }
            }
        }
    
    }
        
    else { // If the user has typed something in the search bar 

        //The game is only searched on what is entered in the search bar.
        $dataSearch=$gManager->get(new Game(array('name' =>"%" . $_POST['search'] . "%")));
        $data['games']=$dataSearch;
    }  
}
else // If the user has sent nothing 
{
    $data['games']=$gManager->get();  // We search all games in the database
}

$tabName = "Jeux";
require dirname(__FILE__) . '../../view/games.php';