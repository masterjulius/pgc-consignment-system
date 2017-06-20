<div class="container">
	
	<div class="row">
			
		<div class="col s12">
			<h5><?php if ( isset( $err_msg ) ) { echo $err_msg; } else { echo "There was an error in the form submission"; } ?></h5>
		</div>

		<div class="col s12">
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn waves-effect waves-light">&larr; Go Back</a>
		</div>

	</div>


</div>