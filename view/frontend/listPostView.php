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
			<?= substr(nl2br(htmlspecialchars($post->content())),0, 100) ?>
		</p>
	</a>
	<p class="post-meta">
		Posté le <?= $post->dateCreation()->format('d F Y à H:i:s') ?>
	</p>
</div>
<hr>
<?php
}

$content= ob_get_clean();

require('view/frontend/template/page.php');
?>
