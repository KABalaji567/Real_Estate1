<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header<?php echo is_front_page() ? '' : ' solid'; ?>">
  <div class="header-inner">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
      <?php if (has_custom_logo()) { the_custom_logo(); } else { ?>
        <span class="brand-name"><?php bloginfo('name'); ?><small><?php bloginfo('description'); ?></small></span>
      <?php } ?>
    </a>
    <nav class="nav" aria-label="<?php esc_attr_e('Primary', 'aurelia'); ?>">
      <?php
      wp_nav_menu(array(
          'theme_location' => 'primary',
          'container'      => false,
          'fallback_cb'    => 'aurelia_fallback_menu',
      ));
      ?>
    </nav>
    <button class="nav-toggle" aria-label="<?php esc_attr_e('Open menu', 'aurelia'); ?>">☰</button>
  </div>
  <div class="mobile-panel">
    <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'aurelia_fallback_menu')); ?>
  </div>
</header>
