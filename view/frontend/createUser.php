<div class="form-login-register">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form action="" method="post">
				<div class="form-group">
					<label>Prénom :</label>
					<input class="form-control" type="text" name="firstname" value="<?php if (isset($data['firstname'])) echo $data['firstname'] ?>">
					<?php if (isset($errors) && in_array($userValidator::FIRSTNAME_EMPTY, $errors)): ?>
					<span class="msg-error text-danger"><?= $userValidator::FIRSTNAME_EMPTY ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label>Nom :</label>
					<input class="form-control" type="text" name="lastname" value="<?php if (isset($data['lastname'])) echo $data['lastname'] ?>">
					<?php if (isset($errors) && in_array($userValidator::LASTNAME_EMPTY, $errors)): ?>
					<span class="msg-error text-danger"><?= $userValidator::LASTNAME_EMPTY  ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label>Adresse mail :</label>
					<input class="form-control" type="text" name="mail" value="<?php if (isset($data['mail'])) echo $data['mail'] ?>">
					<?php if (isset($errors) && in_array($userValidator::MAIL_EMPTY, $errors)): ?>
					<span class="msg-error text-danger"><?= $userValidator::MAIL_EMPTY ?></span>
					<?php elseif (isset($errors) && in_array($userValidator::MAIL_EXIST, $errors)): ?>
					<span class="msg-error text-danger">Ce mail est déjà utilié</span>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label>Mot de Passe :</label>
					<input class="form-control" type="password" name="password">
					<?php if (isset($errors) && in_array($userValidator::PASSWORD_EMPTY, $errors)): ?>
					<span class="msg-error text-danger"><?= $userValidator::PASSWORD_EMPTY ?></span>
					<?php elseif (isset($errors) && in_array($userValidator::PASSWORD_LENGHT, $errors)): ?>
					<span class="msg-error text-danger"><?= $userValidator::PASSWORD_LENGHT ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<input class="btn btn-primary" type="submit" name="create" value="Rejoignez nous">
				</div>
			</form>
		</div>	
	</div>
</div>