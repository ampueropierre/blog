<?php ob_start(); ?>

<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col">Prénom</th>
			<th scope="col">Nom</th>
			<th scope="col">Email</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<th><?= $user->getFirstname() ?></th>
				<td><?= $user->getLastname() ?></td>
				<td><?= $user->getMail() ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php
$content = ob_get_clean();
require('view/template/page.php');
?>