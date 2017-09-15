<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	<div class="row">
	<?php $allow = isset($import_allow_ext) ? implode(",", $import_allow_ext) : ''; ?>
		<div class="col s12 center">
		<?php echo form_open_multipart('/upload_controller/upload_file', array('id'=>'upload_ajax_url')); ?>
		<?php
			echo form_upload(
				array(
					'name'		=>	'fileUpload',
					'id'		=>	'fileUpload',
					'hidden'	=>	true,
					'accept'	=>	$allow
				)
			);
		?>
		<?php echo form_close(); ?>
			<label for="fileUpload" class="btn-large red waves-effect waves-light" id="btn-fileUpload-trigger">Choose</label>
		</div>
	</div>

	<div class="row" id="cnsgnr-upload-file-details"><div class="col s12"></div></div>

	<div class="row" id="cnsgnr-list-data-upload"></div>

</main>
<?php $materialize_URL = base_url( '/materialize' ); ?>
<script type="text/javascript" src="<?php echo $materialize_URL; ?>/js/upload.js"></script>