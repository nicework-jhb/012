<article <?php post_class(); ?>>
  <header>
    <p>
    <?php
    if ( has_post_thumbnail() ) {
      $thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
      echo '<img src="' . $thumbnail_url[0] . '" class="img-responsive center-block" alt="' . the_title_attribute( 'echo=0' ) . '" />';
    }
    ?>
    </p>
  </header>
  <div class="entry-summary">
    <p><strong><?php the_title(); ?></strong></p>
    <?php the_content(); ?>
  </div>
</article>
