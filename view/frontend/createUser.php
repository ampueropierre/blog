<?php
ob_start();
?>
<form action="" method="post">
	<div class="form-group">
		<label>Prénom</label>
		<input class="form-control" type="text" name="firstname">
		<span class="text-danger">Invalid</span>
	</div>
	<div class="form-group">
		<label>Nom</label>
		<input class="form-control" type="text" name="lastname">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input class="form-control" type="text" name="mail">
	</div>
	<div class="form-group">
		<label>Mot de Passe</label>
		<input class="form-control" type="password" name="password">
	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create">
	</div>
</form>
<?php
$content = ob_get_clean();
require 'view/frontend/template/post.php';
?>