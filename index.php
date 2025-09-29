<?php get_header(); ?>

<section class="products-page container">
    <h2><?php esc_html_e('Our Supplements', 'nourishlife'); ?></h2>
    <div class="products-grid">
        <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 10
        );
        $products = new WP_Query($args);
        if ($products->have_posts()) :
            while ($products->have_posts()) : $products->the_post();
                $price = get_post_meta(get_the_ID(), 'price', true);
                $buy_link = get_post_meta(get_the_ID(), 'buy_link', true);
        ?>
            <div class="product-card">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium', array('alt' => esc_attr(get_the_title()))); ?>
                <?php endif; ?>
                
                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
                
                <?php if ($price) : ?>
                    <span><?php echo esc_html($price); ?></span><br>
                <?php endif; ?>
                
                <?php if ($buy_link) : ?>
                    <a href="<?php echo esc_url($buy_link); ?>" target="_blank">
                        <button class="buy-btn"><?php echo esc_html(get_theme_mod('buy_button_text', 'Buy on WhatsApp')); ?></button>
                    </a>
                <?php endif; ?>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>' . esc_html__('No products found.', 'nourishlife') . '</p>';
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>
