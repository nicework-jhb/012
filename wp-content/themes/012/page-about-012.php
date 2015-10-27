<div id="about">
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
        <?php get_template_part('templates/content', 'page'); ?>
      </div>
    </div>
  <?php endwhile; ?>
</div>