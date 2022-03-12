<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-6'); ?>>
    <div class="blog-card">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>" class="card-thumb">
                <?php the_post_thumbnail('full'); ?>
                <span class="moda-category-btn moda-btn"><?php moda_loop_category(); ?></span>
            </a>
        <?php endif; ?>
        <div class="card-description">
            <div class="author-date">
                <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('M'), get_the_time('j')); ?>"
                   class="date"><span><i class="far fa-calendar-alt"></i></span><?php the_time('M j, Y'); ?></a>
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" class="author"><span><i
                                class="flaticon-user-1"></i></span><?php echo get_the_author() ?></a>
            </div>
            <h5><a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a></h5>
            <a href="<?php the_permalink(); ?>" class="link"><i class="fal fa-long-arrow-right"></i></a>
        </div>
    </div>
</div>