<?php
/*
* Contains code copied from and/or based on Divi, Woocommerce and WooCommerce Product Archive Customiser
* See the license.txt file in the root directory for more information and licenses
*
*/

/**
 * AGS_THEME_WC class
 */
if (!class_exists('AGS_THEME_WC')) {

    /**
     * The Product Archive Customiser class
     */
    class AGS_THEME_WC {

        /**
         * The version number.
         *
         * @var     string
         * @access  public
         */
        public $version;

        /**
         * The constructor!
         */
        public function __construct() {
            $this->version = '1.2.0'; // Child Theme  Version

            add_action('init', array($this, 'divi_ecommerce_wc_setup'));
            add_action('wp_loaded', array($this, 'divi_ecommerce_wc_fire_customisations'));
            add_filter('body_class', array($this, 'divi_ecommerce_wc_fire_customisation_styles'));
            add_action('wp_head', array($this, 'divi_ecommerce_wc_columns'));
            add_action('customize_controls_enqueue_scripts', array($this, 'divi_ecommerce_wc_customize_preview_css'));
            add_action('wp_enqueue_scripts', array($this, 'divi_ecommerce_ags_custom_styles'));

            //remove filters from Divi and Divi Ecommerce Child Theme
            remove_filter('loop_shop_columns', 'et_modify_shop_page_columns_num', 20);
        }

        /**
         * Product Archive Customiser setup
         *
         * @return void
         */
        public function divi_ecommerce_wc_setup() {
            add_action('customize_register', array($this, 'divi_ecommerce_wc_customize_register'));
        }

        /**
         * Add settings to the Customizer
         *
         * @param array $wp_customize the Customiser settings object.
         * @return void
         */
        public function divi_ecommerce_wc_customize_register($wp_customize) {
            $wp_customize->add_section('divi_ecommerce_wc', array(
                'title'    => __('Divi Ecommerce Product Archives', 'divi_ecommerce'),
                'priority' => 1,
            ));


            /**
             * Display - custom shop icon
             */
            $wp_customize->add_setting('divi_ecommerce_wc_buy_icon', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => array($this, 'divi_ecommerce_wc_sanitize_checkbox'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'divi_ecommerce_wc_buy_icon', array(
                'label'       => __('Display shop icon', 'divi_ecommerce'),
                'section'     => 'divi_ecommerce_wc',
                'settings'    => 'divi_ecommerce_wc_buy_icon',
                'type'        => 'checkbox',
                'description' => __('Display default buy now button instead of icon.', 'divi_ecommerce'),
            )));

            /**
             * Display - product sale flashes
             */
            $wp_customize->add_setting('divi_ecommerce_wc_sale_flash', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => array($this, 'divi_ecommerce_wc_sanitize_checkbox'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'divi_ecommerce_wc_sale_flash', array(
                'label'       => __('Display sale flashes', 'divi_ecommerce'),
                'section'     => 'divi_ecommerce_wc',
                'settings'    => 'divi_ecommerce_wc_sale_flash',
                'type'        => 'checkbox',
                'description' => __('Show or hide sale badge on the product image.', 'divi_ecommerce'),
            )));

            /**
             * Display - product overlay
             */
            $wp_customize->add_setting('divi_ecommerce_wc_product_overlay', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => array($this, 'divi_ecommerce_wc_sanitize_checkbox'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'divi_ecommerce_wc_product_overlay', array(
                'label'       => __('Display custom product overlay', 'divi_ecommerce'),
                'section'     => 'divi_ecommerce_wc',
                'settings'    => 'divi_ecommerce_wc_product_overlay',
                'type'        => 'checkbox',
                'description' => __('Enables a product overlay with the custom text. The product overlay is displayed on the shop page, archive product pages and product category pages upon hovering the product image.', 'divi_ecommerce'),
            )));

            /**
             * Display - product overlay text
             */
            $wp_customize->add_setting('divi_ecommerce_wc_product_overlay_text', array(
                'default'           => 'SHOP NOW',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wp_filter_nohtml_kses',
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'divi_ecommerce_wc_product_overlay_text', array(
                'label'           => __('Product overlay text', 'divi_ecommerce'),
                'section'         => 'divi_ecommerce_wc',
                'settings'        => 'divi_ecommerce_wc_product_overlay_text',
                'type'            => 'text ',
                'active_callback' => array($this, 'is_ags_product_overlay_enabled'),
                'description'     => __('Changes the text displayed on the product overlay. "Display custom product overlay" needs to be enabled in order this feature to work.', 'divi_ecommerce'),

            )));

            /**
             * Product Columns for Desktop
             */
            $wp_customize->add_setting('divi_ecommerce_wc_columns', array(
                'default'           => '3',
                'transport'         => 'refresh',
                'sanitize_callback' => array($this, 'divi_ecommerce_wc_sanitize_choices'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'divi_ecommerce_wc_columns', array(
                'label'       => __('Product columns for Desktop', 'divi_ecommerce'),
                'section'     => 'divi_ecommerce_wc',
                'settings'    => 'divi_ecommerce_wc_columns',
                'type'        => 'select',
                'choices'     => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6'
                ),
                'description' => __('Changes the number of products per row for desktop devices. **This setting does not work if page is built with the Divi Theme Builder**', 'divi_ecommerce'),
            )));

            /**
             * Product Columns for Tablet
             */
            $wp_customize->add_setting('divi_ecommerce_wc_columns_tablet', array(
                'default'           => '2',
                'transport'         => 'refresh',
                'sanitize_callback' => array($this, 'divi_ecommerce_wc_sanitize_choices'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'divi_ecommerce_wc_columns_tablet', array(
                'label'       => __('Product columns for Tablet', 'divi_ecommerce'),
                'section'     => 'divi_ecommerce_wc',
                'settings'    => 'divi_ecommerce_wc_columns_tablet',
                'type'        => 'select',
                'choices'     => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                ),
                'description' => __('Changes the number of products per row for tablet devices. **This setting does not work if page is built with the Divi Theme Builder**', 'divi_ecommerce'),
            )));

            /**
             * Product Columns for Mobile
             */
            $wp_customize->add_setting('divi_ecommerce_wc_columns_mobile', array(
                'default'           => '1',
                'transport'         => 'refresh',
                'sanitize_callback' => array($this, 'divi_ecommerce_wc_sanitize_choices'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'divi_ecommerce_wc_columns_mobile', array(
                'label'       => __('Product columns for Mobile', 'divi_ecommerce'),
                'section'     => 'divi_ecommerce_wc',
                'settings'    => 'divi_ecommerce_wc_columns_mobile',
                'type'        => 'select',
                'choices'     => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3'
                ),
                'description' => __('Changes the number of products per row for mobile devices. **This setting does not work if page is built with the Divi Theme Builder**', 'divi_ecommerce'),
            )));
        }

        /**
         * Checkbox sanitization callback.
         *
         * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
         * as a boolean value, either TRUE or FALSE.
         *
         * @param bool $checked Whether the checkbox is checked.
         * @return bool Whether the checkbox is checked.
         */
        public function divi_ecommerce_wc_sanitize_checkbox($checked) {
            return ((isset($checked) && true == $checked) ? true : false);
        }

        /**
         * Sanitizes choices (selects / radios)
         * Checks that the input matches one of the available choices
         *
         * @param array $input the available choices.
         * @param array $setting the setting object.
         */
        public function divi_ecommerce_wc_sanitize_choices($input, $setting) {
            // Ensure input is a slug.
            $input = sanitize_key($input);

            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control($setting->id)->choices;

            // If the input is a valid key, return it; otherwise, return the default.
            return (array_key_exists($input, $choices) ? $input : $setting->default);
        }

        /**
         * New overlay callback
         *
         * @param array $control the Customizer controls.
         * @return bool
         */
        public function is_ags_product_overlay_enabled($control) {
            return $control->manager->get_setting('divi_ecommerce_wc_product_overlay')->value() === true ? true : false;
        }

        /**
         * Action our customisations
         *
         * @return void
         */
        function divi_ecommerce_wc_fire_customisations() {

            // Sale flash.
            if (get_theme_mod('divi_ecommerce_wc_sale_flash', false) === false) {
                remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
            }
        }

        /**
         * Some plugins or themes may have already customized the hooks
         * We'll add body classes to the page and hide elements with CSS as a fall back
         *
         * @return $body_classes
         * @since 1.0.4
         * @see https://github.com/jameskoster/woocommerce-product-archive-customiser/issues/22
         */
        function divi_ecommerce_wc_fire_customisation_styles($body_classes) {

            $divi_ecommerce_wc_body_classes = array();

            // Sale flash.
            if (get_theme_mod('divi_ecommerce_wc_sale_flash', false) === false) {
                $divi_ecommerce_wc_body_classes[] = 'wc-ags-hide-sale-flash';
            }

            // Add the body classes to the body
            return array_merge($body_classes, $divi_ecommerce_wc_body_classes);
        }

        /**
         * Set the product columns
         *
         * @return void
         */
        function divi_ecommerce_wc_columns() {
            // Product columns.
            if (is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag()) {
                add_filter('body_class', array($this, 'divi_ecommerce_ags_columns'));
                add_filter('loop_shop_columns', array($this, 'divi_ecommerce_ags_products_row'));
            }
        }

        /**
         * Product columns class
         *
         * @param array $classes current body classes.
         * @return array          new body classes
         */
        function divi_ecommerce_ags_columns($classes) {
            $columns = get_theme_mod('divi_ecommerce_wc_columns', 4);
            $columns_tablet = get_theme_mod('divi_ecommerce_wc_columns_tablet', 3);
            $columns_mobile = get_theme_mod('divi_ecommerce_wc_columns_mobile', 2);
            $classes[] = 'product-columns-' . $columns . ' product-columns-tablet-' . $columns_tablet . ' product-columns-mobile-' . $columns_mobile;
            return $classes;
        }

        /**
         * Return the desired products per row
         *
         * @return int product columns
         */
        function divi_ecommerce_ags_products_row() {
            $columns = get_theme_mod('divi_ecommerce_wc_columns', 4);

            return $columns;
        }

        /**
         * Styling fixes for settings in the theme customizer
         *
         */
        public function divi_ecommerce_wc_customize_preview_css() {
            wp_enqueue_style('wc-ags-customizer-controls-styles', get_stylesheet_directory_uri() . '/admin/css/theme-customizer.css');
        }

        /* "Shop now" woo product hover effect */
        public function divi_ecommerce_ags_custom_styles() {
            wp_enqueue_style('woocommerce-style', get_stylesheet_directory_uri() . '/css/woocommerce.css');
            $custom_css = '';
            if (get_theme_mod('divi_ecommerce_wc_product_overlay', true) === true) {
                $text = get_theme_mod('divi_ecommerce_wc_product_overlay_text', 'Shop Now');
                $custom_css = ".et_shop_image .et_overlay:before {
                        position: absolute;
                        top: 55%;
                        left: 50%;
                        margin: -16px 0 0 -16px;
                        content: \"\\e050\";
                        -webkit-transition: all .4s;
                        -moz-transition: all .4s;
                        transition: all .4s;
                    }

                    .et_shop_image:hover .et_overlay {
                        z-index: 3;
                        opacity: 1;
                    }

                    .et_shop_image .et_overlay {
                        display: block;
                        z-index: -1;
                        -webkit-box-sizing: border-box;
                        -moz-box-sizing: border-box;
                        box-sizing: border-box;
                        opacity: 0;
                        -webkit-transition: all .3s;
                        -moz-transition: all .3s;
                        transition: all .3s;
                        -webkit-transform: translate3d(0, 0, 0);
                        -webkit-backface-visibility: hidden;
                        -moz-backface-visibility: hidden;
                        backface-visibility: hidden;
                        pointer-events: none;
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        top: 0;
                        left: 0;
                    }

                    .et-db #et-boc .et_shop_image .et_overlay,
                    .et_shop_image .et_overlay {
                        background: transparent;
                        border: none;
                    }

                    .et-db #et-boc .et_shop_image .et_overlay:before,
                    .et_shop_image .et_overlay:before {
                        font-family: 'Poppins', Helvetica, Arial, Lucida, sans-serif !important;
                        text-transform: uppercase;
                        background: #fff;
                        padding: 10px 0;
                        color: #111 !important;
                        border-radius: 30px;
                        width: 120px;
                        display: block;
                        text-align: center;
                        margin: -20px 0 0 -60px !important;
                        top: 50% !important;
                        font-size: 14px;
                        font-weight: 600;
                        line-height: 1.3;
                        border: none !important;
                        -webkit-box-shadow: 0 0 30px 3px rgba(0, 0, 0, 0.15);
                        -moz-box-shadow: 0 0 30px 3px rgba(0, 0, 0, 0.15);
                        box-shadow: 0 0 30px 3px rgba(0, 0, 0, 0.15);                   
						transform: none;

                    }

                    .woocommerce.et-db #et-boc .et-l .et_shop_image .et_overlay:before,
                    .et-db #et-boc .et_shop_image .et_overlay:before,
                    .et_shop_image .et_overlay:before {
                        content: '$text'; !important;
                    }";
            }
            if (get_theme_mod('divi_ecommerce_wc_buy_icon', true) === true) {
                $custom_css = $custom_css . "
                .woocommerce ul.products li.product.instock .star-rating,
                .woocommerce ul.products li.product.instock .price,
                .woocommerce-page ul.products.instock li.product .price,
                .woocommerce ul.products li.product.instock .woocommerce-loop-category__title,
                .woocommerce ul.products li.product.instock .woocommerce-loop-product__title,
                .woocommerce ul.products li.product.instock h3 {
                    padding-right: 50px;
                }

                .woocommerce ul.products li.product .button.add_to_cart_button,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.added,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.loading,
                .woocommerce ul.products li.product .product_type_variable.button,
                .woocommerce ul.products li.product.outofstock .button {
                    width: 40px;
                    height: 40px;
                    line-height: 40px !important;
                    position: absolute;
                    right: 0;
                    bottom: 0;
                    font-size: 0 !important;
                    background: transparent !important;
                    border: 1px solid rgba(0, 0, 0, 0.1) !important;
                    text-align: center;
                    color: inherit !important;
                    z-index: 5;
                    -webkit-transition: all .2s;
                    -moz-transition: all .2s;
                    transition: all .2s;
                }
                
                .woocommerce-page ul.products li.product .button.add_to_cart_button:after,
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.added:after,
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.loading:after,
                .woocommerce ul.products li.product .button.add_to_cart_button:after,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.added:after,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.loading:after,
                .woocommerce ul.products li.product .product_type_variable.button:after,
                .woocommerce ul.products li.product.outofstock .button:after {
                    display: none !important;
                }
                
                .woocommerce-page ul.products li.product .button.add_to_cart_button:before,
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.added:before,
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.loading:before,
                .woocommerce ul.products li.product .button.add_to_cart_button:before,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.added:before,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.loading:before,
                .woocommerce ul.products li.product .product_type_variable.button:before,
                .woocommerce ul.products li.product.outofstock .button:before {
                    position: relative !important;
                    left: auto !important;
                    right: auto !important;
                    top: 0 !important;
                    text-align: center;
                    margin: 0 auto !important;
                    opacity: 1 !important;
                    font-size: 22px;
                    line-height: 38px;
                    font-weight: 300 !important;
                    font-family: \"ETmodules\" !important;
                    display: block;
                    -webkit-transition: all, 0.2s, ease-in;
                    -moz-transition: all, 0.2s, ease-in;
                    -o-transition: all, 0.2s, ease-in;
                    transition: all, 0.2s, ease-in;
                }
                
                .woocommerce-page ul.products li.product .button.add_to_cart_button:before,
                .woocommerce ul.products li.product .add_to_cart_button:before,
                .woocommerce ul.products li.product .product_type_variable.button:before,
                .woocommerce ul.products li.product.outofstock .button:before {
                    color: inherit;
                    content: \"\\e013\";
                }
                
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.loading:before,
                .woocommerce ul.products li.product .button.add_to_cart_button.loading:before {
                    color: inherit;
                    content: \"\\e02d\";
                }
                
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.added:before,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.added:before {
                    color: #26c15f !important;
                    content: \"\\4e\";
                }";
            }

            wp_add_inline_style('woocommerce-style', $custom_css);
        }
    }

    $AGS_THEME_wc = new AGS_THEME_WC();
}
