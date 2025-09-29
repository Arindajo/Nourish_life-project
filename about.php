<?php
/* Template Name: About Page */
get_header(); 
?>

<!-- About Section -->
<section class="about-page">
    <div class="container">
        <h2><?php the_field('about_heading'); ?></h2>
        <p><?php the_field('about_intro'); ?></p>
        <p><?php the_field('about_details'); ?></p>
    </div>
</section>

<?php get_footer(); ?>
