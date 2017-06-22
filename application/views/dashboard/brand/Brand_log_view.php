<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">
		
		<div class="col s12">

		<?php if ( $log_metadata != false ): ?>
				
			<div class="data-group">
				
				<div class="table-div">
				
					<table class="striped">
						
						<thead>
							<tr>
								<th>Action</th>
								<th>Operated By</th>
								<th>Operated On</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ( $log_metadata as $value ) :
								$meta_id = $value->meta_id;
								$decoded_meta_value = json_decode( $value->meta_value );
								$operated_by = $decoded_meta_value->created_by;
						?>
							<tr>
								<td><?= $value->meta_action ?></td>
								<td><?= $this->ext_meta->get_user_meta_data( $operated_by )->user_name ?></td>
								<td><?= date( "F d, Y g:i:s A", strtotime( $value->meta_created_date ) ) ?></td>
								<?php
									$view_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'viewlog/' . $meta_id . '/' );
								?>
								<td><a href="<?php echo $view_url; ?>">View</a></td>
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