<?php
/* Template Name: Edit Product */
get_header();

// Require user to be logged in
if (!is_user_logged_in()) {
    echo '<p>Please log in to edit products.</p>';
    get_footer();
    exit;
}

// Get Product ID from query param
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
if (!$product_id || get_post_type($product_id) !== 'product') {
    echo '<p>Invalid product.</p>';
    get_footer();
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product_nonce'])) {

    if (!wp_verify_nonce($_POST['edit_product_nonce'], 'edit_product')) {
        echo '<p>Security check failed.</p>';
        exit;
    }

    $title = sanitize_text_field($_POST['product_title']);
    $desc = sanitize_textarea_field($_POST['product_desc']);
    $price = sanitize_text_field($_POST['product_price']);
    $wa_link = esc_url_raw($_POST['whatsapp_link']);

    // Update post
    wp_update_post(array(
        'ID' => $product_id,
        'post_title' => $title,
        'post_content' => $desc
    ));

    // Update ACF fields
    update_field('price', $price, $product_id);
    update_field('whatsapp_link', $wa_link, $product_id);

    // Handle image upload
    if (!empty($_FILES['product_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $attachment_id = media_handle_upload('product_image', $product_id);
        if (!is_wp_error($attachment_id)) {
            update_field('product_image', $attachment_id, $product_id);
        }
    }

    echo '<p>Product updated successfully!</p>';
}

// Get current product data
$product = get_post($product_id);
$product_image = get_field('product_image', $product_id);
$price = get_field('price', $product_id);
$wa_link = get_field('whatsapp_link', $product_id);
$desc = $product->post_content;
$title = $product->post_title;
?>

<section class="edit-product container">
    <h2>Edit Product</h2>
    <form method="post" enctype="multipart/form-data">
        <?php wp_nonce_field('edit_product', 'edit_product_nonce'); ?>

        <p>
            <label>Title</label><br>
            <input type="text" name="product_title" value="<?php echo esc_attr($title); ?>" required>
        </p>

        <p>
            <label>Description</label><br>
            <textarea name="product_desc" rows="5"><?php echo esc_textarea($desc); ?></textarea>
        </p>

        <p>
            <label>Price</label><br>
            <input type="text" name="product_price" value="<?php echo esc_attr($price); ?>">
        </p>

        <p>
            <label>WhatsApp Link</label><br>
            <input type="url" name="whatsapp_link" value="<?php echo esc_attr($wa_link); ?>">
        </p>

        <p>
            <label>Product Image</label><br>
            <?php if ($product_image) echo wp_get_attachment_image($product_image, 'medium'); ?><br>
            <input type="file" name="product_image">
        </p>

        <p>
            <button type="submit">Update Product</button>
        </p>
    </form>
</section>

<?php get_footer(); ?>
