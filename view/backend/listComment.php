<?php ob_start(); ?>
<?php if (isset($_GET['success'])):?>
<div class="alert alert-success" role="alert">
  	Le poste a bien été ajouter
</div>
<?php endif; ?>
<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col">id</th>
			<th scope="col">Le commentaire</th>
			<th scope="col">Date</th>
			<th>Statut</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($comments as $comment): ?>
			<tr>
				<th><?= $comment->id() ?></th>
				<td><?= substr($comment->comment(),0,50) ?>...</td>
				<td><?= $comment->commentDate()->format('d/m/Y à H:i:s') ?></td>
				<td><?= ($comment->status() == 1) ? 'Valide' : 'Pas encore valide'?></td>
				<td><a href="?action=updateComment&id=<?= $comment->id() ?>" class="text-primary mr-2">Modifier</a><a href="?action=deleteComment&id=<?= $comment->id() ?>" class="text-danger">Supprimer</a></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php
$content = ob_get_clean();
require('view/frontend/template/post.php');
?>