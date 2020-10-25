<?php require 'header.php';
if(!empty($_SESSION['errors'])){
    echo "<ul id='error_list'>";
    foreach($_SESSION['errors'] as $key => $value){
        echo "<li class='error_item'>" . $value . "</li>";
        unset($_SESSION['errors'][$key]);
    }
    echo "</ul>";
    
}?>


<?= $data['content'] ?>

<?php require 'footer.php'; ?>