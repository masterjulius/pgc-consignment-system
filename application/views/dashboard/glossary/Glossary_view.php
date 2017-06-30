<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$arr_datas = (array) $glossary_metadata;
?>
<main>
	
	<div class="row">

		<div class="col l12 table-data-div">

		<?php if ( count( $arr_datas ) > 0 || $glossary_metadata != false ): ?>
			
			<table class="striped responsive-table">
				
				<thead>
					<tr>
						<th>Item Name</th>
						<th>Description</th>
						<th>Disinfects</th>
						<th>Created on</th>
						<th>Created by</th>
						<th>Options</th>
					</tr>
				</thead>

				<tbody>
				<?php
					foreach ( $glossary_metadata as $value ):
						$glossary_id = $value->item_id;
				?>
					<tr>
						<td><?= $value->item_name ?></td>
						<td><?= $value->item_description ?></td>
						<td><?= $value->item_disinfects_disease_id ?></td>
						<td><?= date( 'F d, Y g:i:s A', strtotime( $value->item_date_created ) ) ?></td>
						<td><?php echo $usermetadata = $this->ext_meta->get_user_meta_data( $value->item_created_by )->user_name; ?></td>
						<?php $delete_targer_url = base_url( $this->uri->segment(2) . $this->uri->slash_rsegment(3) . 'delete/' . $glossary_id . '/' ); ?>
						<td><a href="<?php echo base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' . $glossary_id . '/' ); ?>">Edit</a> | <a href="!#" class="red-text" onclick="event.preventDefault();if(confirm('Are you sure you want to delete this item?')==true){window.location.href='<?php echo $delete_targer_url; ?>';}">Delete</a>
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

