<section>
	<div class="container">
		<div class="row">
			<h2>Liste des Poste</h2>
			<a href="?action=addPost" class="btn btn-primary">Ajouter un poste</a>
		</div>	
		<div class="row">
			<table class="table table-dark">
				<thead>
					<tr>
						<th scope="col">id</th>
						<th scope="col">Titre</th>
						<th scope="col">Date</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($posts as $post): ?>
					<tr>
						<th><?= $post->id() ?></th>
						<td><?= $post->title() ?></td>
						<td><?= $post->dateCreation()->format('d m Y à H:i:s') ?></td>
						<td><a href="">Modifier</a><a href="?action=deletePost&id=<?= $post->id() ?>" class="btn btn-warning">Supprimer</a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>	
	</div>	
</section>