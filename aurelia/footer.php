<footer class="site-footer">
  <div class="container footer-grid">
    <div>
      <h4><?php bloginfo('name'); ?></h4>
      <p><?php bloginfo('description'); ?></p>
      <p><?php echo esc_html(get_theme_mod('aurelia_phone', '+1 (203) 555-0148')); ?><br>
      <?php echo esc_html(get_theme_mod('aurelia_email', 'hello@aureliaestates.com')); ?><br>
      <?php echo esc_html(get_theme_mod('aurelia_address', '18 Harbor Lane, Greenwich, CT 06830')); ?></p>
    </div>
    <div>
      <h4><?php esc_html_e('Quick links', 'aurelia'); ?></h4>
      <?php wp_nav_menu(array('theme_location' => 'footer', 'container' => false, 'fallback_cb' => false)); ?>
    </div>
    <div>
      <h4><?php esc_html_e('Working hours', 'aurelia'); ?></h4>
      <p><?php echo esc_html(get_theme_mod('aurelia_hours', 'Mon–Fri 08:00–22:00')); ?></p>
    </div>
    <div><?php dynamic_sidebar('footer-contact'); ?></div>
  </div>
  <div class="container copyright">
    <span>© <?php echo esc_html(gmdate('Y')); ?> <?php bloginfo('name'); ?></span>
  </div>
</footer>
<div class="toast" role="status"></div>
<?php wp_footer(); ?>
</body>
</html>
