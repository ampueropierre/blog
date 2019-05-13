<?php
ob_start();
?>
<form action="" method="POST">
	<div class="form-group">
		<label for="title">Prénom</label>
		<input type="text" class="form-control" name="firstname" id="firstname" value="<?= $comment->getAuthor()->getFirstname() ?>" disabled>
	</div>
	<div class="form-group">
		<label for="title">Nom</label>
		<input type="text" class="form-control" name="lastname" id="lastname" value="<?= $comment->getAuthor()->getLastname() ?>" disabled>
	</div>
	<div class="form-group">
		<label for="content">Commentaire</label>
		<textarea name="content" id="content" class="form-control" rows="7" disabled><?= $comment->getComment() ?></textarea>
	</div>
	<div class="form-group">
		<label for="status">Statut</label>
		<select class="form-control" id="status" name="status">
			<option value="1" <?= ($comment->getStatus()) == 1 ? 'selected' : '' ?>>Valide</option>
			<option value="0" <?= ($comment->getStatus()) != 1 ? 'selected' : '' ?>>Pas valide</option>
		</select>
	</div>
	<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
	
	<button type="submit" class="btn btn-primary" name="update">Modifier</button>
</form>
<?php
$content = ob_get_clean();
require('view/template/post.php');
?>