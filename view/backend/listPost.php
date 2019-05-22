<?php ob_start(); ?>
<?php if (isset($_GET['success'])):?>
	<div class="alert alert-success" role="alert">
	<?php switch ($_GET['success']):
		case 'add':
			echo "Le poste a bien été ajouter";
			break;
		case 'update':
			echo "Le poste a bien été modifier";
			break;
		case 'delete':
			echo "Le poste a bien été supprimer";
			break;
	endswitch;
  	?>
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
				<td><a href="admin/posts/update/<?= $post->getId() ?>" class="text-primary mr-2">Modifier</a><a href="?action=deletePost&id=<?= $post->getId() ?>" class="text-danger">Supprimer</a></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php
$content = ob_get_clean();
require('view/template/post.php');
?>