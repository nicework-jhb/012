<ul class="filter-button-group">
  <?php
  $tags = get_tags();
  if ($tags) {
    foreach ($tags as $tag) {
      echo '<li class="filter-button" data-filter=".' . str_replace(" ", "-", $tag->name) . '">' . $tag->name . '</li>';
    }
  }
  ?>
</ul>
<?php

$args = array(
    'numberposts' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_mime_type' => 'image',
    'post_parent' => $post->ID,
    'post_status' => null,
    'post_type' => 'attachment'
);

$images = get_children($args);
if ($images) { ?>
  <div class="isotope-gallery ps-gallery" itemscope itemtype="http://schema.org/ImageGallery">
    <?php foreach ($images as $image) { ?>
      <?php
      $tags = get_the_tags($image->ID);
      $classTags = '';
      if ($tags) {
        foreach ($tags as $tag) {
          $classTags .= ' ' . str_replace(" ", "-", $tag->name);
        }
      }
      ?>
      <figure class="gallery-item<?php echo $classTags; ?>" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
        <a href="<?php echo $image->guid; ?>" itemprop="contentUrl" data-size="<?php echo getimagesize($image->guid)[0]; ?>x<?php echo getimagesize($image->guid)[1]; ?>">
          <?php echo wp_get_attachment_image($image->ID, 'gallery-thumbnail'); ?>
        </a>
      </figure>
    <?php } ?>
  </div>
<?php } ?>