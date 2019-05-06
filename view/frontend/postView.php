<?php
ob_start();
?>
<div class="post-view">
	<p><a href="?action=listPost">Retour à la  liste des billets</a></p>
	<p class="post-meta">Derniére modification le <?= $post->dateModification()->format('d/m/Y à H:i:s'); ?> par <?= $post->firstname().' '.$post->lastname() ?></p>
	<p>
		<img src="private/img/bicycle-blue.jpg" class="img-fluid" alt="Responsive image">
	</p>
	<p>
		<?= nl2br(htmlspecialchars($post->content())); ?>
	</p>

	<div class="bloc-add-comment">
		<h3>Commenter cet article</h3>
		<?php if (isset($user)): ?>
		<form action="index.php?action=addComment&amp;id=<?= $post->id() ?>" method="post">
			<div class="form-group">
				<label for="comment">Commentaire</label>
				<textarea name="comment" class="form-control" id="comment" cols="20" rows="5"></textarea>
			</div>
			<input type="submit" class="btn btn-primary" value="publier" />
		</form>
		<?php else: ?>
		<p>Vous devez être connecté pour laisser un commentaire</p>
		<a href="?action=connexion" class="btn btn-primary">Se connecter</a>
		<?php endif; ?>
	</div>
	
<?php foreach ($comments as $comment):?>
	<p><strong><?= htmlspecialchars($comment->firstname()).' '.htmlspecialchars(ucfirst($comment->lastname()[0])) ?>.</strong> le <?= $comment->commentDate()->format('d F Y à H:i:s') ?> <!-- (<a href="index.php?action=comment&amp;idPost=<?= $post->id()?>&amp;idComment=<?= $comment->id() ?>">Modifier le commentaire</a>) --></p>
	<p><?= nl2br(htmlspecialchars($comment->comment())) ?></p>
<?php endforeach;?>
</div>

<?php 
$content= ob_get_clean();
require('view/frontend/template/post.php');
?>


