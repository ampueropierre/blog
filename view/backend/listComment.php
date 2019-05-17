<?php ob_start(); ?>
<?php if (isset($_GET['success'])):?>
<div class="alert alert-success" role="alert">
  	Le commentaire a bien été ajouter
</div>
<?php endif; ?>
<div>
	<h3>Liste des commentaires en attente</h3>
</div>
<table class="table mb-4">
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
			<?php if ($comment->getStatus() == 0): ?>	
			<tr>
				<th><?= $comment->getId() ?></th>
				<td>
					<?= substr($comment->getComment(),0,40) ?>
					<?php if(strlen($comment->getComment()) > 40): ?>
						...
					<?php endif; ?>
				</td>
				<td><?= $comment->getCommentDate()->format('d/m/Y à H:i:s') ?></td>
				<td><?= ($comment->getStatus() == 1) ? 'Valide' : 'Pas encore valide'?></td>
				<td><a href="?action=updateComment&id=<?= $comment->getId() ?>" class="text-primary mr-2">Modifier</a><a href="?action=deleteComment&id=<?= $comment->getId() ?>" class="text-danger">Supprimer</a></td>
			</tr>
			<?php endif ?>
		<?php endforeach; ?>
	</tbody>
</table>
<div>
	<h3>Liste des commentaires validés</h3>
</div>
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
			<?php if ($comment->getStatus() == 1): ?>
			<tr>
				<th><?= $comment->getId() ?></th>
				<td>
					<?= substr($comment->getComment(),0,40) ?>
					<?php if(strlen($comment->getComment()) > 40): ?>
						...
					<?php endif; ?>
				</td>
				<td><?= $comment->getCommentDate()->format('d/m/Y à H:i:s') ?></td>
				<td><?= ($comment->getStatus() == 1) ? 'Valide' : 'Pas encore valide'?></td>
				<td><a href="?action=updateComment&id=<?= $comment->getId() ?>" class="text-primary mr-2">Modifier</a><a href="?action=deleteComment&id=<?= $comment->getId() ?>" class="text-danger">Supprimer</a></td>
			</tr>
			<?php endif ?>
		<?php endforeach; ?>
	</tbody>
</table>
<?php
$content = ob_get_clean();
require('view/template/post.php');
?>