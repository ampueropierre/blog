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
				<?php for($i = 0; $i < 2; $i++):?>
					<option value="<?= $i ?>" <?= ($i == $comment->getStatus()) ? 'selected' : '' ?>><?= ($i == 0) ? 'En attente de Validation' : 'Validé' ?></option>
				<?php endfor; ?>
			</select>
			<?php if (isset($errors) && in_array($commentValidator::STATUS_INVALID, $errors)):?>
			<span class="text-danger"><?= $commentValidator::STATUS_INVALID ?></span>
		<?php endif; ?>
		</div>
	
		<button type="submit" class="btn btn-primary" name="update">Modifier</button>
	</form>
</div>
