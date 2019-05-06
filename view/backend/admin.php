<?php ob_start(); ?>
<?php if (isset($_GET['success'])):?>
<div class="alert alert-success" role="alert">
  	Le poste a bien été ajouter
</div>
<?php endif; ?>
<a href="?action=addPost" class="btn btn-primary mb-3">Ajouter un poste</a>

<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col">id</th>
			<th scope="col">Titre</th>
			<th scope="col">Date (dernière modification)</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $post): ?>
			<tr>
				<th><?= $post->id() ?></th>
				<td><?= $post->title() ?></td>
				<td><?= $post->dateModification()->format('d/m/Y à H:i:s') ?></td>
				<td><a href="?action=updatePost&id=<?= $post->id() ?>" class="text-primary mr-2">Modifier</a><a href="?action=deletePost&id=<?= $post->id() ?>" class="text-danger">Supprimer</a></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php
$content = ob_get_clean();
require('view/frontend/template/post.php');
?>