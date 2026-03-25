<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="em-dsimisable-content-holder" style="display: none;">
	<button type="button" class="em-dismiss-content-close" aria-label="<?php esc_html_e( 'Zatvori obaveštenje', 'elektromikron' ); ?>">
		&times;
	</button>
	<?php dynamic_sidebar( 'em-dsimisable-content' ); ?>
</div>
