<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">
		
		<div class="col m12 l12">
			
			<h4>Add User</h4>

		</div>

		<?php
			$target_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' );
			// set the role id into a session for security purposes
			$system_session_prefix = 'cnsgnmnt_sess_prefix_';
			$this->session->set_userdata( $system_session_prefix . 'user_id_to_edit', $this->uri->segment(4) );
		?>

		<?php echo form_open( '/form_controller/save_user/', '', array( 'target_url' => $target_url ) ); ?>

		<div class="row">
			<div class="input-field col s6">
			<?php echo form_input( 'user_name', '', array('class' => 'validate', 'id' => 'user_name', 'autofocus' => 'autofocus') ); ?>
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
				<select name="user_role" id="">
					<option value="" disabled selected>Choose your option</option>
				<?php
					foreach ( $roles_metadata as $key => $value ) {
				?>					
      					<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
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