<?php while (have_posts()) : the_post(); ?>
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
      <header>
        <h1 class="title"><?php the_title(); ?></h1>
      </header>
      <div class="row">
        <div class="col-md-8">
          <article <?php post_class(); ?>>
            <h4>Date: <span style="font-weight: normal;"><?php echo types_render_field("date", array()); ?></span></h4>
            <h4>Time: <span style="font-weight: normal;"><?php echo types_render_field("time", array()); ?></span></h4>
            <h4>Address: <span style="font-weight: normal;"><?php echo types_render_field("venue-link", array('title' => types_render_field("venue-name", array()))); ?></span></h4>
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
            <?php if (!empty(types_render_field("facebook-link", array()))) { ?>
              <div class="event-fb-link"><a href="<?php echo types_render_field("facebook-link", array("output"=> "raw")); ?>"><i class="fa fa-facebook-square"></i></a></div>
            <?php } ?>
        </div>
        <div class="col-md-4">
          <div class="event-sidebar">
            <?php dynamic_sidebar('event-sidebar'); ?>
            <div class="newsletter-form">
              <?php echo do_shortcode('[contact-form-7 id="118" title="Newsletter Signup"]'); ?>
            </div>
          </div>
        </div>
      </div>
      <?php
      $thumbnails = types_render_field("image",
          array(
              "size" => "thumbnail",
              "output" => "normal",
              "class" => "img-responsive",
              "separator" => ","
          ));
      $thumbnailArray = explode(',', $thumbnails);
      $fullUrls = types_render_field("image",
          array(
              "resize" => "crop",
              "width" => "640",
              "height" => "300",
              "output" => "raw",
              "separator" => ","
          ));
      $fullUrlsArray = explode(',', $fullUrls);
      ?>
      <?php if (!empty($thumbnails)) { ?>
        <h4>Gallery</h4>
        <div class="ps-gallery" itemscope itemtype="http://schema.org/ImageGallery">
          <?php $key = 0; ?>
          <?php foreach ($thumbnailArray as $image) { ?>
            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
              <a href="<?php echo $fullUrlsArray[$key]; ?>" itemprop="contentUrl" data-size="">
                <?php echo explode('/>', $image)[0] . 'itemprop="thumbnail" data-image-url="' . $fullUrlsArray[$key] . '" />'; ?></a>
            </figure>
            <?php $key++; ?>
          <?php } ?>
        </div>
      <?php } ?>
      <footer>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      </footer>
      <?php comments_template('/templates/comments.php'); ?>
      </article>
    </div>
  </div>
<?php endwhile; ?>
