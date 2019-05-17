<?php ob_start(); ?>
<?php if (isset($commentSuccess)): ?>
<div class="alert alert-success">
	Votre commentaire a bien été ajouté et en attente de validation.
</div>
<?php endif ?>
<div class="post-view">
	<p class="post-meta">Derniére modification le <?= $post->getDateModification()->format('d/m/Y à H:i:s'); ?> par <?= $post->getAuthor()->getFirstname().' '.$post->getAuthor()->getLastname() ?></p>
	<p>
		<img src="<?= $post->getImg() ?>" class="img-fluid" alt="Responsive image">
	</p>
	<p>
		<?= nl2br(htmlspecialchars($post->getContent())); ?>
	</p>

	<div class="bloc-add-comment">
		<h3>Commenter cet article</h3>
		<?php if (isset($userSession)): ?>
		<form action="" method="post">
			<div class="form-group">
				<label for="comment" class="invisible">Commentaire</label>
				<textarea name="comment" class="form-control" id="comment" cols="20" rows="5"></textarea>
				<?php if (isset($errors) && in_array($commentValidator::COMMENT_EMPTY, $errors)): ?>
				<span class="text-danger"><?= $commentValidator::COMMENT_EMPTY  ?></span>
				<?php endif; ?>
			</div>
			<input type="submit" class="btn btn-primary" name="addComment" value="publier" />
		</form>
		<?php else: ?>
		<p>Vous devez être connecté pour laisser un commentaire</p>
		<a href="?action=connexion" class="btn btn-primary">Se connecter</a>
		<?php endif; ?>
	</div>
	
	<?php foreach ($comments as $comment):?>
	<p>le <?= $comment->getCommentDate()->format('d F Y à H:i:s') ?> par
		<span class=''>
			<?= $comment->getAuthor()->getFirstname().' '.$comment->getAuthor()->getLastname() ?>
		</span>
	</p>
	<p><?= nl2br(htmlspecialchars($comment->getComment())) ?></p>
	<?php endforeach;?>
</div>

<?php 
$content= ob_get_clean();
require('view/template/post.php');
?>


