<?php get_header(); ?>

<!-- Products Section -->
<section class="products-page container">
    <h2>Our Supplements</h2>
    <div class="products-grid">
        <?php
        // Query the 'product' custom post type (we'll set it up later)
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 10
        );
        $products = new WP_Query($args);
        if ($products->have_posts()) :
            while ($products->have_posts()) : $products->the_post();
                // Get product meta
                $price = get_post_meta(get_the_ID(), 'price', true);
                $buy_link = get_post_meta(get_the_ID(), 'buy_link', true);
        ?>
                <div class="product-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_excerpt(); ?></p>
                    <span><?php echo esc_html($price); ?></span><br>
                    <a href="https://wa.me/256700000000?text=Hello%2C%20I'm%20interested%20in%20<?php the_title(); ?>" target="_blank">
    <button class="buy-btn"><?php echo get_theme_mod('buy_button_text', 'Buy on WhatsApp'); ?></button>
</a>

                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo "<p>No products found.</p>";
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>
