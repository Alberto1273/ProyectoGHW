<?php
/*
 * Contains code copied from and/or based on Divi
 * See the license.txt file in the root directory for more information and licenses
 *
/

/*
 * Template Name: 404 Page
 */
get_header(); ?>

    <div id="main-content" class="not-found-404">

        <div class="et_pb_section">
            <div class="et_pb_row clearfix et_pb_text_align_center et_pb_bg_layout_light">

                <p class="large-404"><?php echo esc_html__('404', 'divi_ecommerce'); ?></p>
                <h2><?php echo esc_html__('Oops! Page not found.', 'divi_ecommerce'); ?></h2>
                <p><?php echo esc_html__('Sorry, but the page you are looking for is not found. Please, make sure you have typed the current url.', 'divi_ecommerce'); ?></p>

                <div class="buttons-container">
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                       class="et_pb_button"><?php echo esc_html__('Back to homepage', 'divi_ecommerce'); ?></a>
                </div>

            </div> <!-- #content-area -->
        </div> <!-- .container -->
    </div> <!-- #main-content -->

<?php get_footer(); ?>