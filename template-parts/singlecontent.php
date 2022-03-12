<div id="post-<?php the_ID(); ?>" <?php post_class('moda-blog-details'); ?>>
    <div class="post-details-title">
        <h3 class="post-title2"><?php the_title(); ?></h3>
        <div class="author-area">
            <?php moda_category(); ?>
            <div class="author">
                <div class="author-thumb">
                    <?php echo get_avatar(get_the_author_meta('ID'), '37'); ?>
                </div>
                <div class="content">
                    <?php moda_post_author(); ?>
                    <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('M'), get_the_time('j')) ?>"
                       class="date"><?php echo get_the_time('M, 7') ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php if (has_post_thumbnail()) : ?>
        <div class="market-industry-thumb">
            <div class="images-thumb">
                <?php the_post_thumbnail('full'); ?>
            </div>
            <div class="content">
                <h4><?php echo wp_trim_words(get_the_excerpt(), 12) ?></h4>
            </div>
        </div>
    <?php endif; ?>

    <div class="toproviding-customers">
        <?php the_content(); ?>
    </div>
    <div class="moda-details-tags-area">
        <?php moda_post_tag(); ?>
        <div class="social-share">
            <?php moda_post_share(); ?>
        </div>
    </div>
    <div class="moda-button-araa">
        <?php moda_navigation(); ?>
    </div>

    <?php
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
</div>