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
        <div class="col-sm-8">
          <article <?php post_class(); ?>>
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
        </div>
        <div class="col-sm-4">
          <div class="enquire-block">
            <a href="<?php echo get_page_link(23); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/enquire-icon.jpg" alt="Enquire Icon" />
              <h5>Enquire about booking an event</h5>
            </a>
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
