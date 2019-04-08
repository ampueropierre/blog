<?php
// Modifier des commentaire
$title = 'Mon blog - Comment';
ob_start();
?>

<h1>Modifier le commentaire</h1>

<form action="index.php?action=updateComment&idComment=<?= $idComment ?>&idPost=<?= $idPost ?>" method="post">
	<div>
		<label for="author">L'auteur</label>
		<input type="text" id="author" name="author" value="<?= $comment['author'] ?>">
	</div>
	<div>
		<label for="Commentaire">Commentaire</label>
		<textarea name="comment" id="comment" cols="30" rows="10"><?= $comment['comment'] ?></textarea>
	</div>
	<div>
		<input type="submit">
	</div>
</form>

<?php
$content = ob_get_clean();
require('view/frontend/template.php');
?>