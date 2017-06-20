<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$arr_datas = (array) $roles_log_metadata;
?>
<main>
	
	<div class="row">

		<div class="col l12 table-data-div">

		<?php if ( count( $arr_datas ) > 0 ): ?>
			
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
					foreach ( $roles_log_metadata as $value ):
						$meta_id = $value->meta_id;
						$meta_value = json_decode( $value->meta_value );
						$role_operated_by = $meta_value->created_by;
				?>
					<tr>
						<td><?= $value->meta_action ?></td>
						<td><?php echo $usermetadata = $this->ext_meta->get_user_meta_data( $role_operated_by )->user_name; ?></td>
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