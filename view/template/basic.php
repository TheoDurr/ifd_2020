<?php require 'header.php';
if(!empty($_SESSION['errors'])){?>
    <div class="box1 errors">
        <ul id='error_list'>
        <?php foreach($_SESSION['errors'] as $key => $value){
            echo "<li class='error_item'>" . $value . "</li>";
            unset($_SESSION['errors'][$key]);
        }?>
        </ul>
    </div>
<?php }?>


<?= $data['content'] ?>

<?php require 'footer.php'; ?>