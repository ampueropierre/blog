<?php
$title = 'Mon blog';
ob_start();
?>

<h1>Mon super blog</h1>
<p>Derniers billets du blog :</p>
<?php
foreach ($posts as $post)
{
?>
<div class="news">
	<h3>
		<?= htmlspecialchars($post->title()) ?>
		<br>
		<em>Publié le <?= $post->dateCreation()->format('d/m/Y à H:i:s') ?></em>
	</h3>
	<p>
		<?= nl2br(htmlspecialchars($post->content())) ?>
		<br>
		<em><a href="index.php?action=post&id=<?= $post->id() ?>">Commentaires</a></em>
	</p>
</div>
<?php
}

$content= ob_get_clean();

require('view/frontend/template.php');
?>
