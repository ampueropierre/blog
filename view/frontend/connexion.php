<?php
ob_start();
?>
<h2>Connexion</h2>

<form action="" method="post">
	<label>Email</label>
	<input type="text" name="mail"><br>

	<label>Mot de passe</label>
	<input type="password" name="password"><br>

	<input type="submit" value="Connexion">
</form>
<?php
$content = ob_get_clean();
require 'view/frontend/template/page.php';
?>