<h3 class="text-center mb-4">Liste des commentaires en attente</h3>

<table class="table mb-4">
	<thead class="thead-light">
		<tr>
			<th scope="col">id</th>
			<th scope="col">Le commentaire</th>
			<th scope="col">Date</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($comments as $comment): ?>
			<?php if ($comment->getStatus() == 0): ?>	
			<tr>
				<td><?= $comment->getId() ?></td>
				<td><?= substr($comment->getComment(),0,40) ?><?php if(strlen($comment->getComment()) > 40): ?>
						...
					<?php endif; ?>
				</td>
				<td><?= $comment->getCommentDate()->format('d/m/Y à H:i:s') ?></td>
				<td>
					<a href="admin/comments/update/<?= $comment->getId() ?>" class="btn btn-outline-primary mr-2">Modifier</a>
					<a href="admin/comments/delete/<?= $comment->getId() ?>" class="btn btn-outline-danger delete-comment">Supprimer</a>
				</td>
			</tr>
			<?php endif ?>
		<?php endforeach; ?>
	</tbody>
</table>

<h3 class="text-center mb-4">Liste des commentaires validés</h3>

<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col">id</th>
			<th scope="col">Le commentaire</th>
			<th scope="col">Date</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($comments as $comment): ?>
			<?php if ($comment->getStatus() == 1): ?>
			<tr>
				<td><?= $comment->getId() ?></td>
				<td>
					<?= substr($comment->getComment(),0,40) ?>
					<?php if(strlen($comment->getComment()) > 40): ?>
						...
					<?php endif; ?>
				</td>
				<td><?= $comment->getCommentDate()->format('d/m/Y à H:i:s') ?></td>
				<td>
					<a href="admin/comments/update/<?= $comment->getId() ?>" class="btn btn-outline-primary mr-2">Modifier</a>
					<a href="admin/comments/delete/<?= $comment->getId() ?>" class="btn btn-outline-danger delete-comment">Supprimer</a>
				</td>
			</tr>
			<?php endif ?>
		<?php endforeach; ?>
	</tbody>
</table>