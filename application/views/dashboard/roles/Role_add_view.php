<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>

	<div class="row">
		
		<div class="col m12 l12">
			
			<h4>Add User Role</h4>

		<?php $target_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' ); ?>	

		<?php echo form_open( '/form_controller/save_role/', '', array( 'target_url' => $target_url ) ); ?>

		<div class="row">
			<div class="input-field col s6">
			<?php echo form_input( 'role_name', '', array('class' => 'validate', 'id' => 'role_name', 'autofocus' => 'autofocus') ); ?>
				<label for="role_name">Role Name</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s6">
			<?php echo form_textarea( 'role_description', '', array('class' => 'materialize-textarea', 'id' => 'role_description') ); ?>
				<label for="role_description">Role Description</label>
			</div>
		</div>

		<div class="row">

			<div class="col s12">

				<table class="striped responsive-table">
					<thead>
						<tr>
							<th>Page Name</th>
							<th class="center-align">Create</th>
							<th class="center-align">Edit</th>
							<th class="center-align">Delete</th>
							<th class="center-align">Read</th>
							<th class="center-align">Save</th>
							<th class="center-align">Edit Others</th>
							<th class="center-align">Delete Others</th>
							<th class="center-align">Print</th>
							<th class="center-align">Import</th>
							<th class="center-align">Export</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($admin_pages as $key => $value):
					?>			
							<tr class="switch">

								<td>
								<?php
									echo $page_name =  $admin_pages[$key]->name;
									echo form_hidden( 'page_name[]', strtolower( $page_name ) );
								?>	
								</td>

					<?php	
							foreach ($admin_pages[$key]->capabilities as $capKey => $capValue):		
								$chkbox_name = strtolower( $capKey . '-' . $page_name );
					?>
								<td class="center-align">
								<?php
									$tableDatas = array(
										'name'	=> $capKey . '[]',
										'id'	=> $chkbox_name,
										'value'	=> $chkbox_name
									);
									echo form_checkbox( $tableDatas );
								?>
									<label for="<?php echo $chkbox_name; ?>"></label>
								</td>
							
					<?php 	endforeach; ?>

							</tr>

					<?php endforeach; ?>
					</tbody>
				</table>

			</div>

		</div>

		<div class="row">
		<?php echo form_submit( 'btnSubmit', 'SAVE', array( 'class' => 'waves-effect waves-light btn-large' ) ); ?>	
		</div>

			<?php echo form_close(); ?>

		</div>

	</div>

