<?php

class moda_themes_hooks
{

    function __construct()
    {
        add_action('wp_body_open', array(&$this, 'theme_render_preloader'));
        add_action('wp_body_open', array(&$this, 'theme_render_scroll_top'));
    }

    function theme_render_preloader()
    {
        if (moda_theme_options('enb_pre')) {
            echo '<!-- Preloader -->  
        <div class="preloader"></div>';
        }
    }

    function theme_render_scroll_top()
    {
        if (moda_theme_options('enb_scroll')) {
            echo ' <button class="scroll-top">
            <i class="fas fa-angle-double-up"></i>
        </button>';
        }
    }

}

new moda_themes_hooks();