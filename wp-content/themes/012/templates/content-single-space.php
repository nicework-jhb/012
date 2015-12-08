<?php while (have_posts()) : the_post(); ?>
  <div class="post__featured-image">
    <?php
    $thumbnail_url = [];
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
      <header>
        <h1 class="title"><?php the_title(); ?></h1>
      </header>
      <div class="row">
        <div class="col-sm-8">
          <article <?php post_class(); ?>>
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
        </div>
        <div class="col-sm-4">
          <div class="enquire-block">
            <div class="enquire-block__image">
              <img src="<?php echo $thumbnail_url[0] ?>" alt="<?php echo the_title_attribute('echo=0'); ?>" class="img-responsive"/>
            </div>
            <div class="enquire-block__background"></div>
            <div class="enquire-block__text">
              <a href="<?php echo get_page_link(23); ?>">
                <span class="line-1" id="fittext-line-1"><?php echo types_render_field("line-1", array()); ?></span><br/>
                <span class="line-2" id="fittext-line-2"><?php echo types_render_field("line-2", array()); ?></span>
                <hr/>
              </a>
            </div>
            <a class="btn btn-012 btn-block" href="<?php echo get_page_link(23); ?>" style="z-index: 1; position: relative;">Enquire about<br/>booking an event</a>
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

        <div class="ps-gallery slick-gallery" itemscope itemtype="http://schema.org/ImageGallery">
          <?php $key = 0; ?>
          <?php foreach ($thumbnailArray as $image) { ?>
            <figure class="space-gallery-thumbnail" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
              <a href="<?php echo $fullUrlsArray[$key]; ?>" itemprop="contentUrl" data-size="<?php echo getimagesize($fullUrlsArray[$key])[0]; ?>x<?php echo getimagesize($fullUrlsArray[$key])[1]; ?>">
                <?php echo explode('/>', $image)[0] . 'itemprop="thumbnail" data-image-url="' . $fullUrlsArray[$key] . '" />'; ?></a>
            </figure>
            <?php $key++; ?>
          <?php } ?>
        </div>
      <?php } ?>
      <div class="row">
        <div class="col-md-4 col-md-offset-8">
          <?php $randomPost = $wpdb->get_var("SELECT guid FROM $wpdb->posts WHERE post_type = 'space' AND post_status = 'publish' ORDER BY rand() LIMIT 1"); ?>
          <a href="<?php echo $randomPost; ?>" class="btn btn-012 btn-block" style="margin-bottom: 30px;">Show me another space</a>
        </div>
      </div>
      <footer>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      </footer>
      <?php comments_template('/templates/comments.php'); ?>
      </article>
    </div>
  </div>
<?php endwhile; ?>