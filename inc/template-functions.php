<?php

add_filter('body_class', 'moda_bodyclass_checker');
function moda_bodyclass_checker($classes)
{
    $classes[] = 'checkerbody';
    return $classes;
}

function moda_comment_nav()
{
    // Are there comments to navigate through?
    if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'moda'); ?></h2>
            <div class="nav-links">
                <?php
                if ($prev_link = get_previous_comments_link(esc_html__('Older Comments', 'moda'))) :
                    printf('<div class="nav-previous">%s</div>', $prev_link);
                endif;

                if ($next_link = get_next_comments_link(esc_html__('Newer Comments', 'moda'))) :
                    printf('<div class="nav-next">%s</div>', $next_link);
                endif;
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .comment-navigation -->
    <?php
    endif;
}

function moda_comment_callback($comment, $args, $depth)
{
    if ('div' === $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_attr($tag); ?><?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="article">
<?php endif; ?>

    <div class="author-pic"><?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 64); ?></div>
    <div class="details">
        <div class="author-meta">
            <?php printf(__('<div class="name"><h4>%s</h4></div>', 'moda'), get_comment_author_link()); ?>
            <div class="date"><span><?php printf(__('%1$s', 'moda'), get_comment_date()); ?></span></div>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.', 'moda'); ?></em>
        <?php endif; ?>

        <?php comment_text(); ?>
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

    </div>

    <?php if ('div' != $args['style']) : ?>
    </div>
<?php endif; ?>
    <?php
}


function moda_logo()
{
    $custom_logo_id = get_theme_mod('custom_logo');

    if ($custom_logo_id) {
        echo '<a class="site-logo" href=' . esc_url(home_url('/')) . ' rel="home">' . wp_get_attachment_image($custom_logo_id, 'full') . '</a>';
    } else {
        echo '<a class="site-logo" href=' . esc_url(home_url('/')) . ' rel="home">' . get_bloginfo('name') . '</a>';
    }
}

function moda_get_logo()
{
    $custom_logo_id = get_theme_mod('custom_logo');

    if ($custom_logo_id) {
        return '<a class="logo" href=' . esc_url(home_url('/')) . ' rel="home">' . wp_get_attachment_image($custom_logo_id, 'full') . '</a>';
    } else {
        return '<a class="logo" href=' . esc_url(home_url('/')) . ' rel="home">' . get_bloginfo('name') . '</a>';
    }
}

function moda_post_tag()
{

    if ('post' == get_post_type()) {

        $posttags = get_the_tags();
        $separator = '';
        $output = '';
        if ($posttags) {

            foreach ($posttags as $tag) {
                $output .= '<li><a href="' . get_tag_link($tag->term_id) . '" class="moda-btn">' . $tag->name . '</a></li>' . $separator;
            }

            $tags = trim($output, $separator);
            echo ' <div class="tags">
                <h5>' . esc_html('Tag:') . '</h5>
                <ul>
                    ' . $tags . '
                </ul>
            </div>';
        }
    }
}

function moda_post_share()
{
    ?>
    <ul>
        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i
                        class="fab fa-facebook-f"></i></a></li>
        <li>
            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo the_title(); ?>&via=<?php the_author_meta('twitter'); ?>"><i
                        class="fab fa-twitter"></i></a></li>
        <li>
            <a href="mailto:type%20email%20address%20here?subject=I%20wanted%20to%20share%20this%20post%20with%20you%20from%20<?php bloginfo('name'); ?>&body=<?php the_title(); ?> - <?php the_permalink(); ?>"
               title="Email to a friend/colleague"><i class="far fa-envelope"></i></a></li>
        <li><a href="https://api.whatsapp.com/send?text=<?php the_title(); ?>: <?php the_permalink(); ?>"><i
                        class="fab fa-whatsapp"></i></a></li>
    </ul>
    <?php
}


function moda_single_category($default = true)
{

    if ('post' == get_post_type()) {
        $categories = get_the_category();
        $separator = ', ';
        $output = '';
        if ($categories) {
            foreach ($categories as $category) {

                $output .= '<a class="cat-links" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . $separator;

            }
            $cat = trim($output, $separator);
            echo '<span class="post-cat leffect-1"><i class="dashicons dashicons-category"></i> ' . $cat . '</span>';
        }
    }

}

/*Filter searchform button markup*/
add_filter('get_search_form', 'moda_modify_search_form');

function moda_modify_search_form($form)
{
    $form = '<form class="password-form" role="search" method="get" id="search-form" action="' . esc_url(home_url('/')) . '" >
    <div><label class="screen-reader-text" for="s">' . esc_attr__('Search for:', 'moda') . '</label>
    <input type="text" placeholder="' . esc_attr__('Type and hit enter', 'moda') . '" class="form-control" value="' . get_search_query() . '" name="s" id="s" />
    <button type="submit"><i class="dashicons dashicons-search"></i></button>
    </div>
    </form>';

    return $form;
}


/*Filter password form markup*/
add_filter('the_password_form', 'moda_password_form');
function moda_password_form()
{
    global $post;
    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $o = '<form class="postpass-form" action="' .
        esc_url(site_url('wp-login.php?action=postpass',
            'login_post')) .
        '" method="post">
	 ' . esc_attr__('This post is password protected and this is what I want to say about that. To view it please enter your password below:', 'moda') . '
	 <input class="post-pass" name="post_password" placeholder="' . esc_attr__('Type and hit enter', 'moda') . '" id="' . $label . '" type="password" />
	 </form>
	 ';
    return $o;
}

/*No main nav fallback*/
function moda_no_main_nav($args)
{
    if (!current_user_can('manage_options')) {
        return;
    }
    extract($args);

    $link = $link_before . '<a href="' . esc_url(admin_url('nav-menus.php')) . '">' . $before . esc_attr__('Please assign PRIMARY menu location', 'moda') . $after . '</a>' . $link_after;

    if (FALSE !== stripos($items_wrap, '<ul') or FALSE !== stripos($items_wrap, '<ol')) {
        $link = "<li>$link</li>";
    }

    $output = sprintf($items_wrap, $menu_id, $menu_class, $link);
    if (!empty ($container)) {
        $output = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ($echo) {
        echo moda_html($output);
    }

    return $output;
}

function moda_navigation()
{

    if (moda_theme_options('enb_single_nav')) {

        do_action('moda_single_navigation');

    } else { ?>
        <?php
        $prev = get_previous_post(true);
        $next = get_next_post(true);

        if ($prev) { ?>
            <a href="<?php echo get_permalink($prev->ID); ?>" class="moda-btn prev-post-btn"><span><i
                            class="fal fa-long-arrow-left"></i></span> Prev post</a>
        <?php }
        if ($next) { ?>
            <a href="<?php echo get_permalink($next->ID); ?>" class="moda-btn next-post-btn">Next post <span><i
                            class="fal fa-long-arrow-right"></i></span></a>
        <?php } ?>

    <?php }
}

function moda_numeric_posts_nav()
{

    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="moda-pagination">
								<ul>' . "\n";

    /** Previous Post Link */
    if (get_previous_posts_link())
        printf('<li>%s</li>' . "\n", get_previous_posts_link('<i class="fas fa-angle-double-left"></i>'));

    /** Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** Next Post Link */
    if (get_next_posts_link())
        printf('<li>%s</li>' . "\n", get_next_posts_link('<i class="fas fa-angle-double-right"></i>'));

    echo '</ul></nav>' . "\n";

}

function moda_pagination()
{

    if (moda_theme_options('enb_pagination')) {

        do_action('moda_pagination');

    } else {

        moda_numeric_posts_nav();

    }
}

function moda_share_tags()
{

    if (moda_theme_options('enb_share_tag')) {

        do_action('moda_share_tags');

    } else {

        moda_post_tag();
    }
}

function moda_related_post()
{

    if (moda_theme_options('enb_rpost')) {

        do_action('moda_related_post');

    }

}

function moda_authorbox()
{

    if (moda_theme_options('enb_authbox')) {

        do_action('moda_authorbox');
    }

}

function moda_dynamic_header()
{
    $header_switch = moda_theme_meta('header_switch');
    $opt_header = moda_theme_options('opt_header');
    $opt_page_header = moda_theme_options('opt_page_header');

    if ($header_switch == '1') {
        do_action('moda_header');
    } else {
        if (!is_page_template('theme-builder.php') && !empty($opt_page_header)) {
            echo do_shortcode('[INSERT_ELEMENTOR id="' . $opt_page_header . '"]');
        } elseif (is_page_template('theme-builder.php') && !empty($opt_page_header)) {
            echo do_shortcode('[INSERT_ELEMENTOR id="' . $opt_header . '"]');
        } else {
            get_template_part('template-parts/header', 'one');
        }
    }
}

function moda_dynamic_footer()
{
    $footer_switch = moda_theme_meta('footer_switch');
    $opt_footer = moda_theme_options('opt_footer');

    if ($footer_switch == '1') {
        do_action('moda_footer');
    } else {
        if (!empty($opt_footer)) {
            echo do_shortcode('[INSERT_ELEMENTOR id="' . $opt_footer . '"]');
        } else {
            get_template_part('template-parts/footer', 'one');
        }
    }
}