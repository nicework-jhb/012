<?php
$args = [
    'post_type' => 'friend'
];
query_posts($args);
?>

<div class="container-fluid main-content">
  <div class="container">
    <h5>We have quite a lot of friends</h5>
    <?php if (!have_posts()) : ?>
      <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'sage'); ?>
      </div>
    <?php endif; ?>
    <div class="slick-friends">
      <?php while (have_posts()) : the_post(); ?>
        <div class="friend">
          <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
