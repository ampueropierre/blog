<?php ob_start(); ?>
<?php if (isset($_GET['success'])):?>
<div class="alert alert-success" role="alert">
	Le poste a bien été supprimer
</div>
<?php endif; ?>
<a href="admin/posts/add" class="btn btn-primary mb-3">Ajouter un poste</a>

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
				<th><?= $post->getId() ?></th>
				<td><?= $post->getTitle() ?></td>
				<td><?= $post->getDateModification()->format('d/m/Y à H:i:s') ?></td>
				<td><a href="admin/posts/update/<?= $post->getId() ?>" class="btn btn-outline-primary mr-2">Modifier</a><a href="admin/posts/delete/<?= $post->getId() ?>" class="btn btn-outline-danger">Supprimer</a></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php
$content = ob_get_clean();
require('view/template/page.php');
?>