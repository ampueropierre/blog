<?php
$title = 'Mon blog';
ob_start();

foreach ($posts as $post)
{
?>
<div class="news">
	<a href="">
		<h3 class="news-title">
			<?= htmlspecialchars($post->title()) ?>
		</h3>
		<p>
			<?= nl2br(htmlspecialchars($post->content())) ?>
		</p>
		
	</a>
	<p class="news-meta">
		<em>Publié le <?= $post->dateCreation()->format('d/m/Y à H:i:s') ?></em>
		<br>
		<em><a href="index.php?action=post&id=<?= $post->id() ?>">Commentaires</a></em>
	</p>
	<hr>
</div>
<?php
}

$content= ob_get_clean();

require('view/frontend/template.php');
?>
