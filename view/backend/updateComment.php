<?php if (isset($success)): ?>
<div class="alert alert-success">
	Le statut a bien été modifié
</div>
<?php endif ?>
<div class="update-comment">
	<div class="form-group">
		<span class="meta">L'auteur</span>
		<p><?= $comment->getAuthor()->getFirstname().' '.$comment->getAuthor()->getLastname()?></p>
	</div>
	<div class="form-group">
		<span class="meta">Le commentaire</span>
		<p><?= $comment->getContent() ?></p>
	</div>
	<form action="" method="POST">
		<div class="form-group">
			<label class="meta" for="status">Statut</label>
			<select class="form-control" id="status" name="status">
				<?php if (isset($data)): ?>
					<option value="0" <?= ($data['status'] == 0) ? 'selected' : '' ?>>En attente de Validation</option>
					<option value="1" <?= ($data['status'] == 1) ? 'selected' : '' ?>>Validé</option>
				<?php else: ?>
					<option value="0" <?= ($comment->getStatus() == 0) ? 'selected' : '' ?>>En attente de Validation</option>
					<option value="1" <?= ($comment->getStatus() == 1) ? 'selected' : '' ?>>Validé</option>
				<?php endif; ?>	
			</select>
			<?php if (isset($errors) && in_array($commentValidator::STATUS_INVALID, $errors)):?>
			<span class="text-danger"><?= $commentValidator::STATUS_INVALID ?></span>
			<?php endif; ?>
		</div>
	
		<button type="submit" class="btn btn-primary" name="update">Modifier</button>
	</form>
</div>