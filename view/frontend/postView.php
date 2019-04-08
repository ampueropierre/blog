<?php
$title = 'Mon blog - Post';
ob_start();
?>
<?php
var_dump($post);
?>
<h1>Mon super Blog !</h1>
<p><a href="index.php">Retour à la  liste des billets</a></p>

<div class="news">
	<h3>
		<?= htmlspecialchars($post->title()); ?>
		<br>
		<em>Publié le <?= $post->dateCreation()->format('d/m/Y à H:i:s'); ?></em>
	</h3>
	<p>
		<?= nl2br(htmlspecialchars($post->content())); ?>
	</p>
</div>

<h2>Commentaire</h2>

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
var_dump($comments);
die
?>
<?php
while ($comment = $comments->fetch()) {
?>
	<p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> (<a href="index.php?action=comment&amp;idPost=<?= $post['id']?>&amp;idComment=<?= $comment['id'] ?>">Modifier le commentaire</a>)</p>
	<p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
}
$content= ob_get_clean();
require('view/frontend/template.php');
?>
