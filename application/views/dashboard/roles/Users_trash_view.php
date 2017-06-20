<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">
		
		<div class="col l12">
			
			<h5 class="valign-wrapper">Trash</h5>

		</div>

		<div class="table-options-div">
			
		</div>

		<div class="col l12 table-data-div">
			
			<table class="striped responsive-table">
				
				<thead>
					<tr>
						<th>Role Name</th>
						<th>Description</th>
						<th>Capability count</th>
						<th>Created on</th>
						<th>Created by</th>
						<th>Options</th>
					</tr>
				</thead>

				<tbody>
				<?php
					foreach ($role_metadata as $value):
						$role_id = $value->role_id;
				?>
					<tr>
						<td><?= $value->role_name ?></td>
						<td><?= $value->role_description ?></td>
						<td><?= $value->role_capability_count ?></td>
						<td><?= $value->role_created_date ?></td>
						<td><?php echo $usermetadata = $this->ext_meta->get_user_meta_data( $value->role_created_by )->user_name; ?></td>
						<?php $restore_targer_url = base_url( '/form_controller/restore_role/' . $role_id . '/' ); ?>
						<td>
							<a href="<?php echo $restore_targer_url; ?>">Restore</a>
						</td>
					</tr>
				<?php endforeach; ?>	
				</tbody>

			</table>

		</div>

	</div>

</main>