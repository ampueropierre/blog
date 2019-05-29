<?php if (isset($success)): ?>
<div class="alert alert-success">
	Le Rôle a bien été modifié
</div>
<?php endif ?>
<div class="row mb-3">
	<div class="col-md-2">Prénom :</div>
	<div class="col-md-10"><?= $user->getFirstname() ?></div>
</div>
<div class="row my-3">
	<div class="col-md-2">Nom :</div>
	<div class="col-md-10"><?= $user->getLastname() ?></div>
</div>
<div class="row my-3">
	<div class="col-md-2">Mail :</div>
	<div class="col-md-10"><?= $user->getMail() ?></div>
</div>

<form action="" method="POST">
	<div class="form-group row my-3">
		<label for="status" class="col-md-2">Rôle :</label>
		<div class="col-md-10">
			<select class="form-control" id="role" name="role">
				<?php foreach ($roles as $role): ?>
					<option value="<?= $role['id'] ?>" <?= ($user->getRolesId() == $role['id']) ? 'selected' : '' ?>><?= $role['name'] ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<?php if (isset($errors) && in_array($userValidator::ROLE_NOTEXIST, $errors)):?>
		<span class="text-danger"><?= $userValidator::ROLE_NOTEXIST ?></span>
		<?php endif; ?>
	</div>
	
	<button type="submit" class="btn btn-primary" name="update">Modifier</button>
</form>