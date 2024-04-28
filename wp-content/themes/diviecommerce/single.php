<?php
/*
 * Contains code copied from and/or based on Divi
 * See the license.txt file in the root directory for more information and licenses
 */

get_header();
$show_default_title = get_post_meta(get_the_ID(), '_et_pb_show_title', true);
$is_page_builder_used = et_pb_is_pagebuilder_used(get_the_ID());
?>

    <div id="main-content">
        <?php
        if (et_builder_is_product_tour_enabled()):
            // load fullwidth page in Product Tour mode
            while (have_posts()): the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post'); ?>>
                    <div class="entry-content">
                        <?php
                        the_content();
                        ?>
                    </div> <!-- .entry-content -->
                </article> <!-- .et_pb_post -->

            <?php endwhile;
        else:
            ?>
            <div class="container">
                <div id="content-area" class="clearfix">
                    <div id="left-area" <?php if (!$is_page_builder_used) echo 'class="pb_disabled"'; ?>>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php
                            /**
                             * Fires before the title and post meta on single posts.
                             *
                             * @since 3.18.8
                             */
                            do_action('et_before_post');
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post'); ?>>
                                <?php if (('off' !== $show_default_title && $is_page_builder_used) || !$is_page_builder_used) { ?>

                                    <?php
                                    if (!post_password_required()) :
                                        $thumb = '';
                                        $width = (int)apply_filters('et_pb_index_blog_image_width', 1080);
                                        $height = (int)apply_filters('et_pb_index_blog_image_height', 675);
                                        $classtext = 'et_featured_image';
                                        $titletext = get_the_title();
                                        $alttext = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                                        $thumbnail = get_thumbnail($width, $height, $classtext, $alttext, $titletext, false, 'Blogimage');
                                        $thumb = $thumbnail["thumb"];
                                        $post_format = et_pb_post_format();

                                        if ('video' === $post_format && false !== ($first_video = et_get_first_video())) {
                                            printf(
                                                '<div class="et_main_video_container">
											%1$s
										</div>',
                                                et_core_esc_previously($first_video)
                                            );
                                        } else if (!in_array($post_format, array('gallery', 'link', 'quote')) && 'on' === et_get_option('divi_thumbnails', 'on') && '' !== $thumb) {
                                            echo '<div class="et_main_thumbnail_container">';
                                            print_thumbnail($thumb, $thumbnail["use_timthumb"], $alttext, $width, $height);
                                            echo '</div>';
                                        } else if ('gallery' === $post_format) {
                                            et_pb_gallery_images();
                                        }
                                        ?>

                                        <?php
                                        $text_color_class = et_divi_get_post_text_color();
                                        $inline_style = et_divi_get_post_bg_inline_style();

                                        switch ($post_format) {
                                            case 'audio' :
                                                $audio_player = et_pb_get_audio_player();

                                                if ($audio_player) {
                                                    printf(
                                                        '<div class="et_audio_content%1$s"%2$s>
													%3$s
												</div>',
                                                        esc_attr($text_color_class),
                                                        et_core_esc_previously($inline_style),
                                                        et_core_esc_previously($audio_player)
                                                    );
                                                }

                                                break;
                                            case 'quote' :
                                                printf(
                                                    '<div class="et_quote_content%2$s"%3$s>
												%1$s
											</div> <!-- .et_quote_content -->',
                                                    et_core_esc_previously(et_get_blockquote_in_content()),
                                                    esc_attr($text_color_class),
                                                    et_core_esc_previously($inline_style)
                                                );

                                                break;
                                            case 'link' :
                                                printf(
                                                    '<div class="et_link_content%3$s"%4$s>
												<a href="%1$s" class="et_link_main_url">%2$s</a>
											</div> <!-- .et_link_content -->',
                                                    esc_url(et_get_link_url()),
                                                    esc_html(et_get_link_url()),
                                                    esc_attr($text_color_class),
                                                    et_core_esc_previously($inline_style)
                                                );
                                                break;
                                        }
                                    endif;
                                    ?>

                                    <div class="post_title_wrapper">
                                        <h2 class="entry-title"><?php the_title(); ?></h2>
                                        <?php et_divi_post_meta(); ?>
                                    </div> <!-- .post_title_wrapper -->

                                <?php } ?>

                                <div class="entry-content">
                                    <?php
                                    do_action('et_before_content');
                                    the_content();
                                    wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'divi_ecommerce'), 'after' => '</div>'));
                                    ?>
                                </div> <!-- .entry-content -->

                                <!-- Show ads -->
                                <div class="et_post_meta_wrapper">
                                    <?php
                                    if (et_get_option('divi_468_enable') === 'on') {
                                        echo '<div class="et-single-post-ad">';
                                        if (et_get_option('divi_468_adsense') !== '') echo et_core_intentionally_unescaped(et_core_fix_unclosed_html_tags(et_get_option('divi_468_adsense')), 'html');
                                        else { ?>
                                            <a href="<?php echo esc_url(et_get_option('divi_468_url')); ?>"><img src="<?php echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight"/></a>
                                        <?php }
                                        echo '</div> <!-- .et-single-post-ad -->';
                                    }

                                    /**
                                     * Fires after the post content on single posts.
                                     *
                                     * @since 3.18.8
                                     */
                                    do_action('et_after_post');
                                    ?>
                                </div> <!-- .et_post_meta_wrapper -->
                            </article> <!-- .et_pb_post -->

                            <!-- POST NAVIGATION -->
                            <div class="post-navigation">
                                <div class="navi-content">
                                    <?php previous_post_link('<div class="post-navigation-previous">%link', '%title</div>'); ?>
                                    <?php next_post_link('<div class="post-navigation-next">%link', '%title</div>'); ?>
                                </div>
                            </div>

                            <!-- COMMENT AREA -->
                            <?php
                            if ((comments_open() || get_comments_number()) && 'on' === et_get_option('divi_show_postcomments', 'on')) {
                                comments_template('', true);
                            }
                            ?>

                        <?php endwhile; ?>
                    </div> <!-- #left-area -->

                    <?php get_sidebar(); ?>
                </div> <!-- #content-area -->
            </div> <!-- .container -->

            <!-- RELATED POSTS BY CATEGORY -->
            <?php
            global $post;
            $categories = get_the_category($post->ID);
            if ($categories) {
                $category_ids = array();
                foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                $args = array(
                    'category__in'        => $category_ids,
                    'post__not_in'        => array($post->ID),
                    'posts_per_page'      => 3, // Number of related posts that will be shown.
                    'ignore_sticky_posts' => true
                );
                $my_query = new wp_query($args);
                if ($my_query->have_posts()) {
                    echo '<div class="related-posts et_pb_section"><div class="et_pb_row"><h1>' . esc_html__('Related Posts', 'divi_ecommerce') . '</h1>';
                    while ($my_query->have_posts()) {
                        $my_query->the_post(); ?>
                        <div class="related-thumb">
                            <div class="related-thumb-wrapper">
                                <div class="thumb-container" style="background-image: url(<?php echo esc_url(the_post_thumbnail_url()); ?>)">
                                    <a rel="external" href="<?php the_permalink(); ?>"></a>
                                </div>
                                <div class="related-post-content">
                                    <a rel="external" href="<?php the_permalink(); ?>">
                                        <h3 class="post-title">
                                            <?php
                                            $thetitle = $post->post_title;
                                            $getlength = strlen($thetitle);
                                            $thelength = 45;
                                            echo esc_html(substr($thetitle, 0, $thelength));
                                            if ($getlength > $thelength) echo "...";
                                            ?>
                                        </h3>
                                    </a>
                                    <a rel="external" href="<?php the_permalink(); ?>" class="more-link"><?php echo esc_html__('read more', 'divi_ecommerce'); ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    echo '</div></div>';
                }
            }
            wp_reset_query(); ?>

        <?php endif; ?>
    </div> <!-- #main-content -->

<?php get_footer(); ?>