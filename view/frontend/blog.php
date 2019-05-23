<?php ob_start();?>
<?php foreach ($posts as $post): ?>
<div class="post-preview">
	<a href="posts/<?= $post->getId() ?>">
		<h2 class="post-title">
			<?= htmlspecialchars($post->getTitle()) ?>
		</h2>
		<h3 class="post-subtitle">
			<?= htmlspecialchars($post->getChapo()) ?>
		</h3>
	</a>
	<p class="post-meta">
		Dernière modification le <?= $post->getDateModification()->format('d F Y à H:i:s') ?>
	</p>
</div>
<hr>
<?php endforeach ?>
<?php
$content= ob_get_clean();
require('view/template/page.php');
?>
