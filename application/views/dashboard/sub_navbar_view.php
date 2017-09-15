<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$navigation_title = isset( $nav_title ) ? $nav_title : $this->uri->segment( 2 );
$add_url = isset( $add_new_url ) ? $add_new_url : base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'new/' );
?>
<main>
	
	<div class="row">

		<nav class="blue-grey darken-3" style="padding-left:20px;">
			<div class="nav-wrapper">
				<a href=""><?php echo ucwords( $navigation_title ); ?></a>
				<a href="<?php echo $add_url; ?>" class="btn">Add New</a>

			<?php if ( isset( $import_url ) ): ?>
				<a href="<?php echo $import_url; ?>" class="btn pink">Import</a>
			<?php endif; ?>	

				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li>
					<?php
						echo form_open( base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'search/' ) );
					?>
						<input id="search_role" type="search" name="search_<?php echo $this->uri->segment(2); ?>" placeholder="Search for..." />	
					<?php	
						echo form_close();
					?>

					<li>
						<a href="<?php echo base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'logs/' ); ?>"><i class="left icon-cnsgnmnt-report"></i> Logs</a>
					</li>	
					</li>
					<li><a href="<?php echo base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'trash/' ); ?>" class="red-text">Trash Bin</a></li>
				</ul>

			</div>
		</nav>

	</div>

</main>