<?php get_header(); ?>

<?php
if( have_rows('homepage_sections') ):
    while( have_rows('homepage_sections') ) : the_row();

        // HERO SECTION
        if( get_row_layout() == 'hero_section' ):
            $title = get_sub_field('hero_title');
            $subtitle = get_sub_field('hero_subtitle');
            $image = get_sub_field('hero_image');
            ?>
            <section class="hero" style="background-image: url(<?php echo esc_url($image['url']); ?>);">
                <div class="container">
                    <h1><?php echo esc_html($title); ?></h1>
                    <p><?php echo esc_html($subtitle); ?></p>
                </div>
            </section>
            <?php

        // FEATURED PRODUCTS
        elseif( get_row_layout() == 'featured_products' ):
            $products = get_sub_field('featured_products');
            if( $products ): ?>
                <section class="products-page container">
                    <h2>Featured Products</h2>
                    <div class="products-grid">
                        <?php foreach( $products as $product ): setup_postdata($product); ?>
                            <div class="product-card">
                                <?php if( has_post_thumbnail($product->ID) ) echo get_the_post_thumbnail($product->ID, 'medium'); ?>
                                <h3><?php echo get_the_title($product->ID); ?></h3>
                                <p><?php echo get_the_excerpt($product->ID); ?></p>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </section>
            <?php endif;

        // ABOUT SECTION
        elseif( get_row_layout() == 'about_section' ):
            $title = get_sub_field('about_title');
            $text = get_sub_field('about_text'); ?>
            <section class="about-page container">
                <h2><?php echo esc_html($title); ?></h2>
                <p><?php echo esc_html($text); ?></p>
            </section>
        <?php
        endif;

    endwhile;
endif;
?>

<?php get_footer(); ?>
