<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">

	<?php $target_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' ); ?>
		
	<?php echo form_open( '/form_glossary_group_controller/save_glossary/', '', array( 'target_url' => $target_url ) ); ?>
	
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
				<input id="supply_name" type="text" class="validate" autofocus="autofocus" />
				<label for="supply_name">Supply Name</label>
			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				<select name="brand">
					<option value="" disabled selected>Choose the Brand</option>
				<?php
					foreach ( $list_brands as $value ) :
				?>	
					<option value="<?= $value->brand_id ?>"><?= $value->brand_name ?></option>
				<?php endforeach; ?>	
				</select>
				<label>Brand Name</label>
			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				
				<select name="disease">
					<option value="" disabled selected>Choose the Disease</option>
				<?php
					foreach ( $list_diseases as $value ) :
				?>	
					<option value="<?= $value->disease_id ?>"><?= $value->disease_name ?></option>
				<?php endforeach; ?>	
				</select>
				<label>Disinfects</label>

			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				
				<textarea id="description" class="materialize-textarea" name="description"></textarea>
          		<label for="description">Description</label>

			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				
				<input type="submit" class="btn" value="SAVE" />

			</div>

		</div>

	<?php echo form_close(); ?>

	</div>

</main>