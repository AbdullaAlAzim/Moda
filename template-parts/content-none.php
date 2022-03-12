<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

?>

<section class="moda-no-results not-found">
    <header class="section-title-2">
        <h2 class="page-title"><?php esc_attr_e('Nothing Found', 'moda'); ?></h2>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) : ?>

            <p><?php
                printf(
                    wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'moda'),
                        array(
                            'a' => array(
                                'href' => array(),
                            ),
                        )
                    ),
                    esc_url(admin_url('post-new.php'))
                );
                ?></p>

        <?php elseif (is_search()) : ?>

            <section class="error-404 not-found not-search">
                <header>
                    <p><?php _e('Sorry, but nothing matched your search terms.', 'moda'); ?></p>
                </header><!-- .page-header -->


                <?php the_widget('WP_Widget_Search'); ?>

            </section><!-- .error-404 -->

        <?php
        else : ?>

            <p><?php esc_attr_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'moda'); ?></p>
            <?php
            get_search_form();

        endif; ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
