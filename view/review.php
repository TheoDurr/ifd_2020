<?php ob_start(); ?>



<?php $data['content'] = ob_get_clean(); 
    require 'template/basic.php';
?>