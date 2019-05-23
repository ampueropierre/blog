<?php ob_start(); ?>
<h3>Le commentaire</h3>

<p>L'auteur : </p>
<p><?= $comment->getAuthor()->getFirstname().' '.$comment->getAuthor()->getLastname()?></p>
<p>Le commentaire :</p>
<p><?= $comment->getComment() ?></p>

<form action="" method="POST">
	<div class="form-group">
		<label for="status">Statut</label>
		<select class="form-control" id="status" name="status">
			<?php for($i = 0; $i < 2; $i++):?>
			<option value="<?= $i ?>" <?= ($i == $comment->getStatus()) ? 'selected' : '' ?>><?= ($i == 0) ? 'Pas valide' : 'Valide' ?></option>
			<?php endfor; ?>
		</select>
		<?php if (isset($errors) && in_array($commentValidator::STATUS_INVALID, $errors)):?>
		<span class="text-danger"><?= $commentValidator::STATUS_INVALID ?></span>
		<?php endif; ?>
	</div>
	
	<button type="submit" class="btn btn-primary" name="update">Modifier</button>
</fosrm>
<?php
$content = ob_get_clean();
require('view/template/page.php');
?>