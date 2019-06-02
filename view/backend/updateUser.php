<?php if (isset($success)): ?>
<div class="alert alert-success">
	Le Rôle a bien été modifié
</div>
<?php endif ?>
<div class="update-user">
	<div class="form-group">
		<span class="meta">Prénom</span>
		<p><?= $user->getFirstname() ?></p>
	</div>
	<div class="form-group">
		<span class="meta">Nom</span>
		<p><?= $user->getLastname() ?></p>
	</div>
	<div class="form-group">
		<span class="meta">Mail</span>
		<p><?= $user->getMail() ?></p>
	</div>
	<form action="" method="POST">
		<div class="form-group">
			<label for="status" class="meta">Rôle</label>
			<select class="form-control" id="role" name="role">
				<?php foreach ($roles as $role): ?>
				<option value="<?= $role['id'] ?>"
				<?php if ($user->getRolesId() == $role['id']): ?>
					selected
				<?php endif; ?>
				>
				<?= $role['name'] ?>	
				</option>
				<?php endforeach; ?>
			</select>
			<?php if (isset($errors) && in_array($userValidator::ROLE_NOTEXIST, $errors)):?>
			<span class="text-danger"><?= $userValidator::ROLE_NOTEXIST ?></span>
			<?php endif; ?>
		</div>
		<button type="submit" class="btn btn-primary" name="update">Modifier</button>
	</form>
</div>
