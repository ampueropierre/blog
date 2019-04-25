<?php
ob_start();
?>
<form action="" method="post">
	<div class="form-group">
		<label>Prénom</label>
		<input class="form-control" type="text" name="firstname" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname'] ?>">
		<?php if (isset($error) && in_array($userCreate::FIRSTNAME_INVALID, $error)): ?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label>Nom</label>
		<input class="form-control" type="text" name="lastname" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname'] ?>">
		<?php if (isset($error) && in_array($userCreate::LASTNAME_INVALID, $error)): ?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input class="form-control" type="text" name="mail" value="<?php if (isset($_POST['mail'])) echo $_POST['mail'] ?>">
		<?php if (isset($error) && in_array($userCreate::MAIL_INVALID, $error)): ?>
		<span class="text-danger">Invalid</span>
		<?php elseif (isset($error) && in_array(5, $error)): ?>
		<span class="text-danger">Ce mail est déjà utilié</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label>Mot de Passe</label>
		<input class="form-control" type="password" name="password">
		<?php if (isset($error) && in_array($userCreate::PASSWORD_INVALID, $error)): ?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create">
	</div>
</form>
<?php
$content = ob_get_clean();
require 'view/frontend/template/post.php';
?>