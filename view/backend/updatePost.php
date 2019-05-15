<?php
ob_start();
?>
<div class="title-form">Les informations</div>
<form action="" method="POST">
	<div class="form-group">
		<label for="title">Titre</label>
		<input type="text" class="form-control" name="title" id="title" value="<?= $post->getTitle() ?>">
		<?php if (isset($errors) && in_array($postValidator::TITLE_EMPTY, $errors)):?>
		<span class="text-danger"><?= $postValidator::TITLE_EMPTY ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label for="title">Chapo</label>
		<input type="text" class="form-control" name="chapo" id="chapo" value="<?= $post->getChapo() ?>">
		<?php if (isset($errors) && in_array($postValidator::CHAPO_EMPTY, $errors)):?>
		<span class="text-danger"><?= $postValidator::CHAPO_EMPTY ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label for="content">Contenu</label>
		<textarea name="content" id="content" class="form-control" rows="7"><?= $post->getContent() ?></textarea>
		<?php if (isset($errors) && in_array($postValidator::CONTENT_EMPTY, $errors)):?>
		<span class="text-danger"><?= $postValidator::CONTENT_EMPTY ?></span>
		<?php endif; ?>
	</div>
	<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
	<button type="submit" class="btn btn-primary" name="update">Modifier</button>
</form>
<div class="title-form">Les informations</div>
<form action="" method="POST" enctype="">
	
</form>
<?php
$content = ob_get_clean();
require('view/template/post.php');
?>