<?php
ob_start();

foreach ($posts as $post)
{
?>
<div class="post-preview">
	<a href="?action=post&id=<?= $post->id() ?>">
		<h2 class="post-title">
			<?= htmlspecialchars($post->title()) ?>
		</h2>
		<p>
			<?= htmlspecialchars($post->chapo()) ?>
		</p>
	</a>
	<p class="post-meta">
		Dernière modification le <?= $post->dateModification()->format('d F Y à H:i:s') ?>
	</p>
</div>
<hr>
<?php
}

$content= ob_get_clean();

require('view/frontend/template/page.php');
?>
