<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$arr_datas = (array) $consignor_metadatas;
?>
<main>
	
	<div class="row">

		<div class="col l12 table-data-div">

		<?php if ( $consignor_metadatas != false ): ?>
			
			<table class="striped responsive-table">
				
				<thead>
					<tr>
						<th>Name</th>
						<th>Address</th>
						<th>Contact Person</th>
						<th>Created on</th>
						<th>Options</th>
					</tr>
				</thead>

				<tbody>
				<?php
					foreach ( $consignor_metadatas as $value ):
						$consignor_id = $value->consignor_id;
				?>
					<tr>
						<td><?= $value->consignor_name ?></td>
						<td><?= $value->consignor_address ?></td>
						<td><?= $value->consignor_contact_person ?></td>
						<td><?= date( 'F d, Y g:i:s A', strtotime( $value->consignor_created_date ) ) ?></td>
						<?php $delete_targer_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . $this->uri->segment(3) . 'delete/' . $consignor_id . '/' ); ?>
						<td><a href="<?php echo base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' . $consignor_id . '/' ); ?>">Edit</a> | <a href="!#" class="red-text" onclick="event.preventDefault();if(confirm('Are you sure you want to delete this consignor?')==true){window.location.href='<?php echo $delete_targer_url; ?>';}">Delete</a>
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