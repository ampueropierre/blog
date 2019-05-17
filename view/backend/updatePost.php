<?php ob_start();?>
<?php if (isset($updateSuccess)): ?>
<div class="alert alert-success">
	<?= ($updateSuccess == 'info') ? 'Les informations ont bien été modifié' : 'L\'image a bien été modifié' ?>
</div>
<?php endif ?>
<div class="row">
	<div class="col-md-6">
		<div class="title-form">Modifier les informations</div>
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
			<div class="form-group">
				<label for="content">Auteur</label>
				
				<select name="authorId" id="author" class="form-control">
					<?php foreach ($usersAdmin as $user): ?>
						<option value="<?= $user->getId() ?>" <?= ($user->getId() == $post->getAuthorId()) ? 'selected' : '' ?>><?= $user->getFirstname().' '.$user->getLastname() ?></option>
					<?php endforeach ?>
				</select>
				<?php if (isset($errors) && in_array($postValidator::AUTHOR_ID_INVALID, $errors)):?>
				<span class="text-danger"><?= $postValidator::AUTHOR_ID_INVALID ?></span>
				<?php endif; ?>
			</div>
			<button type="submit" class="btn btn-primary" name="update">Modifier</button>
		</form>
	</div>
	<div class="col-md-6">
		<div class="title-form">Modifier l'image</div>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="img">Choisir une image</label>
				<input type="file" name="img" class="form-control-file" id="img">
				<?php if (isset($errors) && in_array($postValidator::IMG_INVALID, $errors)):?>
				<span class="text-danger"><?= $postValidator::IMG_INVALID ?></span>
				<?php elseif (isset($errors) && in_array($postValidator::IMG_EXT, $errors)):?>
				<span class="text-danger"><?= $postValidator::IMG_EXT ?></span>
				<?php endif; ?>
			</div>
			<button type="submit" class="btn btn-primary" name="updateImg">Modifier</button>
		</form>
	</div>
</div>
<?php
$content = ob_get_clean();
require('view/template/post.php');
?>