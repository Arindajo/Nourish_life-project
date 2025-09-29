<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="container header-container">
        <?php 
        $logo = get_theme_mod('header_logo');
        if ($logo): ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
            </a>
        <?php else: ?>
            <h1 class="logo"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php endif; ?>

        <p class="site-description"><?php echo esc_html(get_bloginfo('description')); ?></p>

        <nav>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'container'      => false,
                'menu_class'     => '',
                'fallback_cb'    => false,
            ));
            ?>
        </nav>
    </div>
</header>
