<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header();

if (is_active_sidebar('sidebar-1')) {
    $main = 'col-xl-8';
    $sidebar = 'col-xl-4';
} else {
    $main = 'col-xl-12';
    $sidebar = 'col-xl-12';
}
?>
    <div class="moda-blog-section moda-section">
        <div class="container">
            <div class="moda-blog-wraper">
                <div class="row">
                    <div class="<?php echo esc_attr($main); ?>">
                        <div class="moda-card-area">
                            <div class="row">

                                <?php if (have_posts()) :

                                    /* Start the Loop */
                                    while (have_posts()) : the_post();

                                        get_template_part('template-parts/content');

                                    endwhile;

                                else :

                                    get_template_part('template-parts/content', 'none');

                                endif; ?>
                            </div>
                            <?php moda_pagination(); ?>
                        </div>
                    </div>
                    <div class="<?php echo esc_attr($sidebar); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();