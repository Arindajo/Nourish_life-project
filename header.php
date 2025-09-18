<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  <?php wp_head(); ?>
</head>
<body>
  <header>
    <div class="container header-container">
      <h1 class="logo"><?php bloginfo('name'); ?></h1>
      <nav>
        <?php
          wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'container' => false,
            'menu_class' => ''
          ));
        ?>
      </nav>
    </div>
  </header>
