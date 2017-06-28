<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$arr_datas = (array) $disease_metadata;
?>
<main>
	
	<div class="row">
		
		<div class="col s12">
				
		<?php if ( $disease_metadata != false ) : ?>
			<div class="data-group">
				
				<div class="table-div">
				
					<table class="striped">
						
						<thead>
							<tr>
								<th>Disease Name</th>
								<th>Description</th>
								<th>Date Created</th>
								<th>Created By</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
					<?php
						foreach ($disease_metadata as $value) :
							$disease_id = $value->disease_id;
					?>
							<tr>
								<td><?= $value->disease_name ?></td>
								<td><?= $value->disease_description ?></td>
								<td><?= date( "F d, Y g:i:s A", strtotime( $value->disease_created_date ) ) ?></td>
								<td><?= $this->ext_meta->get_user_meta_data( $value->disease_created_by, 'user_name' ) ?></td>
					<?php
							$action_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) );
							$delete_url = $action_url . 'delete/' . $disease_id . "/";
					?>			
								<td><a href="<?php echo $action_url . 'edit/' . $disease_id; ?>">Edit</a> | <a href="<?php echo $delete_url; ?>" class="red-text" onclick="event.preventDefault();if(confirm('Are you sure you want to delete this role?')==true){window.location.href='<?php echo $delete_url; ?>';}">Delete</a></td>
							</tr>
					<?php endforeach; ?>		
						</tbody>

					</table>

				</div>

				<div class="pagination-div">
					
				</div>

			</div>
		<?php endif; ?>	

		</div>	

	</div>

</main>	