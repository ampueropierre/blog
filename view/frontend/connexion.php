<div class="form-login-register">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<?php if (isset($errorIdentifiant)): ?>
			<div class="alert alert-danger msg-alert" role="alert">
				Il semble que votre adresse mail ou votre mot de passe soient incorrects. Veuillez essayer à nouveau, s'il vous plaît
			</div>
			<?php endif; ?>
			<form action="" method="post">
				<div class="form-group">
					<label>Adresse mail :</label>
					<input class="form-control" type="text" name="mail" value="<?= (isset($data['mail'])) ? $data['mail'] : '' ?>">
						<?php if (isset($errors) && in_array($connexionValidator::MAIL_EMPTY, $errors)): ?>
						<span class="msg-error text-danger"><?= $connexionValidator::MAIL_EMPTY ?></span>
						<?php endif; ?>
				</div>
				<div class="form-group">
					<label>Mot de Passe :</label>
						<input class="form-control" type="password" name="password">
						<?php if (isset($errors) && in_array($connexionValidator::PASSWORD_EMPTY, $errors)): ?>
						<span class="msg-error text-danger"><?= $connexionValidator::PASSWORD_EMPTY ?></span>
						<?php endif; ?>
				</div>
				<div class="form-group text-center">
					<input class="btn btn-primary" type="submit" name="connexion" value="Connexion">
				</div>
			</form>
		</div>
	</div>
</div>