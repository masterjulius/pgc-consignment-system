<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">

	<?php if ( $glossary_metadata != false ) : ?>

	<?php $target_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' ); ?>
		
	<?php echo form_open( '/form_glossary_group_controller/save_glossary/' . $this->uri->slash_rsegment(4), '', array( 'target_url' => $target_url, 'supply_id'	=> $this->uri->segment(4) ) ); ?>
	
		<div class="row">

			<div class="input-field col s12">
				<p>Supply Type</p>
				<p>
					<input name="supply_type" type="radio" id="pharma" value="1" checked="checked" />
					<label for="pharma">Pharma</label>
				</p>
				<p>
					<input name="supply_type" type="radio" id="non_pharma" value="0" />
					<label for="non_pharma">Non Pharma</label>
				</p>
			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				<input name="supply_name" id="supply_name" type="text" class="validate" autofocus="autofocus" value="<?php echo $glossary_metadata->item_name; ?>" />
				<label for="supply_name">Supply Name</label>
			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				
				<select name="disease">
					<option value="" disabled>Choose the Disease</option>
				<?php
					foreach ( $list_diseases as $value ) :
						$selected = $glossary_metadata->item_disinfects_disease_id ? 'selected': '';
				?>	
					<option value="<?= $value->disease_id ?>" <?php echo $selected; ?>><?= $value->disease_name ?></option>
				<?php endforeach; ?>	
				</select>
				<label>Disinfects</label>

			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				
				<textarea id="description" class="materialize-textarea" name="description"><?php echo $glossary_metadata->item_description; ?></textarea>
          		<label for="description">Description</label>

			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				
				<input type="submit" class="btn" value="SAVE" />

			</div>

		</div>

	<?php echo form_close(); ?>

	<?php endif; ?>

	</div>

</main>