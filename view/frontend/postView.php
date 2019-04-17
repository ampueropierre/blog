<?php
$title = $post->title();
$titlePost = $post->title();
ob_start();
?>
<div class="post-view">
	<p><a href="?action=listPost">Retour à la  liste des billets</a></p>
	<p class="post-meta">Publié le <?= $post->dateCreation()->format('d/m/Y à H:i:s'); ?></p>

	<p>
		<?= nl2br(htmlspecialchars($post->content())); ?>
	</p>

	<h3>Commentaire</h3>

	<form action="index.php?action=addComment&amp;id=<?= $post->id() ?>" method="post">
		<div>
			<label for="author">Auteur</label>
			<input type="text" id="author" name="author"/>
		</div>
		<div>
			<label for="comment">Commentaire</label>
			<textarea name="comment" id="comment" cols="20" rows="5"></textarea>
		</div>
		<div>
			<input type="submit"/>
		</div>
	</form>
	<?php
foreach ($comments as $comment)
{
?>
	<p><strong><?= htmlspecialchars($comment->author()) ?></strong> le <?= $comment->commentDate()->format('d F Y à H:i:s') ?> (<a href="index.php?action=comment&amp;idPost=<?= $post->id()?>&amp;idComment=<?= $comment->id() ?>">Modifier le commentaire</a>)</p>
	<p><?= nl2br(htmlspecialchars($comment->comment())) ?></p>
<?php
}
?>
</div>
<?php 
$content= ob_get_clean();
require('view/frontend/template/post.php');
?>


