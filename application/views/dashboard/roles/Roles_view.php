<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$arr_datas = (array) $role_metadata;
?>
<main>
	
	<div class="row">

		<div class="col l12 table-data-div">

		<?php if ( count( $arr_datas ) > 0 ): ?>
			
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
						<td><?= date( 'F d, Y g:i:s A', strtotime( $value->role_created_date ) ) ?></td>
						<td><?php echo $usermetadata = $this->ext_meta->get_user_meta_data( $value->role_created_by )->user_name; ?></td>
						<?php $delete_targer_url = base_url( '/form_controller/delete_role/' . $role_id . '/' ); ?>
						<td><a href="<?php echo base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' . $role_id . '/' ); ?>">Edit</a> | <a href="!#" class="red-text" onclick="event.preventDefault();if(confirm('Are you sure you want to delete this role?')==true){window.location.href='<?php echo $delete_targer_url; ?>';}">Delete</a>
						</td>
					</tr>
				<?php endforeach; ?>	
				</tbody>

			</table>
		<?php else: ?>
			<div class="row">
				<div class="col l12 m12">
					<h5>Sorry there were no records found</h5>
				</div>
			</div>
		<?php endif; ?>

			<div class="row pagination-row">
				<div class="col s12 center">
				<?php
					$this->pagination->initialize($config);
					echo $this->pagination->create_links();
				?>	
				</div>
			</div>	

		</div>

	</div>

</main>

