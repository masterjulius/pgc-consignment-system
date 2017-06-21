<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">
		
		<?php $target_url = base_url( $this->uri->slash_rsegment(1) . 'edit-brand/' ); ?>
		
		<?php echo form_open( '/Form_glossary_group_controller/save_item_brand/', array( 'class' => 'col m6 l6' ), array( 'target_url' => $target_url ) ); ?>
	
		<div class="row">
			<div class="col s12">
				<p class="red-text"><?php echo validation_errors(); ?></p>
			</div>
		</div>


		<div class="row">
			
			<div class="input-field col s12">
				
			<?php
				echo form_input(
					array(
						'name'		=>	'brand_name',
						'id'		=>	'brand_name',
						'class'		=>	'validate',
						'autofocus'	=>	'autofocus'
					)
				);
			?>
				<label for="brand_name">Brand Name</label>	

			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s12">
				
			<?php
				echo form_textarea(
					array(
						'name'	=>	'remarks',
						'id'	=>	'remarks',
						'class'	=>	'materialize-textarea'
					)
				);
			?>
				<label for="remarks">Remarks</label>	

			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s12">
			<?php
				echo form_submit(
					array(
						'class'	=>	'btn',
						'value'	=>	'save'
					)
				);
			?>
			</div>

		</div>

		<?php echo form_close(); ?>

	</div>

</main>	