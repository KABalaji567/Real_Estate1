<?php
/**
 * Default fallback template.
 *
 * @package Aurelia
 */

get_header();
?>
<section class="page-hero compact">
  <div class="container">
    <h1><?php echo esc_html(get_the_title() ? get_the_title() : get_bloginfo('name')); ?></h1>
  </div>
</section>
<section class="section">
  <div class="container">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_content();
        }
    }
    ?>
  </div>
</section>
<?php
get_footer();
