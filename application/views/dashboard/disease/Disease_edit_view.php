<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>

	<?php if ( false != $disease_metadata ): ?>
	
	<div class="row">
		
		<?php $target_url = base_url( $this->uri->slash_rsegment(1) .$this->uri->slash_rsegment(2) . $this->uri->slash_rsegment(3) ); ?>
		
		<?php echo form_open( '/Form_glossary_group_controller/save_disease/' . $this->uri->slash_rsegment(4), array( 'class' => 'col m6 l6' ), array( 'target_url' => $target_url ) ); ?>
	
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
						'name'		=>	'disease_name',
						'id'		=>	'disease_name',
						'class'		=>	'validate',
						'autofocus'	=>	'autofocus',
						'value'		=>	$disease_metadata->disease_name
					)
				);
			?>
				<label for="disease_name">Disease Name</label>	

			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s12">
				
			<?php
				echo form_textarea(
					array(
						'name'	=>	'description',
						'id'	=>	'description',
						'class'	=>	'materialize-textarea',
						'value'	=>	$disease_metadata->disease_description
					)
				);
			?>
				<label for="Description">Description</label>	

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
			<span class="white-text">There is no data for this disease.</span>
			</div>
		</div>
    </div>	

	<?php endif; ?>

</main>	