<?php ob_start(); ?>
<?php if (isset($update)):?>
<div class="alert alert-success" role="alert">
	le compte a bien été modifié
</div>
<?php endif; ?>
<div class="form-login-register">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form action="" method="post">
				<div class="form-group">
					<label>Votre Prénom :</label>
					<input class="form-control" type="text" name="firstname" value="<?= $userProfil->getFirstname() ?>">
					<?php if (isset($errors) && in_array($userValidator::FIRSTNAME_EMPTY, $errors)): ?>
					<span class="msg-error text-danger"><?= $userValidator::FIRSTNAME_EMPTY ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label>Votre Nom :</label>
					<input class="form-control" type="text" name="lastname" value="<?= $userProfil->getLastname() ?>">
					<?php if (isset($errors) && in_array($userValidator::LASTNAME_EMPTY, $errors)): ?>
					<span class="msg-error text-danger"><?= $userValidator::LASTNAME_EMPTY  ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label>Votre Email :</label>
					<input class="form-control" type="text" name="mail" value="<?= $userProfil->getMail() ?>">
					<?php if (isset($errors) && in_array($userValidator::MAIL_EMPTY, $errors)): ?>
					<span class="msg-error text-danger"><?= $userValidator::MAIL_EMPTY ?></span>
					<?php elseif (isset($errors) && in_array($userValidator::MAIL_EXIST, $errors)): ?>
					<span class="msg-error text-danger">Ce mail est déjà utilié</span>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Modifier" name="update">
				</div>
			</form>
		</div>
	</div>
</div>
<?php
$content = ob_get_clean();
require 'view/template/page.php';
?>