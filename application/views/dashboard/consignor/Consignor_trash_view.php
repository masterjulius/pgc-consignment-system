<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">
		
		<div class="col s12">

		<?php if ( $consignor_metadata != false ): ?>
				
			<div class="data-group">
				
				<div class="table-div">
				
					<table class="striped">
						
						<thead>
							<tr>
								<th>Name</th>
								<th>Address</th>
								<th>Contact Person</th>
								<th>Deleted On</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($consignor_metadata as $value) :
								$consignor_id = $value->consignor_id;
						?>
							<tr>
								<td><?= $value->consignor_name ?></td>
								<td><?= $value->consignor_address ?></td>
								<td><?= $value->consignor_contact_person ?></td>
								<td><?= date( "F d, Y g:i:s A", strtotime( $value->consignor_edited_date ) ) ?></td>
								<?php
									$restore_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'restore/' . $consignor_id . '/' );
								?>
								<td><a href="<?php echo $restore_url; ?>">Restore</a></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				
				</div>

			</div>

		<?php else: ?>
		
			<div class="row">

				<div class="col s12 m12">
        			<div class="card-panel teal">
          				<span class="white-text">
          					There were no datas available.
          				</span>
        			</div>
      			</div>

			</div>	

		<?php endif; ?>	
			
		</div>				

	</div>

</main>