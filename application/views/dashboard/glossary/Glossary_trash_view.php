<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">
		
		<div class="col s12">

		<?php if ( $glosary_metadata != false ): ?>
				
			<div class="data-group">
				
				<div class="table-div">
				
					<table class="striped">
						
						<thead>
							<tr>
								<th>Glossary Name</th>
								<th>Description</th>
								<th>Date Deleted</th>
								<th>Deleted By</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($glosary_metadata as $value) :
								$item_id = $value->item_id;
						?>
							<tr>
								<td><?= $value->item_name ?></td>
								<td><?= $value->item_description ?></td>
								<td><?= date( "F d, Y g:i:s A", strtotime( $value->item_edited_date ) ) ?></td>
								<td><?= $this->ext_meta->get_user_meta_data( $value->item_edited_by )->user_name ?></td>
								<?php
									$restore_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'restore/' . $item_id . '/' );
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