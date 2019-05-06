<?php
ob_start();
?>
<?php
$content = ob_get_clean();
require 'view/frontend/template/page.php';
?>