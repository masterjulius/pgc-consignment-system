<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>

	<?php if ( false != $brand_metadata ): ?>
	
	<div class="row">
		
		<?php $target_url = base_url( $this->uri->slash_rsegment(1) .$this->uri->slash_rsegment(2) . $this->uri->slash_rsegment(3) ); ?>
		
		<?php echo form_open( '/Form_glossary_group_controller/save_item_brand/' . $this->uri->slash_rsegment(4), array( 'class' => 'col m6 l6' ), array( 'target_url' => $target_url ) ); ?>
	
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
						'autofocus'	=>	'autofocus',
						'value'		=>	$brand_metadata->brand_name
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
						'class'	=>	'materialize-textarea',
						'value'	=>	$brand_metadata->brand_description
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

	<?php else: ?>

	<div class="row">
		<div class="col s12 m12 l12">
			<div class="card-panel teal">
			<span class="white-text">There is no data for this brand.</span>
			</div>
		</div>
    </div>	

	<?php endif; ?>

</main>	