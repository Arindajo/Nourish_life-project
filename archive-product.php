<?php get_header(); ?>

<section class="products-page container">
    <h2><?php post_type_archive_title(); ?></h2>
    <div class="products-grid">

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php 
                $product_image = get_field('product_image');
                $price = get_field('price');
                $wa_link = get_field('whatsapp_link');
                $desc = get_field('product_desc');
                $categories = get_the_terms(get_the_ID(), 'product_category');
                ?>
                
                <div <?php post_class('product-card'); ?>>

                    <?php 
                    if ($product_image) {
                        echo wp_get_attachment_image($product_image, 'medium');
                    } elseif ( has_post_thumbnail() ) {
                        the_post_thumbnail('medium');
                    }
                    ?>

                    <h3><?php the_title(); ?></h3>

                    <?php if ($desc) : ?>
                        <p><?php echo esc_html($desc); ?></p>
                    <?php else : ?>
                        <?php the_excerpt(); ?>
                    <?php endif; ?>

                    <?php if ($price) : ?>
                        <p class="price"><?php echo esc_html($price); ?></p>
                    <?php endif; ?>

                    <?php if ($wa_link) : ?>
                        <a href="<?php echo esc_url($wa_link); ?>" target="_blank" class="buy-btn">
                            <?php echo get_theme_mod('buy_button_text', 'Buy on WhatsApp'); ?>
                        </a>
                    <?php endif; ?>

                    <?php if ($categories && !is_wp_error($categories)) : ?>
                        <p class="categories">
                            <?php foreach ($categories as $cat) {
                                echo esc_html($cat->name) . ' ';
                            } ?>
                        </p>
                    <?php endif; ?>

                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo esc_url(add_query_arg('product_id', get_the_ID(), site_url('/edit-product'))); ?>" class="edit-btn">Edit</a>
                    <?php endif; ?>

                </div>

            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <p>No products found.</p>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
