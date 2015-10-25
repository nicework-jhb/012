<div class="container-fluid" style="padding: 0;">
  <?php while (have_posts()) : the_post(); ?>
    <div class="home-title" <?php post_class(); ?>>
      <span class="text-vertical-center">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <hr/>
        <h3><?php the_content(); ?></h3>
        <a href="#spaces" class="home-scroll-btn">SCROLL DOWN<br/><i class="fa fa-chevron-down"></i><br/><i class="fa fa-chevron-down"></i></a>
      </span>
    </div>
  <?php endwhile; ?>
</div>
<?php
$args = [
    'posts_per_page' => 6,
    'post_type' => 'space'
];
query_posts($args);
?>

<div class="container-fluid main-content">
  <div class="container" id="spaces">
    <h1 class="title">Spaces</h1>
    <?php if (!have_posts()) : ?>
      <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'sage'); ?>
      </div>
      <?php get_search_form(); ?>
    <?php endif; ?>
      <?php $colCount = 0; ?>
      <?php while (have_posts()) : the_post(); ?>
        <?php if ($colCount % 3 == 0) { ?>
          <div class="row">
        <?php } ?>
        <?php $colCount++; ?>
        <div class="col-md-4 thumbnail-block">
          <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
        </div>
        <?php if ($colCount % 3 == 0) { ?>
            </div>
        <?php } ?>
      <?php endwhile; ?>
      <?php if ($colCount % 3 != 0) { ?>
        </div>
      <?php } ?>
    <?php the_posts_navigation(); ?>

    <?php $homepageID = get_option('page_on_front'); ?>

    <?php
    $images = get_children(array('post_parent' => $homepageID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999));
    /* $images is now a object that contains all images (related to post id 1) and their information ordered like the gallery interface. */
    if ($images) {
      //looping through the images
      foreach ($images as $attachment_id => $attachment) {

        echo wp_get_attachment_image($attachment_id, 'full', false, ['style' => 'display: none;', 'class' => 'backstretch-image-scrape']);
      }
    }
    ?>
  </div>
</div>