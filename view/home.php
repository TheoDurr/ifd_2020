<?php ob_start();?>

<?php $data['content'] = ob_get_clean();
require_once 'template/basic.php';