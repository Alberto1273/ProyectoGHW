<?php
/*
* Contains code copied from and/or based on Divi and WooCommerce
* See the license.txt file in the root directory for more information and licenses
*
*/

update_option ('agstheme_diviecommerce_license_key_status', 'valid');
update_option ('agstheme_diviecommerce_license_key', '*********');
update_option ('agstheme_diviecommerce_license_key_expiry', '2550450570');

define('AGS_THEME_DIRECTORY', dirname(__FILE__) . '/');
define('AGS_THEME_VERSION', wp_get_theme()->get('Version'));

/**
 * Load translations for Divi Ecommerce
 */

function ags_diviecommerce_child_setup() {
    $path = get_stylesheet_directory() . '/languages';
    load_child_theme_textdomain('divi_ecommerce', $path);
}

add_action('after_setup_theme', 'ags_diviecommerce_child_setup');

/* Include AGS admin functions */
include(AGS_THEME_DIRECTORY . '/admin/admin-functions.php');
include(AGS_THEME_DIRECTORY . '/admin/update-footer.php');

/*
 * Enqueue child theme stylesheets
 */

function ags_diviecommerce_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_deregister_style('divi-style');
    wp_enqueue_style('divi-style', get_stylesheet_uri(), array(), AGS_THEME_VERSION);

    wp_enqueue_style('footer-style', get_stylesheet_directory_uri() . '/css/footer.css', array(), AGS_THEME_VERSION);
    wp_enqueue_style('header-style', get_stylesheet_directory_uri() . '/css/header.css', array(), AGS_THEME_VERSION);
    wp_enqueue_style('blog-style', get_stylesheet_directory_uri() . '/css/blog.css', array(), AGS_THEME_VERSION);
    wp_enqueue_style('homepage-style', get_stylesheet_directory_uri() . '/css/home.css', array(), AGS_THEME_VERSION);
    wp_enqueue_style('woocommerce-style', get_stylesheet_directory_uri() . '/css/woocommerce.css', array(), AGS_THEME_VERSION);
}

add_action('wp_enqueue_scripts', 'ags_diviecommerce_enqueue_styles');

/*
 * Add child theme color scheme
 * Create new tab in wordpress customizer
 */

include(AGS_THEME_DIRECTORY . 'customizer/customizer.php');

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')), true)) {
    @include(AGS_THEME_DIRECTORY . '/customizer/divi-woocommerce-product-archive-customiser.php');
}


/*
 * Creating shortcodes
 */

function ags_diviecommerce_breadcrumbs_shortcode() {
    ob_start();
    if (function_exists('woocommerce_breadcrumb')) {
        woocommerce_breadcrumb();
    }
    return ob_get_clean();
}

add_shortcode('woo-breadcrumbs', 'ags_diviecommerce_breadcrumbs_shortcode');

/*
 * Register WooCommerce Sidebar
 */

function ags_diviecommerce_register_sidebars() {
    register_sidebar(
        array(
            'id'            => 'woocomerce-sidebar',
            'name'          => esc_html__('WooCommerce Sidebar', 'divi_ecommerce'),
            'description'   => esc_html__('This is the WooCommerce shop sidebar', 'divi_ecommerce'),
            'before_widget' => '<div id="%1$s" class="et_pb_widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>',
        )
    );
}

add_action('widgets_init', 'ags_diviecommerce_register_sidebars');

/*
 * Display custom sidebar on WooCommerce pages
 */

function ags_diviecommerce_output_content_wrapper_end() {
    echo '</div> <!-- #left-area -->';
    if (
        (is_product() && !in_array(get_post_meta(get_the_ID(), '_et_pb_page_layout', true), array('et_no_sidebar', 'et_full_width_page')))
        ||
        ((is_shop() || is_product_category() || is_product_tag()) && 'et_full_width_page' !== et_get_option('divi_shop_page_sidebar', 'et_right_sidebar'))
    ) {
        echo '<div id="sidebar">';
        dynamic_sidebar('woocomerce-sidebar');
        echo '</div>';
    }
    echo '
				</div> <!-- #content-area -->
			</div> <!-- .container -->
		</div> <!-- #main-content -->';
}

add_filter('ags_diviecommerce_output_content_wrapper_end', false);

function ags_diviecommerce_woocommerce_custom_sidebar() {
    remove_action('woocommerce_after_main_content', 'et_divi_output_content_wrapper_end', 10);
    add_action('woocommerce_after_main_content', 'ags_diviecommerce_output_content_wrapper_end', 10);
}

add_action('after_setup_theme', 'ags_diviecommerce_woocommerce_custom_sidebar', 50);

/*
 *  06 - Other WooCommerce functions
 */

/* Custom "Empty Cart" message */
function ags_diviecommerce_custom_wc_empty_cart_message() {
    $content = '<div class="empty-cart"><h1>';
    $content .= esc_html__('Your cart is empty :(', 'divi_ecommerce');
    $content .= '</h1><p>';
    $content .= esc_html__('Looks like you have not made your choice yet...', 'divi_ecommerce');
    $content .= '</p></div>';
    echo et_core_intentionally_unescaped($content, 'html');
}

add_filter('wc_empty_cart_message', 'ags_diviecommerce_custom_wc_empty_cart_message');

/* Display Add to cart button on archives */
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10);

/* Custom page header on Woo pages */
function ags_diviecommerce_page_title() {
    ?>
    <div class="et_pb_section" id="ecommerce-custom-header">
        <div class="et_pb_row">
            <div class="et_pb_column">
                <?php if (is_single()) { ?>
                    <h1 class="woocommerce-products-header__title page-title"><?php the_title(); ?></h1>
                    <?php ;
                } else { ?>
                    <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                    <?php ;
                }
                woocommerce_breadcrumb();
                ?>
            </div>
        </div>
    </div>
    <?php
}

add_action('woocommerce_before_main_content', 'ags_diviecommerce_page_title', 5);

/* Remove breadcrumbs from woo_before_main_content */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/* Remove duplicate page-title from WooCommerce archive pages */
function ags_diviecommerce_hide_page_titles() {
    if (is_shop()) return false;
}

add_filter('woocommerce_show_page_title', 'ags_diviecommerce_hide_page_titles');

/* Display category thumbnail on taxonomy archives */
function ags_diviecommerce_woo_category_image() {
    if (is_product_category()) {
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
        $image = wp_get_attachment_url($thumbnail_id);
        if ($image) {
            echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($cat->name) . '" class="term-img" />';
        }
    }
}

add_action('woocommerce_archive_description', 'ags_diviecommerce_woo_category_image', 2);


/**
 * Redirect to post if search results only returns one post
 */
function ags_diviecommerce_single_result() {
    if (is_search()) {
        global $wp_query;

        if ($wp_query->post_count == 1) {
            wp_redirect(get_permalink($wp_query->posts['0']->ID));
        }
    }
}

add_action('template_redirect', 'ags_diviecommerce_single_result');

/**
 * Modify Cross Sells
 */

// remove Cross Sells from .cart-collaterals
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

// Add Cross Sells after .cart-collaterals
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

// Display Cross Sells on 4 columns instead of default
function ags_diviecommerce_change_cross_sells_columns($columns) {
    return 4;
}

add_filter('woocommerce_cross_sells_columns', 'ags_diviecommerce_change_cross_sells_columns');
