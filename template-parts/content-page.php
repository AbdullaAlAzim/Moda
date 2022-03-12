<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content pera-content">
        <?php
        the_content();
        wp_link_pages(array(
            'before' => '<div class="link-xpages">' . esc_html('Pages:'),
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'pagelink' => '%',
            'echo' => 1
        ));
        ?>
    </div><!-- .entry-content -->

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'moda'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
