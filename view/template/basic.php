<?php require 'header.php';

if(!empty($errors)){
    echo "<ul id='error_list'>";
    foreach($errors as $key => $value){
        echo "<li class='error_item'>" . $value . "</li>";
        unset($errors[$key]);
    }
    echo "</ul>";
    
}

?>


<?= $data['content'] ?>

<?php require 'footer.php'; ?>