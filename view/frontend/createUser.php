<?php
ob_start();
?>
<form action="" method="post">
	<div class="form-group">
		<label>Prénom</label>
		<input class="form-control" type="text" name="firstname" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname'] ?>">
		<?php if (isset($errors) && in_array($userValidator::FIRSTNAME_EMPTY, $errors)): ?>
		<span class="text-danger"><?= $userValidator::FIRSTNAME_EMPTY ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label>Nom</label>
		<input class="form-control" type="text" name="lastname" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname'] ?>">
		<?php if (isset($errors) && in_array($userValidator::LASTNAME_EMPTY, $errors)): ?>
		<span class="text-danger"><?= $userValidator::LASTNAME_EMPTY  ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input class="form-control" type="text" name="mail" value="<?php if (isset($_POST['mail'])) echo $_POST['mail'] ?>">
		<?php if (isset($errors) && in_array($userValidator::MAIL_EMPTY, $errors)): ?>
		<span class="text-danger"><?= $userValidator::MAIL_EMPTY ?></span>
		<?php elseif (isset($errors) && in_array($userValidator::MAIL_EXIST, $errors)): ?>
		<span class="text-danger">Ce mail est déjà utilié</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label>Mot de Passe</label>
		<input class="form-control" type="password" name="password">
		<?php if (isset($errors) && in_array($userValidator::PASSWORD_EMPTY, $errors)): ?>
		<span class="text-danger"><?= $userValidator::PASSWORD_EMPTY ?></span>
		<?php elseif (isset($errors) && in_array($userValidator::PASSWORD_LENGHT, $errors)): ?>
		<span class="text-danger"><?= $userValidator::PASSWORD_LENGHT ?></span>
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