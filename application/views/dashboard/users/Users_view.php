<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$arr_datas = (array) $users_metadata;
?>
<main>
	
	<div class="row">

		<div class="col l12 table-data-div">

			<?php if ( count( $arr_datas ) > 0 ): ?>
			
			<table class="striped responsive-table">
				
				<thead>
					<tr>
						<th>User Name</th>
						<th>Role</th>
						<th>Created on</th>
						<th>Created by</th>
						<th>Options</th>
					</tr>
				</thead>

				<tbody>
				<?php
					foreach ($users_metadata as $row):
						$user_id = $row->user_id;
						$role = $this->encryption->decrypt( $row->user_roles );
						$role = json_decode( $role );
						$role_id = $role->roles->{'0'};
						$role = $this->ext_meta->get_role_meta_data( $role_id, 'role_name' );
				?>

					<tr>
						<td><?= $row->user_name ?></td>
						<td><?= $role ?></td>
						<td><?= date( 'F d, Y g:i:s A', strtotime( $row->user_created_date ) ) ?></td>
						<td><?= $this->ext_meta->get_user_meta_data( $row->user_created_by )->user_name ?></td>
						
						<?php $delete_targer_url = base_url( '/form_controller/delete_user/' . $user_id . '/' ); ?>

						<td><a href="<?php echo base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' . $user_id . '/' ); ?>">Edit</a> | <a href="!#" class="red-text" onclick="event.preventDefault();if(confirm('Are you sure you want to delete this user?')==true){window.location.href='<?php echo $delete_targer_url; ?>';}">Delete</a>
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
			
		</div>

		<div class="row pagination-row">
			<div class="col s12 center">
				<?php
				$this->pagination->initialize( $config );
				echo $this->pagination->create_links();
				?>	
			</div>
		</div>	
		
	</div>
	
</main>				