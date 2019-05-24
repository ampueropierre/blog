<?php ob_start(); ?>
<?php if (isset($commentSuccess)): ?>
<div class="alert alert-success">
	Votre commentaire a bien été ajouté et en attente de validation.
</div>
<?php endif ?>
<div class="post-view">
	<div class="information">
		<p class="meta mb-4">Posté par <?= $post->getAuthor()->getFirstname().' '.$post->getAuthor()->getLastname() ?> - <?= $post->getDateModification()->format('d F Y') ?>
		</p>
	</div>
	<div class="img-post">
		<img src="<?= $post->getImg() ?>" class="img-fluid" alt="Image du poste">
	</div>
	<div class="content-post">
		<p>
			<?= nl2br(htmlspecialchars($post->getContent())); ?>
		</p>
	</div>
	<div class="bloc-add-comment">
		<h3>Commenter cet article</h3>
		<?php if (isset($userSession)): ?>
		<form action="" method="post">
			<div class="form-group">
				<label for="comment">Votre commentaire</label>
				<textarea name="comment" class="form-control" id="comment" cols="20" rows="5"></textarea>
				<?php if (isset($errors) && in_array($commentValidator::COMMENT_EMPTY, $errors)): ?>
				<span class="text-danger"><?= $commentValidator::COMMENT_EMPTY  ?></span>
				<?php endif; ?>
			</div>
			<input type="submit" class="btn btn-primary" name="addComment" value="publier" />
		</form>
		<?php else: ?>
		<p>Vous devez être connecté pour laisser un commentaire</p>
		<a href="login" class="btn btn-primary">Se connecter</a>
		<?php endif; ?>
	</div>
	<div class="commentsList">
		<p class="comments-count"><?= count($comments) ?> Commentaires</p>
	<?php foreach ($comments as $comment):?>
		<div class="comment">
			<p class="comment-meta">
				<span class="author"><?= $comment->getAuthor()->getFirstname().' '.$comment->getAuthor()->getLastname() ?></span>
				<span class="date"><?= $comment->getCommentDate()->format('- d F Y  H:i:s') ?></span>
			</p>
			<p class="comment-content">
				<?= nl2br(htmlspecialchars($comment->getComment())) ?>
			</p>
		</div>
	
	<?php endforeach;?>
	</div>
</div>

<?php 
$content= ob_get_clean();
require('view/template/post.php');
?>


