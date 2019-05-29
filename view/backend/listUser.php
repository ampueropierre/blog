<table class="table">
	<thead class="thead-light">
		<tr>
			<th>Prénom</th>
			<th>Nom</th>
			<th>Email</th>
			<th>Role</th>
			<th>Action</th>	
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<th><?= $user->getFirstname() ?></th>
				<td><?= $user->getLastname() ?></td>
				<td><?= $user->getMail() ?></td>
				<td><?= $user->getRoleName() ?></td>
				<td>
					<?php if ($user->getRolesId() != 1): ?>
					<a href="admin/users/update/<?= $user->getId() ?>" class="btn btn-outline-primary mr-2">Modifier</a>
					<a href="admin/users/delete/<?= $user->getId() ?>" class="btn btn-outline-danger delete-user" data-id=<?= $user->getId() ?>>Supprimer</a>
					<?php endif ?>	
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>