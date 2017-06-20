<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">

	<?php $target_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' ); ?>
		
	<?php echo form_open( '/form_controller/save_role/', '', array( 'target_url' => $target_url ) ); ?>
	
		<div class="row">

			<div class="input-field col s12">
				<p>Supply Type</p>
				<p>
					<input name="group1" type="radio" id="test1" checked="checked" />
					<label for="test1">Pharma</label>
				</p>
				<p>
					<input name="group1" type="radio" id="test2" />
					<label for="test2">Non Pharma</label>
				</p>
			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				<input id="last_name" type="text" class="validate">
				<label for="last_name">Supply Name</label>
			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				<select>
					<option value="" disabled selected>Choose the Brand</option>
					<option value="1">Brand X</option>
					<option value="2">Brand XX</option>
					<option value="3">Brand XXX</option>
				</select>
				<label>Brand Name</label>
			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				
				<select>
					<option value="" disabled selected>Choose the Disease</option>
					<option value="1">Disease X</option>
					<option value="2">Disease XX</option>
					<option value="3">Disease XXX</option>
				</select>
				<label>Disinfects</label>

			</div>

		</div>

		<div class="row">
			
			<div class="input-field col s6">
				
				<textarea id="textarea1" class="materialize-textarea"></textarea>
          		<label for="textarea1">Remarks</label>

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