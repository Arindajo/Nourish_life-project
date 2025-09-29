<?php get_header(); ?>

<section class="single-product container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <div class="product-detail">
            <?php 
            $product_image = get_field('product_image');
            $price = get_field('price');
            $wa_link = get_field('whatsapp_link');
            $desc = get_field('product_desc');

            if ($product_image) {
                echo wp_get_attachment_image($product_image, 'large');
            } elseif (has_post_thumbnail()) {
                the_post_thumbnail('large');
            }
            ?>

            <h1><?php the_title(); ?></h1>

            <?php if ($desc) : ?>
                <p><?php echo esc_html($desc); ?></p>
            <?php else : ?>
                <p><?php the_content(); ?></p>
            <?php endif; ?>

            <?php if ($price) : ?>
                <p class="price"><?php echo esc_html($price); ?></p>
            <?php endif; ?>

            <?php if ($wa_link) : ?>
                <a href="<?php echo esc_url($wa_link); ?>" target="_blank" class="buy-btn">
                    <?php echo get_theme_mod('buy_button_text', 'Buy on WhatsApp'); ?>
                </a>
            <?php endif; ?>
        </div>

    <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
