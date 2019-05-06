<?php
ob_start();
?>
<form action="" method="POST">
	<div class="form-group">
		<label for="title">Titre</label>
		<input type="text" class="form-control" name="title" id="title" value="<?= (isset($_POST['title']) ? $_POST['chapo'] : '') ?>">
		<?php if (isset($errors) && in_array($postValidator::TITLE_INVALID, $errors)):?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label for="title">Chapo</label>
		<input type="text" class="form-control" name="chapo" id="chapo" value="<?= (isset($_POST['chapo']) ? $_POST['chapo'] : '') ?>">
		<?php if (isset($errors) && in_array($postValidator::CHAPO_INVALID, $errors)):?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label for="content">Contenu</label>
		<textarea name="content" id="content" class="form-control" rows="7"></textarea>
		<?php if (isset($errors) && in_array($postValidator::CONTENT_INVALID, $errors)):?>
		<span class="text-danger">Invalid</span>
		<?php endif; ?>
	</div>
	
	<button type="submit" class="btn btn-primary" name="add">Ajouter</button>
</form>
<?php
$content = ob_get_clean();
require('view/frontend/template/post.php');
?>