<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$navigation_title = isset( $nav_title ) ? $nav_title : $this->uri->segment( 3 );
?>
<main>
	
	<div class="row">

		<nav class="blue-grey darken-3" style="padding-left:20px;">
			<div class="nav-wrapper">
				<a href=""><?php echo ucwords( $navigation_title ); ?></a>

				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li>
					<?php
						echo form_open( base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'search/' ) );
					?>
						<input id="search_role" type="search" name="search_<?php echo $this->uri->segment(2) . '_' . $this->uri->segment(3); ?>" placeholder="Search for..." />
					<?php	
						echo form_close();
					?>	
					</li>
					<li><a href="<?php echo base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'trash/' ); ?>" class="red-text">Trash Bin</a></li>
				</ul>

			</div>
		</nav>

	</div>

</main>