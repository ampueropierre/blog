<?php
ob_start();
?>
<?php if (isset($errorIdentifiant)): ?>
<div class="alert alert-danger" role="alert">
  Il semble que votre adresse e-mail ou votre mot de passe soient incorrects. Veuillez essayer à nouveau, s'il vous plaît
</div>
<?php endif; ?>
<form action="" method="post">
	<div class="form-group">
		<label>Email</label>
		<input class="form-control" type="text" name="mail" value="<?php if (isset($_POST['mail'])) echo $_POST['mail']; ?>">
		<?php if (isset($errors) && in_array($connexionValidator::MAIL_INVALID, $errors)): ?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label>Mot de Passe</label>
		<input class="form-control" type="password" name="password">
		<?php if (isset($errors) && in_array($connexionValidator::PASSWORD_INVALID, $errors)): ?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="connexion">
	</div>
</form>
<?php
$content = ob_get_clean();
require 'view/frontend/template/post.php';
?>