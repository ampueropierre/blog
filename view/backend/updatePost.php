<?php
ob_start();
?>
<form action="" method="POST">
	<div class="form-group">
		<label for="title">Titre</label>
		<input type="text" class="form-control" name="title" id="title" value="<?= $post->title() ?>">
		<?php if (isset($errors) && in_array($postValidator::TITLE_INVALID, $errors)):?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label for="content">Texte</label>
		<textarea name="content" id="content" class="form-control" rows="7"><?= $post->content() ?></textarea>
		<?php if (isset($errors) && in_array($postValidator::CONTENT_INVALID, $errors)):?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	<button type="submit" class="btn btn-primary" name="add">Modifier</button>
</form>
<?php
$content = ob_get_clean();
require('view/frontend/template/post.php');
?>