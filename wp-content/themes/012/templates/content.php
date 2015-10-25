<article <?php post_class(); ?>>
  <header>
    <span class="thumbnail-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
    <?php
    if (has_post_thumbnail()) {
      $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
      ?>
      <a href="<?php the_permalink(); ?>">
        <?php
        echo '<img src="' . $thumbnail_url[0] . '" class="img-responsive" alt="' . the_title_attribute('echo=0') . '" />';
        ?>
      </a>
      <?php
    }
    ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
  <div class="entry-link clearfix">
    <a href="<?php the_permalink(); ?>" class="btn btn-012 pull-right">More</a>
  </div>
</article>
