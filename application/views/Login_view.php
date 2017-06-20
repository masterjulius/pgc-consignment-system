<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="sign-in-container">
	<div class="section"></div>
	<center>
		<!-- <img class="responsive-img" style="width: 250px;" src="https://i.imgur.com/ax0NCsK.gif" /> -->
		<div class="section"></div>

		<h5 class="indigo-text">Please, login into your account</h5>
		<div class="section"></div>

		<div class="container">
			<div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

				<?php echo form_open( '/form_controller/user_sign_in/', '', array( 'target_url' => $this->uri->uri_string() ) ); ?>
				
				<div class="row">
					<div class="col s12">
						<p class="red-text"><?php echo validation_errors(); ?></p>
					</div>
				</div>

				<div class='row'>
					<div class='input-field col s12'>
						<?php
						echo form_input(
							array(
								'name' 		=> 'username',
								'class' 	=> 'validate',
								'id'		=> 'username',
								'autofocus'	=> 'autofocus'
								)
							);
							?>
							<label for='username'>Enter your username</label>
						</div>
					</div>

					<div class='row'>
						<div class='input-field col s12'>
							<?php
							echo form_password(
								array(
									'name' 	=> 'password',
									'class' => 'validate',
									'id'	=> 'password'	
									)
								);
								?>
								<label for='password'>Enter your password</label>
							</div>
							<label style='float: right;'>
								<a class='pink-text' href='#!'><b>Forgot Password?</b></a>
							</label>
						</div>

						<br />
						<center>
							<div class='row'>
								<button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
							</div>
						</center>

						<?php echo form_close(); ?>

					</div>
				</div>
				<a href="<?php echo base_url(); ?>">&larr; Back to Consignment System</a>
			</center>

			<div class="section"></div>
			<div class="section"></div>
</div>	