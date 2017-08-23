<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">

		<div class="col l12 table-data-div">

		<?php if ( $log_metadata != false ): ?>
			
			<table class="striped responsive-table">
				
				<thead>
					<tr>
						<th>Action</th>
						<th>Operated By</th>
						<th>Created On</th>
						<th>Options</th>
					</tr>
				</thead>

				<tbody>
				<?php
					foreach ( $log_metadata as $value ):
						$meta_id = $value->meta_id;
						$meta_value = json_decode( $value->meta_value );
						$meta_key = $value->meta_key;
						if ( $meta_key === '_delete_glossary_item' || $meta_key === '_restore_glossary_item' ) {
							$operated_by = $meta_value->created_by;
						} else if ( $meta_key === '_create_glossary_item' ) {
							$operated_by = $meta_value->meta_datas->item_created_by;
						} else {
							$operated_by = $meta_value->new->meta_datas->operated_by;
						}

						// actions
						$meta_action = 'Created A Item';
						switch ( $meta_key ) {

							case '_edit_glossary_item':
								$meta_action = 'Updated A Item';
								break;

							case '_delete_glossary_item':
								$meta_action = 'Deleted A Item';
								break;
								
							case '_restore_glossary_item':
								$meta_action = 'Restored A Item';
								break;	
							
							default:
								$meta_action = 'Created A Item';
								break;

						}
				?>
					<tr>
						<td><?= $meta_action ?></td>
						<td><?php echo $usermetadata = $this->ext_meta->get_user_meta_data( $operated_by )->user_name; ?></td>
						<td><?= date( 'F d, Y g:i:s A', strtotime( $value->meta_date_created ) ) ?></td>

						<?php $view_targer_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'logview/' . $meta_id . '/' ); ?>
						<td>
							<a href="<?php echo $view_targer_url; ?>">Read Details</a>
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
					$this->pagination->initialize( $config );
					echo $this->pagination->create_links();
				?>	
				</div>
			</div>	

		</div>

	</div>

</main>