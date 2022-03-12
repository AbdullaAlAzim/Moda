<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header();
?>

    <section class="moda-error-section moda-section">
        <div class="container">
            <div class="moda-error-wraper">
                <div class="moda-error-thumb">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/error.png" alt="Error PNG">
                </div>
                <a href="<?php echo home_url('/'); ?>" class="back-btn moda-btn">Back to Home <span><i
                                class="fal fa-long-arrow-right"></i></span></a>
            </div>
        </div>
    </section>
<?php
get_footer();