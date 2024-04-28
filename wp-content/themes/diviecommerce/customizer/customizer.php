<?php
/*
* Contains code copied from and/or based on Divi
* See the license.txt file in the root directory for more information and licenses
*
*/

/*
* Add new section to customizer
*/

function ags_diviecommerce_customize_register($wp_customize) {

    // Create panel
    $wp_customize->add_panel('ds_child_theme_customizer', array(
        'title'    => esc_html__('Divi Ecommerce Child Theme Settings', 'divi_ecommerce'),
        'priority' => 2,
    ));

    // Create sections
    $wp_customize->add_section('divi_child_theme_colors', array(
        'title'       => esc_html__('Color Scheme', 'divi_ecommerce'),
        'panel'       => 'ds_child_theme_customizer',
        'priority'    => 1,
        'description' => esc_html__('Color settings will be applied to your Divi Child Theme color scheme.', 'divi_ecommerce'),
    ));

    $wp_customize->add_section('divi_child_theme_primary_button', array(
        'title'       => esc_html__('Primary Button Color Scheme', 'divi_ecommerce'),
        'panel'       => 'ds_child_theme_customizer',
        'priority'    => 2,
        'description' => esc_html__('Color settings below will be applied to primary buttons.', 'divi_ecommerce'),
    ));

    $wp_customize->add_section('divi_child_theme_secondary_button', array(
        'title'       => esc_html__('Secondary Button Color Scheme', 'divi_ecommerce'),
        'panel'       => 'ds_child_theme_customizer',
        'priority'    => 3,
        'description' => esc_html__('Color settings below will be applied to secondary buttons.', 'divi_ecommerce'),
    ));

    $wp_customize->add_section('divi_child_theme_outline_button', array(
        'title'       => esc_html__('Outline Button Color Scheme', 'divi_ecommerce'),
        'panel'       => 'ds_child_theme_customizer',
        'priority'    => 4,
        'description' => esc_html__('Color settings below will be applied to outline buttons.', 'divi_ecommerce'),
    ));

	$wp_customize->add_section('divi_child_theme_form_fields', array(
		'title'       => esc_html__('Form Fields', 'divi_ecommerce'),
		'panel'       => 'ds_child_theme_customizer',
		'priority'    => 5,
		'description' => esc_html__('Settings below will be applied to form fields.', 'divi_ecommerce'),
	));

    // --------------------------------------------------------------------------------------- //
    //                                       Color Scheme
    // --------------------------------------------------------------------------------------- //

    // Primary Accent Color
    $wp_customize->add_setting('divi_child_main_accent_color', array(
        'default'           => '#EF3F49',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_main_accent_color', //give it an ID
        array(
            'label'    => esc_html__('Main Accent Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_colors', //select the section for it to appear under
            'settings' => 'divi_child_main_accent_color' //pick the setting it applies to
        )
    ));

    // --------------------------------------------------------------------------------------- //
    //                                      Buttons
    // --------------------------------------------------------------------------------------- //

    // Primary Button Color Scheme
    $wp_customize->add_setting('divi_child_theme_primary_button_text_color', array(
        'default'           => '#ef3f49',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_primary_button_text_color', //give it an ID
        array(
            'label'    => esc_html__('Text Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_primary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_primary_button_text_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_primary_button_border_color', array(
        'default'           => '#ef3f49',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_primary_button_border_color', //give it an ID
        array(
            'label'    => esc_html__('Border Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_primary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_primary_button_border_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_primary_button_background_color', array(
        'default'           => 'rgba(255,255,255,0)',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_primary_button_background_color', //give it an ID
        array(
            'label'    => esc_html__('Background Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_primary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_primary_button_background_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_primary_button_hover_text_color', array(
        'default'           => '#ffffff',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_primary_button_hover_text_color', //give it an ID
        array(
            'label'    => esc_html__('Hover Text Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_primary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_primary_button_hover_text_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_primary_button_hover_border_color', array(
        'default'           => '#ef3f49',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_primary_button_hover_border_color', //give it an ID
        array(
            'label'    => esc_html__('Hover Border Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_primary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_primary_button_hover_border_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_primary_button_hover_background_color', array(
        'default'           => '#ef3f49',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_primary_button_hover_background_color', //give it an ID
        array(
            'label'    => esc_html__('Hover Background Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_primary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_primary_button_hover_background_color' //pick the setting it applies to
        )
    ));

    // Secondary Button Color Scheme
    $wp_customize->add_setting('divi_child_theme_secondary_button_text_color', array(
        'default'           => '#ffffff',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_secondary_button_text_color', //give it an ID
        array(
            'label'    => esc_html__('Text Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_secondary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_secondary_button_text_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_secondary_button_border_color', array(
        'default'           => '#000',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_secondary_button_border_color', //give it an ID
        array(
            'label'    => esc_html__('Border Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_secondary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_secondary_button_border_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_secondary_button_background_color', array(
        'default'           => '#000',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_secondary_button_background_color', //give it an ID
        array(
            'label'    => esc_html__('Background Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_secondary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_secondary_button_background_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_secondary_button_hover_text_color', array(
        'default'           => '#ffffff',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_secondary_button_hover_text_color', //give it an ID
        array(
            'label'    => esc_html__('Hover Text Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_secondary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_secondary_button_hover_text_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_secondary_button_hover_border_color', array(
        'default'           => '#ef3f49',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_secondary_button_hover_border_color', //give it an ID
        array(
            'label'    => esc_html__('Hover Border Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_secondary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_secondary_button_hover_border_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_secondary_button_hover_background_color', array(
        'default'           => '#ef3f49',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_secondary_button_hover_background_color', //give it an ID
        array(
            'label'    => esc_html__('Hover Background Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_secondary_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_secondary_button_hover_background_color' //pick the setting it applies to
        )
    ));

    // Outline Button Color Scheme
    $wp_customize->add_setting('divi_child_theme_outline_button_text_color', array(
        'default'           => '#111111',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_outline_button_text_color', //give it an ID
        array(
            'label'    => esc_html__('Text Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_outline_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_outline_button_text_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_outline_button_border_color', array(
        'default'           => '#111111',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_outline_button_border_color', //give it an ID
        array(
            'label'    => esc_html__('Border Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_outline_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_outline_button_border_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_outline_button_background_color', array(
        'default'           => 'rgba(255,255,255,0)',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_outline_button_background_color', //give it an ID
        array(
            'label'    => esc_html__('Background Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_outline_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_outline_button_background_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_outline_button_hover_text_color', array(
        'default'           => '#ffffff',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_outline_button_hover_text_color', //give it an ID
        array(
            'label'    => esc_html__('Hover Text Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_outline_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_outline_button_hover_text_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_outline_button_hover_border_color', array(
        'default'           => '#111111',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_outline_button_hover_border_color', //give it an ID
        array(
            'label'    => esc_html__('Hover Border Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_outline_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_outline_button_hover_border_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_setting('divi_child_theme_outline_button_hover_background_color', array(
        'default'           => '#111111',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'divi_child_theme_outline_button_hover_background_color', //give it an ID
        array(
            'label'    => esc_html__('Hover Background Color', 'divi_ecommerce'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_outline_button', //select the section for it to appear under
            'settings' => 'divi_child_theme_outline_button_hover_background_color' //pick the setting it applies to
        )
    ));

	// --------------------------------------------------------------------------------------- //
	//                                 Form Fields
	// --------------------------------------------------------------------------------------- //

	$wp_customize->add_setting('divi_child_theme_fields_background_color', array(
		'default'           => '#fff',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	));
	$wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
       $wp_customize,
       'divi_child_theme_fields_background_color',
       array(
           'label'    => esc_html__('Fields Background Color', 'divi_ecommerce'),
           'section'  => 'divi_child_theme_form_fields',
           'settings' => 'divi_child_theme_fields_background_color'
       )
   ));

	$wp_customize->add_setting('divi_child_theme_fields_text_color', array(
		'default'           => et_get_option('font_color', '#888'),
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
       $wp_customize,
       'divi_child_theme_fields_text_color',
       array(
           'label'    => esc_html__('Fields Text Color', 'divi_ecommerce'),
           'section'  => 'divi_child_theme_form_fields',
           'settings' => 'divi_child_theme_fields_text_color'
       )
   ));
    
	$wp_customize->add_setting('divi_child_theme_fields_border_color', array(
		'default'           => 'rgba(0,0,0,0.1)',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	));
	$wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
       $wp_customize,
       'divi_child_theme_fields_border_color',
       array(
           'label'    => esc_html__('Fields Border Color', 'divi_ecommerce'),
           'section'  => 'divi_child_theme_form_fields',
           'settings' => 'divi_child_theme_fields_border_color'
       )
   ));
}

add_action('customize_register', 'ags_diviecommerce_customize_register');

/*
 * Output  custom settings CSS Style
 */

function ags_diviecommerce_customize_css() {

    /* ============================= */

    $main_accent = get_theme_mod('divi_child_main_accent_color', '#EF3F49');

    $primary_button_text_color = get_theme_mod('divi_child_theme_primary_button_text_color', '#ef3f49');
    $primary_button_bg_color = get_theme_mod('divi_child_theme_primary_button_background_color', 'rgba(255,255,255,0)');
    $primary_button_border_color = get_theme_mod('divi_child_theme_primary_button_border_color', '#EF3F49');
    $primary_button_hover_text_color = get_theme_mod('divi_child_theme_primary_button_hover_text_color', '#ffffff');
    $primary_button_hover_bg_color = get_theme_mod('divi_child_theme_primary_button_hover_background_color', '#ef3f49');
    $primary_button_hover_border_color = get_theme_mod('divi_child_theme_primary_button_hover_border_color', '#ef3f49');

    $secondary_button_text_color = get_theme_mod('divi_child_theme_secondary_button_text_color', '#ffffff');
    $secondary_button_bg_color = get_theme_mod('divi_child_theme_secondary_button_background_color', '#000000');
    $secondary_button_border_color = get_theme_mod('divi_child_theme_secondary_button_border_color', '#000000');
    $secondary_button_hover_text_color = get_theme_mod('divi_child_theme_secondary_button_hover_text_color', '#ffffff');
    $secondary_button_hover_bg_color = get_theme_mod('divi_child_theme_secondary_button_hover_background_color', '#ef3f49');
    $secondary_button_hover_border_color = get_theme_mod('divi_child_theme_secondary_button_hover_border_color', '#ef3f49');

    $outline_button_text_color = get_theme_mod('divi_child_theme_outline_button_text_color', '#111111');
    $outline_button_bg_color = get_theme_mod('divi_child_theme_outline_button_background_color', 'rgba(255,255,255,0)');
    $outline_button_border_color = get_theme_mod('divi_child_theme_outline_button_border_color', '#111111');
    $outline_button_hover_text_color = get_theme_mod('divi_child_theme_outline_button_hover_text_color', '#ffffff');
    $outline_button_hover_bg_color = get_theme_mod('divi_child_theme_outline_button_hover_background_color', '#111111');
    $outline_button_hover_border_color = get_theme_mod('divi_child_theme_outline_button_hover_border_color', '#111111');

    /* ============================= */

    ?>
    <style type="text/css">

        /*
         * First Color Scheme
         */
        .primary-background, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .woocommerce-pagination ul.page-numbers a:hover, .woocommerce-page .woocommerce-pagination ul.page-numbers a:hover, .wp-pagenavi a:hover, .home-slider .et-pb-controllers a.et-pb-active-control, .home-slider .et-pb-arrow-next:hover, .home-slider .et-pb-arrow-prev:hover {
            background-color : <?php echo esc_html($main_accent);?> !important;
        }

        .primary-color, .divi-ecommerce-sidebar li.cat-item a:hover, .divi-ecommerce-sidebar li.cat-item.current-cat > a, .divi-ecommerce-woo-tabs ul.et_pb_tabs_controls li a:hover, .search-page-header h1 span, #top-header .et-social-icon a:hover, footer .et-social-icon a:hover, #footer-widgets .footer-widget .widget_nav_menu li a:hover, #footer-widgets .footer-widget .widget_nav_menu li a:focus, #footer-widgets .footer-widget .widget_nav_menu li.current-menu-item a, .woocommerce-info a.showlogin:hover, .woocommerce-info a.showcoupon:hover, .not-found-404 h2 span, .not-found-404 p.large-404, .woocommerce-MyAccount-navigation ul li a:hover, .post-navigation a:hover, .related-thumb h3.post-title:hover, .blog .et_pb_post h2.entry-title:hover, .search .et_pb_post h2.entry-title:hover, .archive .et_pb_post h2.entry-title:hover, .empty-cart h1 span, .woo-cart form.woocommerce-cart-form td.product-name a:hover, body.woocommerce #content-area div.product .woocommerce-tabs ul.tabs li a:hover, body.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce-breadcrumb a:hover, #sidebar li.cat-item.current-cat > a, .tagcloud a:hover, #sidebar .woocommerce ul.product_list_widget li span.product-title:hover, #sidebar .woocommerce ul.cart_list li span.product-title:hover, .woocommerce ul.cart_list li a:not(.remove):hover, .woocommerce ul.product_list_widget li a:not(.remove):hover, .woocommerce .woocommerce-pagination ul.page-numbers span.current, .woocommerce-page .woocommerce-pagination ul.page-numbers span.current, .wp-pagenavi span.current, .home-slider .et_pb_slide_title span, .bottom-blurbs .et_pb_column:hover .et-pb-icon, .woocommerce ul.products li.product .woocommerce-loop-category__title:hover, .woocommerce ul.products li.product .woocommerce-loop-product__title:hover, .woocommerce ul.products li.product h3:hover, .woocommerce.et-db #et-boc .et-l .woocommerce ul.products li.product .button.add_to_cart_button:hover, .et_pb_blog_grid .et_pb_post .entry-title:hover, .woocommerce.et-db #et-boc .et-l ul.products li.product .button.add_to_cart_button:hover, .woocommerce.et-db #et-boc .et-l ul.products li.product .product_type_variable.button:hover, .woocommerce.et-db #et-boc .et-l ul.products li.product.outofstock .button:hover, .woocommerce ul.products li.product .button.add_to_cart_button:hover, .woocommerce ul.products li.product .product_type_variable.button:hover, .woocommerce ul.products li.product.outofstock .button:hover {
            color : <?php echo esc_html($main_accent);?> !important;
        }

        .primary-border-color, #top-header .et-social-icon a:hover, footer .et-social-icon a:hover, .woocommerce div.product div.images .flex-control-thumbs li img.flex-active, .woocommerce div.product div.images .flex-control-thumbs li img:hover, .tagcloud a:hover, .woocommerce .woocommerce-pagination ul.page-numbers span.current, .woocommerce-page .woocommerce-pagination ul.page-numbers span.current, .wp-pagenavi span.current, .home-slider .et-pb-controllers a.et-pb-active-control:before, .bottom-blurbs .et_pb_column:hover, .woocommerce.et-db #et-boc .et-l ul.products li.product .button.add_to_cart_button:hover, .woocommerce.et-db #et-boc .et-l ul.products li.product .product_type_variable.button:hover, .woocommerce.et-db #et-boc .et-l ul.products li.product.outofstock .button:hover, .woocommerce ul.products li.product .button.add_to_cart_button:hover, .woocommerce ul.products li.product .product_type_variable.button:hover, .woocommerce ul.products li.product.outofstock .button:hover {
            border-color : <?php echo esc_html($main_accent);?> !important;
        }

        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle:after {
            border-color : <?php echo esc_html($main_accent);?> !important;
        }

        /*
         * Buttons
         */

        .divi-ecommerce-primary-button, .divi-ecommerce-module-primary-button .et_pb_button, .form-submit .et_pb_button, .de-contact-form .et_pb_button, .woocommerce #review_form #respond input#submit, .woocommerce-page #review_form #respond input#submit {
            border-color     : <?php echo esc_html($primary_button_border_color );?> !important;
            color            : <?php echo esc_html($primary_button_text_color );?> !important;
            background-color : <?php echo esc_html($primary_button_bg_color );?> !important;
        }

        .divi-ecommerce-primary-button:hover, .divi-ecommerce-module-primary-button .et_pb_button:hover, .form-submit .et_pb_button:hover, .de-contact-form .et_pb_button:hover, .woocommerce #review_form #respond input#submit:hover, .woocommerce-page #review_form #respond input#submit:hover {
            border-color     : <?php echo esc_html($primary_button_hover_border_color );?> !important;
            color            : <?php echo esc_html($primary_button_hover_text_color );?> !important;
            background-color : <?php echo esc_html($primary_button_hover_bg_color );?> !important;
        }

        .divi-ecommerce-secondary-button, .divi-ecommerce-module-secondary-button .et_pb_button, .woocommerce .widget_price_filter button.button, .woocommerce div.product form.cart .button, .widget_search input#searchsubmit, .newsletter-section .caldera-grid .btn-default {
            border-color     : <?php echo esc_html($secondary_button_border_color );?> !important;
            color            : <?php echo esc_html($secondary_button_text_color );?> !important;
            background-color : <?php echo esc_html($secondary_button_bg_color );?> !important;
        }

        .divi-ecommerce-secondary-button:hover, .divi-ecommerce-module-secondary-button .et_pb_button:hover, .woocommerce .widget_price_filter button.button:hover, .woocommerce div.product form.cart .button:hover, .widget_search input#searchsubmit:hover, .newsletter-section .caldera-grid .btn-default:hover {
            border-color     : <?php echo esc_html($secondary_button_hover_border_color );?> !important;
            color            : <?php echo esc_html($secondary_button_hover_text_color );?> !important;
            background-color : <?php echo esc_html($secondary_button_hover_bg_color );?> !important;
        }

        .divi-ecommerce-outline-button, .not-found-404 .buttons-container a.et_pb_button, .single .comment_area .comment-reply-link, .related-thumb a.more-link, .blog .et_pb_post a.more-link, .archive .et_pb_post a.more-link, .et_pb_blog_grid .et_pb_post a.more-link, .woocommerce-info a.button, .woocommerce-info a.button.woocommerce-Button, .woocommerce-message a.button, .woocommerce-message a.button.wc-forward, .woocommerce-MyAccount-orders .woocommerce-orders-table__cell-order-actions a.button, .woocommerce .woocommerce-table--order-downloads a.button, .woocommerce .woocommerce-table--order-downloads a.woocommerce-MyAccount-downloads-file {
            border-color     : <?php echo esc_html($outline_button_border_color );?> !important;
            color            : <?php echo esc_html($outline_button_text_color );?> !important;
            background-color : <?php echo esc_html($outline_button_bg_color );?> !important;
        }

        .divi-ecommerce-outline-button:hover, .not-found-404 .buttons-container a.et_pb_button:hover, .single .comment_area .comment-reply-link:hover, .related-thumb a.more-link:hover, .blog .et_pb_post a.more-link:hover, .archive .et_pb_post a.more-link:hover, .et_pb_blog_grid .et_pb_post a.more-link:hover, .woocommerce-info a.button:hover, .woocommerce-info a.button.woocommerce-Button:hover, .woocommerce-message a.button:hover, .woocommerce-message a.button.wc-forward:hover, .woocommerce-MyAccount-orders .woocommerce-orders-table__cell-order-actions a.button:hover, .woocommerce .woocommerce-table--order-downloads a.button:hover, .woocommerce .woocommerce-table--order-downloads a.woocommerce-MyAccount-downloads-file:hover {
            border-color     : <?php echo esc_html($outline_button_hover_border_color );?> !important;
            color            : <?php echo esc_html($outline_button_hover_text_color );?> !important;
            background-color : <?php echo esc_html($outline_button_hover_bg_color );?> !important;
        }

        /*
         * Form Fields
         */

        .woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea, .select2-container--default .select2-selection--single, .woo-cart .coupon input#coupon_code, .woocommerce form.checkout_coupon input#coupon_code, .orderby, .woocommerce div.product form.cart .variations td select, .divi-ecommerce-sidebar form.woocommerce-product-search, #sidebar .widget_product_search form.woocommerce-product-search, .woocommerce #content .quantity input.qty, .woocommerce .quantity input.qty, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-page #content .quantity input.qty, .woocommerce-page .quantity input.qty, .woo-cart form.woocommerce-cart-form td.product-quantity input, .shipping-calculator-form select, .de-contact-form p input, .de-contact-form p textarea, .divi-ecommerce-form input[type="text"], .divi-ecommerce-form input[type="email"], .divi-ecommerce-form select, .divi-ecommerce-form textarea, .divi-ecommerce-form p.et_pb_newsletter_field input[type="text"], .divi-ecommerce-form p.et_pb_newsletter_field input[type="email"], .divi-ecommerce-form p.et_pb_newsletter_field select, .divi-ecommerce-form p.et_pb_newsletter_field textarea, .newsletter-section .caldera-grid .form-control, #commentform input[type=email], #commentform input[type=text], #commentform input[type=url], #commentform textarea {
            border-color     : <?php echo esc_html(get_theme_mod('divi_child_theme_fields_border_color', 'rgba(0,0,0,0.1)') );?> !important;
            color            : <?php echo esc_html(get_theme_mod('divi_child_theme_fields_text_color', et_get_option('font_color', '#888')));?>;
            background-color : <?php echo esc_html(get_theme_mod('divi_child_theme_fields_background_color', '#fff') );?>;
        }

    </style>

    <?php
}

add_action('wp_head', 'ags_diviecommerce_customize_css');


// close php tag
?>