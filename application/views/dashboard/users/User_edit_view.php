<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( !isset( $user_metadata ) ) {

	// redirect( '/administrator/invalid/');

}
?>
<main>
	
	<div class="row">
		
		<div class="col m12 l12">
			
			<h4>Edit User</h4>

		</div>

		<?php $target_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' . $this->uri->slash_rsegment(4) ); ?>

		<?php echo form_open( '/form_controller/save_user/' . $this->uri->slash_rsegment(4) , '', array( 'target_url' => $target_url ) ); ?>

		<div class="row">
			
			<div class="input-field col s6">
				<p class="red-text"><?php $err = isset( $err_msg ) ? $err_msg : ''; ?></p>
			</div>

		</div>

		<div class="row">
			<div class="input-field col s6">
			<?php echo form_input( 'user_name', $user_metadata->user_name, array('class' => 'validate', 'id' => 'user_name', 'autofocus' => 'autofocus') ); ?>
				<label for="user_name">User Name</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s6">
			<?php echo form_password( 'user_password', '', array('class' => 'validate', 'id' => 'user_password') ); ?>
				<label for="user_password">Password</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s6">
			<?php echo form_password( 'confirm_user_password', '', array('class' => 'validate', 'id' => 'confirm_user_password') ); ?>
				<label for="confirm_user_password">Confirm Password</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s6">
			<?php echo form_password( 'current_password', '', array('class' => 'validate', 'id' => 'current_password') ); ?>
				<label for="current_password">Current Password</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s6">
				<?php
					$user_roles = $this->encryption->decrypt( $user_metadata->user_roles );
					$user_roles = json_decode( $user_roles );
					$select_role = $user_roles->roles->{'0'};
				?>
				<select name="user_role" id="">
					<option value="" disabled selected>Choose your option</option>
				<?php

					foreach ($roles_metadata as $key => $value) {
						$selected_attr = ( $key == $select_role ) ? 'selected': '';
				?>					
      					<option value="<?php echo $key; ?>" <?php echo $selected_attr; ?>><?php echo $value; ?></option>
				<?php		
					}
				?>	
				</select>
				<label>Choose Role</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s6">
		<?php echo form_submit( 'btnSubmit', 'SAVE', array( 'class' => 'waves-effect waves-light btn-large' ) ); ?>	
			</div>
		</div>

		<?php form_close(); ?>
		
	</div>		

</main>