<div class="bloc-comment">
	<h3 class="text-center mb-4">Liste des commentaires en attente(<?= count($commentWaiting) ?>)</h3>
	<?php if (empty($commentWaiting)): ?>
		<p class="text-center">Aucun commentaire en attente</p>
	<?php else: ?>
	<table class="table">
		<thead class="thead-light">
			<tr class="flex">
				<th style="width: 45%;">Le commentaire</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($commentWaiting as $comment): ?>
			<tr>
				<td><?= substr($comment->getContent(),0,40) ?><?php if(strlen($comment->getContent()) > 40): ?>
						...
						<?php endif; ?>
				</td>
				<td><?= $comment->getCommentDate()->format('d/m/Y à H:i:s') ?></td>
				<td class="d-flex justify-content-center">
					<a href="admin/comments/update/<?= $comment->getId() ?>" class="btn btn-outline-primary mr-2">Modifier</a>
					<a href="admin/comments/delete/<?= $comment->getId() ?>" class="btn btn-outline-danger delete-comment">Supprimer</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
</div>

<div class="bloc-comment">
	<h3 class="text-center mb-4">Liste des commentaires validés(<?= count($commentValid)?>)</h3>
	<?php if (empty($commentValid)): ?>
		<p class="text-center">Aucun commentaire en attente</p>
	<?php else: ?>
	<table class="table">
		<thead class="thead-light">
			<tr class="flex">
				<th style="width: 45%;">Le commentaire</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($commentValid as $comment): ?>
			<tr>
				<td>
					<?= substr($comment->getContent(),0,40) ?>
					<?php if(strlen($comment->getContent()) > 40): ?>
						...
					<?php endif; ?>
				</td>
				<td><?= $comment->getCommentDate()->format('d/m/Y à H:i:s') ?></td>
				<td class="d-flex justify-content-center">
					<a href="admin/comments/update/<?= $comment->getId() ?>" class="btn btn-outline-primary mr-2">Modifier</a>
					<a href="admin/comments/delete/<?= $comment->getId() ?>" class="btn btn-outline-danger delete-comment">Supprimer</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
</div>