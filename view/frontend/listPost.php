<?php
ob_start();

foreach ($posts as $post)
{
?>
<div class="post-preview">
	<a href="?action=post&id=<?= $post->getId() ?>">
		<h2 class="post-title">
			<?= htmlspecialchars($post->getTitle()) ?>
		</h2>
		<p>
			<?= htmlspecialchars($post->getChapo()) ?>
		</p>
	</a>
	<p class="post-meta">
		Dernière modification le <?= $post->getDateModification()->format('d F Y à H:i:s') ?>
	</p>
</div>
<hr>
<?php
}

$content= ob_get_clean();

require('view/frontend/template/page.php');
?>
