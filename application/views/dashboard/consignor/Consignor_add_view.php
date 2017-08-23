<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	
	<div class="row">

	<?php $target_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'edit/' ); ?>
	<?php echo form_open( '/form_consignor_controller/save_consignor/', '', array( 'target_url' => $target_url, 'count_documents'	=>	count( (array) $consignor_documents) ) ); ?>
	
		<div class="row">
			<div class="input-field col s6">
				<input name="consignor_name" id="consignor_name" value="<?php echo set_value('consignor_name'); ?>" type="text" class="validate" autofocus="autofocus" />
				<label for="consignor_name">Consignor Name</label>
			</div>
	
			<div class="input-field col s6">
				<textarea name="consignor_address" id="consignor_address" type="text" class="materialize-textarea"><?php echo set_value('consignor_address'); ?></textarea>
				<label for="consignor_address">Consignor Address</label>
			</div>

		</div>

		<div class="row">
			<div class="input-field col s6">
				<input name="consignor_contact_person" id="consignor_contact_person" value="<?php echo set_value('consignor_contact_person'); ?>" type="text" class="validate" />
				<label for="consignor_contact_person">Consignor Contact Person</label>
			</div>

			<div class="input-field col s6">
				
				<select name="consignor_contact_person_position">
					<option value="" disabled selected>Choose the Position</option>
				<?php $selected = set_value('consignor_contact_person_position'); ?>	
					<option value="1" <?php if ( $selected === "1" ) {echo "selected";} ?>>Chief Executive Officer</option>
					<option value="2" <?php if ( $selected === "2" ) {echo "selected";} ?>>President</option>
					<option value="3" <?php if ( $selected === "3" ) {echo "selected";} ?>>Chairman</option>
				</select>
				<label for="consignor_contact_person_position">Contact Person Position</label>

			</div>

		</div>

		<div class="row">
			<div class="input-field col s6">
				<input name="consignor_contact_information" id="consignor_contact_information" value="<?php echo set_value('consignor_contact_information'); ?>" type="text" class="validate" />
				<label for="consignor_contact_information">Contact Information</label>
			</div>
		</div>

		<!-- Accreditation Details -->
		<div class="row">
			
			<div class="row">
				<div class="col s12">
					<h5>Accreditation Details</h5>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<table class="striped">
						<thead>
							<tr>
								<th>Eligibility Documents</th>
								<th>Passed</th>
								<th>Failed</th>
							</tr>
						</thead>

						<tbody>
					<?php
						if ( false != $consignor_documents ) :
							$index = 1;
							foreach ($consignor_documents as $value) :
								$accrdtn_id = $value->accreditation_id;
								$groups = "accreditation_id__" . $index;
					?>	
								<tr>
									<td>
									<?php echo $value->accreditation_document; ?>	
									</td>
									<td>
										<p>
										    <input class="with-gap" name="<?php echo $groups; ?>" type="radio" id="rdio<?php echo ucfirst( $groups ); ?>_Passed" value="<?php echo $accrdtn_id; ?>_1" checked />
											<label for="rdio<?php echo ucfirst( $groups ); ?>_Passed">Passed</label>
										</p>
									</td>
									<td>
										<p>
										    <input class="with-gap" name="<?php echo $groups; ?>" type="radio" id="rdio<?php echo ucfirst( $groups ); ?>_Failed" value="<?php echo $accrdtn_id; ?>_0" />
											<label for="rdio<?php echo ucfirst( $groups ); ?>_Failed">Failed</label>
										</p>
									</td>
								</tr>
					<?php
								$index++;
							endforeach;
						endif;
					?>

						</tbody>
					</table>
				</div>
			</div>

		</div>	

		<!-- End of Accreditation Details -->

		<div class="row">
			<div class="col s12">
				<input type="submit" name="btnSubmit" value="save" class="btn" />
			</div>	
		</div>

	<?php echo form_close(); ?>	

	</div>
	
</main>		