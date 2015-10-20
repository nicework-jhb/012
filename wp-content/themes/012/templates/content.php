<article <?php post_class(); ?>>
  <header>
    <span class="thumbnail-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
    <?php
    if ( has_post_thumbnail() ) {
      $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
      ?>
      <a href="<?php the_permalink(); ?>">
      <?php
      echo '<img src="' . $large_image_url[0] . '" class="img-responsive" alt="' . the_title_attribute( 'echo=0' ) . '" />';
      ?>
        </a>
    <?php
    }
    ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt();  ?>
  </div>
</article>
