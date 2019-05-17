<?php ob_start(); ?>
<?php if (isset($errors) && in_array($userValidator::ROLE_NOTEXIST, $errors)): ?>
<div class="alert alert-danger">
	Le role n'existe pas
</div>
<?php elseif(isset($updateRole)): ?>
<div class="alert alert-success">
	Le role a bien été modifié
</div>
<?php endif; ?>
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
					<a href="#" class="text-primary mr-2" data-toggle="modal" data-target="#Modal-user-<?= $user->getId() ?>">Modifier</a><a href="?action=deleteUser&id=<?= $user->getId() ?>" class="text-danger">Supprimer</a>	
					<?php endif ?>	
				</td>
				<!-- Modal -->
				<div class="modal fade" id="Modal-user-<?= $user->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="Modal-user-<?= $user->getId() ?>-Label" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="Modal-user-<?= $user->getId() ?>-Label">Modifier</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Prénom : <?= $user->getFirstname() ?></p>
								<p>Nom : <?= $user->getLastname() ?></p>
								<p>Email : <?= $user->getMail() ?></p>
								<form action="" method="POST">
									<div class="form-group-inline">
										<label for="role">Role : </label>
										<select name="role" id="role">
											<option value="2">Admin</option>
											<option value="3">Connecté</option>
										</select>
									</div>
									<input type="hidden" name="id" value="<?= $user->getId() ?>">

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
								<button type="submit" name="update" class="btn btn-primary">Modifier</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<?php
$content = ob_get_clean();
require('view/template/page.php');
?>