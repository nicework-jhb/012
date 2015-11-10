<div id="page">
  <?php while (have_posts()) : the_post(); ?>
    <div class="post__featured-image">
      <?php if (has_post_thumbnail()) {
        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
        ?>
        <div class="image-container"><img src="<?php echo $thumbnail_url[0] ?>" alt="<?php echo the_title_attribute('echo=0'); ?>"/></div>
      <?php }?>
    </div>
    <div class="content-single container-fluid">
      <div class="container">
        <?php get_template_part('templates/page', 'header'); ?>
      </div>
    </div>
  <?php endwhile; ?>

  <div class="container-fluid main-content">
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content', 'page'); ?>
      <?php endwhile; ?>
    </div>
  </div>
</div>
