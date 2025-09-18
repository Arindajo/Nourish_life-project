<?php
function nourishlife_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'nourishlife_scripts');

// Register menus
function nourishlife_menus() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu'),
        'footer-menu' => __('Footer Menu'),
    ));
}
add_action('init', 'nourishlife_menus');

// Register 'product' custom post type
function nourishlife_product_cpt() {
    $labels = array(
        'name' => 'Products',
        'singular_name' => 'Product',
        'add_new' => 'Add Product',
        'add_new_item' => 'Add New Product',
        'edit_item' => 'Edit Product',
        'all_items' => 'All Products',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    );
    register_post_type('product', $args);
}
add_action('init', 'nourishlife_product_cpt');
<?php
// Add Customizer settings for Buy Button
function nourishlife_customize_register($wp_customize) {

    // Section for Buy Button
    $wp_customize->add_section('buy_button_section', array(
        'title'       => __('Buy Button', 'nourishlife'),
        'priority'    => 30,
        'description' => 'Customize the Buy on WhatsApp button',
    ));

    // Button Text
    $wp_customize->add_setting('buy_button_text', array(
        'default' => 'Buy on WhatsApp',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('buy_button_text', array(
        'label'    => __('Button Text', 'nourishlife'),
        'section'  => 'buy_button_section',
        'type'     => 'text',
    ));

    // Button Color
    $wp_customize->add_setting('buy_button_color', array(
        'default' => '#27ae60',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'buy_button_color',
        array(
            'label'    => __('Button Color', 'nourishlife'),
            'section'  => 'buy_button_section',
        )
    ));

    // Button Hover Color
    $wp_customize->add_setting('buy_button_hover', array(
        'default' => '#219150',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'buy_button_hover',
        array(
            'label'    => __('Button Hover Color', 'nourishlife'),
            'section'  => 'buy_button_section',
        )
    ));

}
add_action('customize_register', 'nourishlife_customize_register');
?>
// Output Custom CSS for Buy Button
function nourishlife_customizer_css() {
  ?>
  <style type="text/css">
      .buy-btn {
          background: <?php echo get_theme_mod('buy_button_color', '#27ae60'); ?>;
      }
      .buy-btn:hover {
          background: <?php echo get_theme_mod('buy_button_hover', '#219150'); ?>;
      }
  </style>
  <?php
}
add_action('wp_head', 'nourishlife_customizer_css');
<?php
// Register Products CPT
function nourishlife_products_cpt() {

    $labels = array(
        'name' => 'Products',
        'singular_name' => 'Product',
        'add_new' => 'Add New Product',
        'add_new_item' => 'Add New Product',
        'edit_item' => 'Edit Product',
        'all_items' => 'All Products',
        'view_item' => 'View Product',
        'search_items' => 'Search Products',
        'not_found' => 'No products found',
        'not_found_in_trash' => 'No products in trash'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-cart',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true, // for Gutenberg
    );

    register_post_type('product', $args);
}
add_action('init', 'nourishlife_products_cpt');
?>
