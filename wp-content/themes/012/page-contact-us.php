<div id="contact">
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
      <div class="fim-block"></div>
    </div>
    <div class="content-single container-fluid">
      <div class="container">
        <?php get_template_part('templates/page', 'header'); ?>
        <div class="row">
          <div class="col-md-8">
            <div class="google-maps">
              <?php echo types_render_field("google-maps-embed-code", array()); ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="margin-bottom">
              <h5 style="color: #000;"><?php echo types_render_field("maps-details", array()); ?></h5>
              <a href="<?php echo types_render_field("maps-download", array()); ?>" class="btn btn-012">Download Map</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="contact-form">
              <?php echo do_shortcode('[contact-form-7 id="95" title="Contact Form"]'); ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="margin-bottom">
              <?php get_template_part('templates/content', 'page'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</div>
