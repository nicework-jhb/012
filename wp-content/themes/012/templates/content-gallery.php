<?php
$attachment_ids = [];
$pattern = get_shortcode_regex();
$ids = [];
$all_tags = [];

if (preg_match_all('/' . $pattern . '/s', $post->post_content, $matches)) {
  $count = count($matches[3]);
  for ($i = 0; $i < $count; $i++) {
    $atts = shortcode_parse_atts($matches[3][$i]);
    if (isset($atts['ids'])) {
      $attachment_ids = explode(',', $atts['ids']);
      $ids = array_merge($ids, $attachment_ids);
    }
  }
}

if ($ids) { ?>

  <?php foreach ($ids as $id) { ?>
    <?php
    $temp_tags = get_the_tags($id);
    foreach($temp_tags as $temp_tag) {
      $found = false;
      foreach($all_tags as $all_tag) {
        if ($temp_tag->name == $all_tag->name) {
          $found = true;
          break;
        }
      }
      if (!$found) {
        array_push($all_tags, $temp_tag);
      }
    }
    ?>
  <?php } ?>
  <ul class="filter-button-group">
    <?php
    foreach ($all_tags as $tag) {
      echo '<li class="filter-button" data-filter=".' . str_replace(" ", "-", $tag->name) . '">' . $tag->name . '</li>';
    }
    ?>
  </ul>

  <div class="isotope-gallery ps-gallery" itemscope itemtype="http://schema.org/ImageGallery">
    <?php foreach ($ids as $id) { ?>
      <?php
      $tags = get_the_tags($id);
      $classTags = '';
      if ($tags) {
        foreach ($tags as $tag) {
          $classTags .= ' ' . str_replace(" ", "-", $tag->name);
        }
      }
      ?>
      <?php $image = wp_get_attachment_image_src($id, 'full'); ?>
      <figure class="gallery-item<?php echo $classTags; ?>" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
        <a href="<?php echo $image[0]; ?>" itemprop="contentUrl" data-size="<?php echo $image[1]; ?>x<?php echo $image[2]; ?>">
          <?php echo wp_get_attachment_image($id, 'gallery-thumbnail'); ?>
        </a>
      </figure>
    <?php } ?>
  </div>
<?php } ?>