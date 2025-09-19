<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enqueue Styles
 */
function nourishlife_enqueue_styles() {
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'nourishlife_enqueue_styles');

/**
 * Register Menus
 */
function nourishlife_register_menus() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'nourishlife'),
        'footer-menu' => __('Footer Menu', 'nourishlife'),
    ));
}
add_action('init', 'nourishlife_register_menus');

/**
 * Register Product Custom Post Type
 */
function nourishlife_register_product_cpt() {
    $labels = array(
        'name'               => __('Products', 'nourishlife'),
        'singular_name'      => __('Product', 'nourishlife'),
        'menu_name'          => __('Products', 'nourishlife'),
        'add_new'            => __('Add New', 'nourishlife'),
        'add_new_item'       => __('Add New Product', 'nourishlife'),
        'edit_item'          => __('Edit Product', 'nourishlife'),
        'all_items'          => __('All Products', 'nourishlife'),
        'view_item'          => __('View Product', 'nourishlife'),
        'search_items'       => __('Search Products', 'nourishlife'),
        'not_found'          => __('No products found', 'nourishlife'),
        'not_found_in_trash' => __('No products in Trash', 'nourishlife')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true, // for Gutenberg
        'rewrite'            => array('slug' => 'products'),
    );

    register_post_type('product', $args);
}
add_action('init', 'nourishlife_register_product_cpt');

/**
 * Theme Setup
 */
function nourishlife_theme_setup() {
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width'  => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'nourishlife_theme_setup');

/**
 * ACF Options Page
 */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

/**
 * Customizer Settings (Merged)
 */
function nourishlife_customize_register($wp_customize) {

    // =====================
    // Header Logo
    // =====================
    $wp_customize->add_setting('header_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'header_logo',
        array(
            'label' => 'Header Logo',
            'section' => 'title_tagline',
            'settings' => 'header_logo'
        )
    ));

    // =====================
    // Colors
    // =====================
    $wp_customize->add_setting('primary_color', array(
        'default' => '#27ae60',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'primary_color',
        array(
            'label' => 'Primary Color',
            'section' => 'colors'
        )
    ));

    $wp_customize->add_setting('secondary_color', array(
        'default' => '#f1c40f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'secondary_color',
        array(
            'label' => 'Secondary Color',
            'section' => 'colors'
        )
    ));

    // =====================
    // Fonts
    // =====================
    $wp_customize->add_section('typography', array(
        'title'    => __('Typography', 'nourishlife'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('heading_font', array(
        'default' => 'Arial, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('heading_font', array(
        'label' => 'Heading Font',
        'section' => 'typography',
        'type' => 'text',
    ));

    $wp_customize->add_setting('body_font', array(
        'default' => 'Verdana, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('body_font', array(
        'label' => 'Body Font',
        'section' => 'typography',
        'type' => 'text',
    ));

    // =====================
    // Buy Button
    // =====================
    $wp_customize->add_section('buy_button_section', array(
        'title'       => __('Buy Button', 'nourishlife'),
        'priority'    => 30,
        'description' => 'Customize the Buy on WhatsApp button',
    ));

    $wp_customize->add_setting('buy_button_text', array(
        'default' => 'Buy on WhatsApp',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('buy_button_text', array(
        'label'   => __('Button Text', 'nourishlife'),
        'section' => 'buy_button_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('buy_button_color', array(
        'default' => '#27ae60',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'buy_button_color',
        array(
            'label'   => __('Button Color', 'nourishlife'),
            'section' => 'buy_button_section',
        )
    ));

    $wp_customize->add_setting('buy_button_hover', array(
        'default' => '#219150',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'buy_button_hover',
        array(
            'label'   => __('Button Hover Color', 'nourishlife'),
            'section' => 'buy_button_section',
        )
    ));
}
add_action('customize_register', 'nourishlife_customize_register');

/**
 * Output Custom CSS from Customizer
 */
function nourishlife_customizer_css() {
    ?>
    <style type="text/css">
        body {
            font-family: <?php echo get_theme_mod('body_font', 'Verdana, sans-serif'); ?>;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: <?php echo get_theme_mod('heading_font', 'Arial, sans-serif'); ?>;
        }
        header {
            background-color: <?php echo get_theme_mod('primary_color', '#27ae60'); ?>;
        }
        a, .buy-btn {
            background-color: <?php echo get_theme_mod('primary_color', '#27ae60'); ?>;
        }
        .buy-btn:hover {
            background-color: <?php echo get_theme_mod('buy_button_hover', '#219150'); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'nourishlife_customizer_css');

/**
 * Exclude Footer Settings from menus
 */
function nourishlife_exclude_footer_settings($query) {
    if (!is_admin() && $query->is_main_query()) {
        $footer_page = get_page_by_path('footer-settings');
        if ($footer_page) {
            $query->set('post__not_in', array($footer_page->ID));
        }
    }
}
add_action('pre_get_posts', 'nourishlife_exclude_footer_settings');

function nourishlife_exclude_footer_settings_page($pages) {
    $footer_page = get_page_by_path('footer-settings');
    if ($footer_page) {
        $pages = array_filter($pages, function($page) use ($footer_page) {
            return $page->ID != $footer_page->ID;
        });
    }
    return $pages;
}
add_filter('get_pages', 'nourishlife_exclude_footer_settings_page');
// Automatically add Products CPT to header menu
function add_products_to_nav($items, $args) {
    if ($args->theme_location == 'header-menu') {
        $items .= '<li><a href="' . get_post_type_archive_link('product') . '">Products</a></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_products_to_nav', 10, 2);
