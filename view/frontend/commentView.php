<?php
// Modifier des commentaire
ob_start();
?>
<form action="" method="post">
	<div>
		<label for="author">L'auteur</label>
		<input type="text" id="author" name="author" value="<?= $comment->author() ?>">
	</div>
	<div>
		<label for="Commentaire">Commentaire</label>
		<textarea name="comment" id="comment" cols="30" rows="10"><?= $comment->comment() ?></textarea>
	</div>
	<div>
		<input type="submit" value="Modifier" name="update">
	</div>
</form>

<?php
$content = ob_get_clean();
require('view/frontend/template/post.php');
?>