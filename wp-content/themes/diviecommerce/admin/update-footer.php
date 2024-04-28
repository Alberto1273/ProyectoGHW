<?php
/*
* Contains code copied from and/or based on Divi and WordPress
* See the license.txt file in the root directory for more information and licenses
*
*/

if ( ! get_option('wpz_footer_link') ) {
	add_action( 'init', 'wpz_update_footer_links' );
}

function wpz_update_footer_links() {

	$defaultFooterCredits = et_get_option('custom_footer_credits');
	$newDefaultFooterCredits = str_replace(
		[
			'Designed by <a href="https://divi.space">Divi Space</a> (An <a href="https://aspengrovestudios.com">Aspen Grove Studios Company</a>) | © 2015 - 2020  All Rights Reserved'
		],
		[
			'Designed by <a href="https://wpzone.co">WP Zone</a> | © 2015 - 2023  All Rights Reserved'
		],
		$defaultFooterCredits
	);
	if ($newDefaultFooterCredits != $defaultFooterCredits) {
		et_update_option('custom_footer_credits', $newDefaultFooterCredits);
	}

	add_option( 'wpz_footer_link', 1 );
}