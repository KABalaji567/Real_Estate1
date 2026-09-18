<?php
/**
 * Single property.
 *
 * @package Aurelia
 */

get_header();
the_post();
?>
<section class="section" style="padding-top:120px">
  <div class="container">
    <span class="eyebrow"><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_address', true)); ?></span>
    <div style="display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap;align-items:end;margin:8px 0 28px">
      <h1><?php the_title(); ?></h1>
      <div class="price"><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_price', true)); ?></div>
    </div>
    <?php if (has_post_thumbnail()) : ?>
      <div class="gallery">
        <?php the_post_thumbnail('aurelia-gallery', array('class' => 'gallery-main')); ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<section class="section" style="padding-top:0">
  <div class="container detail-layout">
    <div>
      <div class="detail-facts">
        <div class="fact"><span><?php esc_html_e('Bedrooms', 'aurelia'); ?></span><strong><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_bedrooms', true)); ?></strong></div>
        <div class="fact"><span><?php esc_html_e('Bathrooms', 'aurelia'); ?></span><strong><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_bathrooms', true)); ?></strong></div>
        <div class="fact"><span><?php esc_html_e('Area', 'aurelia'); ?></span><strong><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_area', true)); ?></strong></div>
      </div>
      <?php the_content(); ?>
    </div>
    <aside class="sticky-card">
      <h3><?php esc_html_e('Inquire about this home', 'aurelia'); ?></h3>
      <a class="btn btn-gold" href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact Agent', 'aurelia'); ?></a>
    </aside>
  </div>
</section>
<?php
get_footer();
