<div id="about">
  <?php while (have_posts()) : the_post(); ?>
    <?php $postId = get_the_ID(); ?>
    <div class="post__featured-image">
      <?php
      if (has_post_thumbnail()) {

        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
        ?>
        <div class="image-container"><img src="<?php echo $thumbnail_url[0] ?>" alt="<?php echo the_title_attribute('echo=0'); ?>"/></div>
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

<?php query_posts(['post_type' => 'friend']); ?>

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
<?php query_posts('page_id=' . $postId); ?>
<?php while (have_posts()) : the_post(); ?>
  <div class="container-fluid main-content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h5><?php echo types_render_field("map-title", array()); ?></h5>
          <p><?php echo types_render_field("map-description", array()); ?></p>
          <p><?php echo types_render_field("map-key", array("class"=>"img-responsive")); ?></p>
        </div>
        <div class="col-md-6">
          <p><?php echo types_render_field("map-image", array("class"=>"img-responsive pull-right")); ?></p>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>