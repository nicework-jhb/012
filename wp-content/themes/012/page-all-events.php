<div id="events">
  <?php while (have_posts()) : the_post(); ?>
    <div class="post__featured-image">
      <?php
      if (has_post_thumbnail()) {

        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
        ?>
        <img src="<?php echo $thumbnail_url[0] ?>" alt="<?php echo the_title_attribute('echo=0'); ?>"/>
        <?php
      }
      ?>
    </div>
    <div class="content-single container-fluid">
      <div class="container">
        <?php get_template_part('templates/page', 'header'); ?>
        <?php get_template_part('templates/content', 'events'); ?>
      </div>
    </div>
  <?php endwhile; ?>

  <?php
  $args = [
      'posts_per_page' => 6,
      'post_type' => 'event'
  ];
  query_posts($args);
  ?>

  <div class="container-fluid main-content">
    <div class="container" id="spaces">
      <?php if (!have_posts()) : ?>
        <div class="alert alert-warning">
          <?php _e('Sorry, no results were found.', 'sage'); ?>
        </div>
      <?php endif; ?>
      <?php $colCount = 0; ?>
      <?php while (have_posts()) : the_post(); ?>
        <?php if ($colCount % 3 == 0) { ?>
          <div class="row">
        <?php } ?>
        <?php $colCount++; ?>
        <div class="col-md-4 thumbnail-block">
          <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
        </div>
        <?php if ($colCount % 3 == 0) { ?>
          </div>
        <?php } ?>
      <?php endwhile; ?>
      <?php if ($colCount % 3 != 0) { ?>
    </div>
    <?php } ?>
  </div>
</div>