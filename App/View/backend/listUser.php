<?php ob_start(); ?>
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
				<td>
					<?php
					switch ($user->getRole()):
						case '1':
							echo 'Super Admin';
							break;
						case '2':
							echo 'Admin';
							break;
						default:
							echo 'Connecté';
							break;
					endswitch;
					?>		
				</td>
				<td>
					<?php if ($user->getRole() != 1): ?>
					<a href="admin/users/update/<?= $user->getId() ?>" class="btn btn-outline-primary mr-2">Modifier</a>
					<a href="admin/users/delete/<?= $user->getId() ?>" class="btn btn-outline-danger delete-user" data-id=<?= $user->getId() ?>>Supprimer</a>
					<?php endif ?>	
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php
$content = ob_get_clean();
require('view/template/page.php');
?>