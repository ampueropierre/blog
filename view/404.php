<?php ob_start(); ?>
<p class="text-center">Désolé, la page que vous cherchez n’existe pas</p>
<div class="d-flex justify-content-center">
	<a href="" class='btn btn-primary'>Retourner à la page d'accueil</a>
</div>
<?php
$content = ob_get_clean();
require 'template/page.php';
?>