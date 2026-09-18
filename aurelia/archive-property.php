<?php
/**
 * Property archive.
 *
 * @package Aurelia
 */

get_header();
?>
<section class="page-hero compact">
  <div class="container">
    <span class="eyebrow"><?php esc_html_e('Listings', 'aurelia'); ?></span>
    <h1><?php post_type_archive_title(); ?></h1>
  </div>
</section>
<section class="section">
  <div class="container property-grid">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="property-card">
        <div class="property-media">
          <?php if (has_post_thumbnail()) { the_post_thumbnail('aurelia-card'); } ?>
        </div>
        <div class="property-body">
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <div class="price"><?php echo esc_html(get_post_meta(get_the_ID(), '_aurelia_price', true)); ?></div>
          <a class="btn btn-outline" href="<?php the_permalink(); ?>"><?php esc_html_e('View Details', 'aurelia'); ?></a>
        </div>
      </article>
    <?php endwhile; endif; ?>
  </div>
</section>
<?php
get_footer();
