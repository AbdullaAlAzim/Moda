<?php

function moda_single_title($arg)
{

    if (is_category()) {
        /* translators: Category archive title. 1: Category name */
        $title = single_cat_title($arg['cat'], 'moda', false);
    } elseif (is_tag()) {
        /* translators: Tag archive title. 1: Tag name */
        $title = single_cat_title($arg['tag'], 'moda', false);
    } elseif (is_author()) {
        $title = sprintf($arg['author'] . '%s', '<span>' . get_the_author() . '</span>');
        //$title = get_the_author( 'Author: ', true );
    } elseif (is_year()) {
        /* translators: Yearly archive title. 1: Year */
        $title = sprintf($arg['yarchive'], '<span>' . get_the_date('F Y', 'yearly archives date format') . '</span>');
    } elseif (is_month()) {
        /* translators: Monthly archive title. 1: Month name and year */
        $title = sprintf($arg['marchive'], '<span>' . get_the_date('F Y', 'monthly archives date format') . '</span>');
    } elseif (is_404()) {
        /* translators: Daily archive title. 1: Date */
        $title = $arg['notfound'];
    } elseif (is_post_type_archive()) {
        /* translators: Post type archive title. 1: Post type name */
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $tax = get_taxonomy(get_queried_object()->taxonomy);
        /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = single_term_title('', false);
    } elseif (is_search()) {
        $title = sprintf($arg['search'] . '%s', '<span>' . get_search_query() . '</span>');
    } elseif (is_home() && is_front_page()) {
        $title = esc_html__('Home', 'moda');
    } elseif (is_singular()) {
        $title = get_the_title();
    } else {
        $title = esc_html__('Archives', 'moda');
    }

    return $title;
}

function moda_unit_breadcumb($separator = '<i class="fas fa-chevron-right"></i>')
{
    /* === OPTIONS === */
    $text['home'] = esc_html('Home'); // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['search'] = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag'] = 'Posts Tagged "%s"'; // text for a tag page
    $text['author'] = 'Articles Posted by %s'; // text for an author page
    $text['404'] = 'Error 404'; // text for the 404 page
    $text['page'] = 'Page %s'; // text 'Page N'
    $text['cpage'] = 'Comment Page %s'; // text 'Comment Page N'
    $wrap_before = '<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">'; // the opening wrapper tag
    $wrap_after = '</ol><!-- .breadcrumbs -->'; // the closing wrapper tag
    $sep = '<li class="breadcrumb-item separator"> ' . $separator . ' </li>'; // separator between crumbs
    $before = '<li class="breadcrumb-item active">'; // tag before the current crumb
    $after = '</li>'; // tag after the current crumb
    $show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_current = 1; // 1 - show current page title, 0 - don't show
    $show_last_sep = 1; // 1 - show last separator, when current page title is not displayed, 0 - don't show
    /* === END OF OPTIONS === */
    global $post;
    $home_url = home_url('/');
    $link = '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link .= '<a href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
    $link .= '<meta itemprop="position" content="%3$s" />';
    $link .= '</li>';
    $parent_id = ($post) ? $post->post_parent : '';
    $home_link = sprintf($link, $home_url, $text['home'], 1);
    if (is_home() || is_front_page()) {
        if ($show_on_home) echo wp_kses_post($wrap_before) . $home_link . $wrap_after;
    } else {
        $position = 0;
        echo wp_kses_post($wrap_before);
        if ($show_home_link) {
            $position += 1;
            echo wp_kses_post($home_link);
        }
        if (is_category()) {
            $parents = get_ancestors(get_query_var('cat'), 'category');
            foreach (array_reverse($parents) as $cat) {
                $position += 1;
                if ($position > 1) echo wp_kses_post($sep);
                echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
            }
            if (get_query_var('paged')) {
                $position += 1;
                $cat = get_query_var('cat');
                echo wp_kses_post($sep) . sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                echo wp_kses_post($sep) . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) {
                    if ($position >= 1) echo wp_kses_post($sep);
                    echo wp_kses_post($before) . sprintf($text['category'], single_cat_title('', false)) . $after;
                } elseif ($show_last_sep) echo wp_kses_post($sep);
            }
        } elseif (is_search()) {
            if (get_query_var('paged')) {
                $position += 1;
                if ($show_home_link) echo wp_kses_post($sep);
                echo sprintf($link, $home_url . '?s=' . get_search_query(), sprintf($text['search'], get_search_query()), $position);
                echo wp_kses_post($sep) . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) {
                    if ($position >= 1) echo wp_kses_post($sep);
                    echo wp_kses_post($before) . sprintf($text['search'], get_search_query()) . $after;
                } elseif ($show_last_sep) echo wp_kses_post($sep);
            }
        } elseif (is_year()) {
            if ($show_home_link && $show_current) echo wp_kses_post($sep);
            if ($show_current) echo wp_kses_post($before) . get_the_time('Y') . $after;
            elseif ($show_home_link && $show_last_sep) echo wp_kses_post($sep);
        } elseif (is_month()) {
            if ($show_home_link) echo wp_kses_post($sep);
            $position += 1;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position);
            if ($show_current) echo wp_kses_post($sep) . $before . get_the_time('F') . $after;
            elseif ($show_last_sep) echo wp_kses_post($sep);
        } elseif (is_day()) {
            if ($show_home_link) echo wp_kses_post($sep);
            $position += 1;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position) . $sep;
            $position += 1;
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'), $position);
            if ($show_current) echo wp_kses_post($sep) . $before . get_the_time('d') . $after;
            elseif ($show_last_sep) echo wp_kses_post($sep);
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $position += 1;
                $post_type = get_post_type_object(get_post_type());
                if ($position > 1) echo wp_kses_post($sep);
                echo sprintf($link, get_post_type_archive_link($post_type->name), $post_type->labels->name, $position);
                if ($show_current) echo wp_kses_post($sep) . $before . get_the_title() . $after;
                elseif ($show_last_sep) echo wp_kses_post($sep);
            } else {
                $cat = get_the_category();
                $catID = $cat[0]->cat_ID;
                $parents = get_ancestors($catID, 'category');
                $parents = array_reverse($parents);
                $parents[] = $catID;
                foreach ($parents as $cat) {
                    $position += 1;
                    if ($position > 1) echo wp_kses_post($sep);
                    echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                }
                if (get_query_var('cpage')) {
                    $position += 1;
                    echo wp_kses_post($sep) . sprintf($link, get_permalink(), get_the_title(), $position);
                    echo wp_kses_post($sep) . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                } else {
                    if ($show_current) echo wp_kses_post($sep) . $before . get_the_title() . $after;
                    elseif ($show_last_sep) echo wp_kses_post($sep);
                }
            }
        } elseif (is_post_type_archive()) {
            $post_type = get_post_type_object(get_post_type());
            if (get_query_var('paged')) {
                $position += 1;
                if ($position > 1) echo wp_kses_post($sep);
                echo sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label, $position);
                echo wp_kses_post($sep) . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current) echo wp_kses_post($sep);
                if ($show_current) echo wp_kses_post($before) . $post_type->label . $after;
                elseif ($show_home_link && $show_last_sep) echo wp_kses_post($sep);
            }
        } elseif (is_attachment()) {
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID);
            $catID = $cat[0]->cat_ID;
            $parents = get_ancestors($catID, 'category');
            $parents = array_reverse($parents);
            $parents[] = $catID;
            foreach ($parents as $cat) {
                $position += 1;
                if ($position > 1) echo wp_kses_post($sep);
                echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
            }
            $position += 1;
            echo wp_kses_post($sep) . sprintf($link, get_permalink($parent), $parent->post_title, $position);
            if ($show_current) echo wp_kses_post($sep) . $before . get_the_title() . $after;
            elseif ($show_last_sep) echo wp_kses_post($sep);
        } elseif (is_page() && !$parent_id) {
            if ($show_home_link && $show_current) echo wp_kses_post($sep);
            if ($show_current) echo wp_kses_post($before) . get_the_title() . $after;
            elseif ($show_home_link && $show_last_sep) echo wp_kses_post($sep);
        } elseif (is_page() && $parent_id) {
            $parents = get_post_ancestors(get_the_ID());
            foreach (array_reverse($parents) as $pageID) {
                $position += 1;
                if ($position > 1) echo wp_kses_post($sep);
                echo sprintf($link, get_page_link($pageID), get_the_title($pageID), $position);
            }
            if ($show_current) echo wp_kses_post($sep) . $before . get_the_title() . $after;
            elseif ($show_last_sep) echo wp_kses_post($sep);
        } elseif (is_tag()) {
            if (get_query_var('paged')) {
                $position += 1;
                $tagID = get_query_var('tag_id');
                echo wp_kses_post($sep) . sprintf($link, get_tag_link($tagID), single_tag_title('', false), $position);
                echo wp_kses_post($sep) . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current) echo wp_kses_post($sep);
                if ($show_current) echo wp_kses_post($before) . sprintf($text['tag'], single_tag_title('', false)) . $after;
                elseif ($show_home_link && $show_last_sep) echo wp_kses_post($sep);
            }
        } elseif (is_author()) {
            $author = get_userdata(get_query_var('author'));
            if (get_query_var('paged')) {
                $position += 1;
                echo wp_kses_post($sep) . sprintf($link, get_author_posts_url($author->ID), sprintf($text['author'], $author->display_name), $position);
                echo wp_kses_post($sep) . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current) echo wp_kses_post($sep);
                if ($show_current) echo wp_kses_post($before) . sprintf($text['author'], $author->display_name) . $after;
                elseif ($show_home_link && $show_last_sep) echo wp_kses_post($sep);
            }
        } elseif (is_404()) {
            if ($show_home_link && $show_current) echo wp_kses_post($sep);
            if ($show_current) echo wp_kses_post($before) . $text['404'] . $after;
            elseif ($show_last_sep) echo wp_kses_post($sep);
        } elseif (has_post_format() && !is_singular()) {
            if ($show_home_link && $show_current) echo wp_kses_post($sep);
            echo get_post_format_string(get_post_format());
        }
        echo wp_kses_post($wrap_after);
    }
}
