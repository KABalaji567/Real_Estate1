<?php
/**
 * Front page — uses WordPress property posts when available.
 *
 * @package Aurelia
 */

get_header();

$properties = new WP_Query(array(
    'post_type'      => 'property',
    'posts_per_page' => 6,
));
?>
<section class="hero">
  <div class="hero-media">
    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=2000&q=80" alt="">
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="hero-copy">
      <span class="eyebrow"><?php esc_html_e('Private brokerage', 'aurelia'); ?></span>
      <h1><?php esc_html_e('Find your perfect place to call home.', 'aurelia'); ?></h1>
      <p><?php echo esc_html(get_bloginfo('description')); ?></p>
      <div class="hero-actions">
        <a class="btn btn-gold" href="<?php echo esc_url(get_post_type_archive_link('property')); ?>"><?php esc_html_e('Explore Properties', 'aurelia'); ?></a>
        <a class="btn btn-ghost" href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact Us', 'aurelia'); ?></a>
      </div>
    </div>
  </div>
</section>

<section class="section" id="properties">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow"><?php esc_html_e('Featured listings', 'aurelia'); ?></span>
      <h2><?php esc_html_e('Homes with presence.', 'aurelia'); ?></h2>
    </div>
    <div class="property-grid">
      <?php if ($properties->have_posts()) : ?>
        <?php while ($properties->have_posts()) : $properties->the_post(); ?>
          <article class="property-card">
            <div class="property-media">
              <?php if (has_post_thumbnail()) { the_post_thumbnail('aurelia-card'); } ?>
              <?php $badge = get_post_meta(get_the_ID(), '_aurelia_badge', true); if ($badge) : ?>
                <span class="badge"><?php echo esc_html($badge); ?></span>
              <?php endif; ?>
            </div>
            <div class="property-body">
              <h3><?php the_title(); ?></h3>
              <?php the_excerpt(); ?>
              <div class="price"><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_price', true)); ?></div>
              <div class="specs">
                <span><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_bedrooms', true)); ?> beds</span>
                <span><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_bathrooms', true)); ?> baths</span>
                <span><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_area', true)); ?> sq ft</span>
              </div>
              <a class="btn btn-outline" href="<?php the_permalink(); ?>"><?php esc_html_e('View Details', 'aurelia'); ?></a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php else : ?>
        <p><?php esc_html_e('Add Property posts in WordPress to populate this grid. The HTML sample at the project root shows the full designed homepage.', 'aurelia'); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php
get_footer();
