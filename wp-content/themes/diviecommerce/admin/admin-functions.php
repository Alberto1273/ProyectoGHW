<?php

// Add  text to WordPress dashboard
function ags_diviecommerce_footer_inside_dashboard() {
	echo sprintf( esc_html__( 'Thank you for using %sDivi Ecommerce Child Theme from WP Zone%s ', 'divi_ecommerce' ), '<a href="http://wpzone.co/" target="_blank">', '</a>' );
}

add_filter( 'admin_footer_text', 'ags_diviecommerce_footer_inside_dashboard' );

// Admin welcome panel
function ags_diviecommerce_welcome_panel() {
	$user_id = get_current_user_id();
	if ( 1 != get_user_meta( $user_id, 'ags_welcome_panel', true ) ) {
		update_user_meta( $user_id, 'ags_welcome_panel', 1 );
	}
}

add_action( 'load-index.php', 'ags_diviecommerce_welcome_panel' );

/*
 * Enqueue admin stylesheet
 */

function ags_diviecommerce_load_wp_admin_style_theme() {
	wp_enqueue_style( 'theme_wp_admin_css', get_stylesheet_directory_uri() . '/admin/css/admin.css', '', AGS_THEME_VERSION, '' );
	wp_enqueue_style( 'ags-divi-ecommerce-addons-admin', get_stylesheet_directory_uri() . '/admin/addons/css/admin.css', '', AGS_THEME_VERSION, '' );
}

add_action( 'admin_enqueue_scripts', 'ags_diviecommerce_load_wp_admin_style_theme' );

/*
*  Admin Page, Demo Data Importer, Required Plugins
*/

function et_add_diviecommerce_menu() {
	add_menu_page(
		esc_html__( 'Divi Ecommerce', 'divi_ecommerce' ),
		esc_html__( 'Divi Ecommerce', 'divi_ecommerce' ),
		'switch_themes',
		'AGS_child_theme',
		'ags_diviecommerce_index'
	);
	add_submenu_page(
		'diviecommerce-options',
		esc_html__( 'Theme Options', 'divi_ecommerce' ),
		esc_html__( 'Theme Options', 'divi_ecommerce' ),
		'manage_options',
		'AGS_child_theme',
		'ags_diviecommerce_index'
	);
}

add_action( 'admin_menu', 'et_add_diviecommerce_menu' );


function ags_diviecommerce_index() {
	
	global $AGS_THEME_updater;
	if ( ! $AGS_THEME_updater->has_license_key() ) {
		$AGS_THEME_updater->activate_page();

		return;
	}
	
	?>
    <div id="ags-settings-container">
		<?php settings_errors(); ?>
        <div id="ags-settings">

            <div id="ags-settings-header">
                <div class="ags-settings-logo">
                    <h1><?php esc_html_e( 'Divi Ecommerce Child Theme', 'divi_ecommerce' ) ?> </h1>
                </div>
                <div id="ags-settings-header-links">
                    <a id="ags-settings-header-link-support" href="https://wpzone.co/docs/"
                       target="_blank"><?php esc_html_e( 'Support', 'divi_ecommerce' ) ?></a>
                </div>
            </div>
            <ul id="ags-settings-tabs">
                <li class="ags-settings-active"><a href="#demo-content"><?php esc_html_e( 'Demo Content', 'divi_ecommerce' ) ?></a></li>
                <li><a href="#addons"><?php esc_html_e( 'Addons', 'divi_ecommerce' ) ?></a></li>
                
                <li><a href="#license"><?php esc_html_e( 'License', 'divi_ecommerce' ) ?></a></li>
                
            </ul>
            <div id="ags-settings-tabs-content">
                <div id="ags-settings-demo-content" class="ags-settings-active">
                    <div class="ags-settings-box">
                        <p>
							<?php
							$demo_url = 'https://diviecommerce.aspengrovestudio.com/';
							$anchor   = esc_html__( 'This Demo', 'divi_ecommerce' );
							$link     = sprintf( '<a href="%s" target="_blank" class="ags-import-demo-button button-primary">%s</a>', $demo_url, $anchor );
							echo et_core_intentionally_unescaped( sprintf( esc_html__( 'Use  our built-in demo content tool. This will install the content and the design structure as shown in %1$s', 'divi_ecommerce' ), $link ), 'html' );
							?>
                        </p>
                        <h3><?php esc_html_e( 'The items that will be imported are:', 'divi_ecommerce' ) ?></h3>
                        <ol>
                            <li><?php esc_html_e( 'Demo text content', 'divi_ecommerce' ) ?></li>
                            <li><?php esc_html_e( 'Placeholder media files', 'divi_ecommerce' ) ?></li>
                            <li><?php esc_html_e( 'Navigation Menu ', 'divi_ecommerce' ) ?></li>
                            <li><?php esc_html_e( 'Demo posts, pages and products ', 'divi_ecommerce' ) ?></li>
                            <li><?php esc_html_e( 'Site widgets (if applicable)', 'divi_ecommerce' ) ?></li>
                        </ol>

                        <h3><?php esc_html_e( 'Please note: ', 'divi_ecommerce' ) ?></h3>
                        <ol>
                            <li><?php esc_html_e( 'No WordPress settings will be imported.', 'divi_ecommerce' ) ?></li>
                            <li><?php esc_html_e( 'No existing posts, pages, products, images, categories or any data will be modified or deleted.', 'divi_ecommerce' ) ?>  </li>
                            <li><?php esc_html_e( 'The importer will install only placeholder images showing their usage dimension. You can refer to our demo site and replace the placeholder with your own images.', 'divi_ecommerce' ) ?></li>
                        </ol>

						<?php
						// Check if WP Layouts plugin is active
						// returns true if active
						$wpl_status = in_array( 'wp-layouts/ags-layouts.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );

						if ( ! $wpl_status ) {
							echo '<div class="ags-settings-notice"> <p>';
							// Translators: %s - links tag
							printf( esc_html__( 'To import demo data, install and activate the latest version of the %sWP Layouts%s plugin', 'divi_ecommerce' ),
							        '<a href="themes.php?page=tgmpa-install-plugins&plugin_status=activate">',
							        '</a>'
							);
							echo '</p></div>';
						}
						?>

                        <button class="button-primary ags-import-demo-button" onclick="location.href='admin.php?page=ags-layouts-demo-import'" type="button" <?php echo $wpl_status ? '' : 'disabled' ?>><?php esc_html_e( 'Import Demo Data', 'divi_ecommerce' ) ?></button>
                    </div>
                </div>

                <!-- ADDONS -->
                <div id="ags-settings-addons">
					<?php
					define( 'AGS_THEME_ADDONS_URL', 'https://wpzone.co/wp-content/uploads/product-addons/divi-ecommerce.json' );
					require_once( dirname( __FILE__ ) . '/addons/addons.php' );
					AGS_Theme_Addons::outputList();
					?>
                </div>
                
                <!-- LICENSE TAB -->
                <div id="ags-settings-license">
                    <div class="ags-settings-box">
                        <form method="post" action="options.php" id="AGS_THEME_license_form">
							<?php $AGS_THEME_updater->license_key_box(); ?>
                        </form>
                    </div>
                </div>
                
            </div> <!-- close ags-settings-tabs-content -->
            <script>
                var ags_tabs_navigate = function () {
                    jQuery('#ags-settings-tabs-content > div, #ags-settings-tabs > li').removeClass('ags-settings-active');
                    jQuery('#ags-settings-' + location.hash.substr(1)).addClass('ags-settings-active');
                    jQuery('#ags-settings-tabs > li:has(a[href="' + location.hash + '"])').addClass('ags-settings-active');
                };
                if (location.hash) {
                    ags_tabs_navigate();
                }
                jQuery(window).on('hashchange', ags_tabs_navigate);
            </script>
        </div> <!-- close ags-settings -->
    </div> <!-- close ags-settings-container -->
	<?php
}

function ags_diviecommerce_options() {
	register_setting( 'ags_diviecommerce_front_page_option', 'ags_diviecommerce_front_page_option' );
	add_settings_section( 'ags_diviecommerce_front_page', esc_html__( 'Import Demo Data', 'divi_ecommerce' ), '', 'ags_diviecommerce_front_page_option' );
}

add_action( 'admin_init', 'ags_diviecommerce_options' );

/*
 * Include AGS Theme Updates
 */
function AGS_THEME_updater() {
	
	include( dirname( __FILE__ ) . '/updater/theme-updater.php' );
	global $AGS_THEME_updater;
	if ( $AGS_THEME_updater->has_license_key() ) {
		
		@include( dirname( __FILE__ ) . '/aspen-plugin-installer/class-tgm-plugin-activation.php' );
		
	}
	
}

add_action( 'after_setup_theme', 'AGS_THEME_updater' );

/*
 * Demo importer
 */

add_filter( 'ags_layouts_theme_demo_data', function () {
	
	global $AGS_THEME_updater;
	if ( ! $AGS_THEME_updater->has_license_key() ) {
		return;
	}

	
	return array(
		'layouts'    =>
			array(
				10379 =>
					array(
						'name' => 'Divi Ecommerce',
						'key'  => 'luWoqsEjFK77ZZ3miOMcjN8WKrfO2et3qfo84J55cC7HSNogvI',
					),
			),
		'editor'     => 'SiteImporter',
		'wplVersion' => '0.6.8',
	);
} );


// List of required plugins
function ags_diviecommerce_require_plugins() {
	
	global $AGS_THEME_updater;
	if ( ! $AGS_THEME_updater->has_license_key() ) {
		return;
	}
	

	$plugins = array(
		array(
			'name'               => 'WooCommerce',
			'slug'               => 'woocommerce',
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => 'WooCommerce Shipping & Tax',
			'slug'               => 'woocommerce-services',
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => 'Smash Balloon Social Photo Feed',
			'slug'               => 'instagram-feed',
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => 'WP-PageNavi',
			'slug'               => 'wp-pagenavi',
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => 'WP Layouts',
			'slug'               => 'wp-layouts',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => 'Shortcodes for Divi',
			'slug'               => 'shortcodes-for-divi',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false
		)
	);
	tgmpa( $plugins );
}

add_action( 'tgmpa_register', 'ags_diviecommerce_require_plugins' );