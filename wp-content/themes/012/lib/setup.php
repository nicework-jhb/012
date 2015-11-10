<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'footer_navigation' => __('Footer Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Custom stylesheet for visual editor
  add_editor_style(Assets\asset_path('styles/main.css'));

  // custom thumbnail size for gallery page
  add_theme_support( 'post-thumbnails' ); // This feature enables post-thumbnail support for a theme
  // To enable only for posts:
  //add_theme_support( 'post-thumbnails', array( 'post' ) );
  // To enable only for posts and custom post types:
  //add_theme_support( 'post-thumbnails', array( 'post', 'movie' ) );

  // Register a new image size.
  // This means that WordPress will create a copy of the post image with the specified dimensions
  // when you upload a new image. Register as many as needed.
  // Adding custom image sizes (name, width, height, crop)
  add_image_size( 'gallery-thumbnail', 9999, 180, false );
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

function get_custom_post_labels($typeName) {
  return [
      'name' => $typeName . 's',
      'singular_name' => $typeName,
      'add_new' => 'Add New ' . $typeName,
      'add_new_item' => 'Add New ' . $typeName,
      'edit_item' => 'Edit ' . $typeName,
      'new_item' => 'New ' . $typeName,
      'all_items' => 'All ' . $typeName . 's',
      'view_item' => 'View ' . $typeName,
      'search_items' => 'Search ' . $typeName . 's',
      'not_found' =>  'No ' . $typeName . 's Found',
      'not_found_in_trash' => 'No ' . $typeName . 's found in Trash',
      'parent_item_colon' => '',
      'menu_name' => $typeName . 's',
  ];
}

function init_custom_post_types() {
  register_post_type('space', [
    'labels' => get_custom_post_labels('Space'),
    'has_archive' => true,
    'public' => true,
    'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes' ),
    'taxonomies' => array( 'post_tag', 'category' ),
    'exclude_from_search' => false,
    'capability_type' => 'post',
    'show_in_nav_menus' => true,
    'rewrite' => array( 'slug' => 'spaces' )
    ]);

  register_post_type('event', [
    'labels' => get_custom_post_labels('Event'),
    'has_archive' => true,
    'public' => true,
    'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes' ),
    'taxonomies' => array( 'post_tag', 'category' ),
    'exclude_from_search' => false,
    'capability_type' => 'post',
    'show_in_nav_menus' => true,
    'rewrite' => array( 'slug' => 'events' )
    ]);

  register_post_type('friend', [
      'labels' => get_custom_post_labels('Friend'),
      'has_archive' => false,
      'public' => true,
      'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes' ),
      'taxonomies' => array( 'post_tag', 'category' ),
      'exclude_from_search' => true,
      'capability_type' => 'post',
      'show_in_nav_menus' => true,
      'rewrite' => array( 'slug' => 'friends' )
  ]);
}
add_action('init', __NAMESPACE__ . '\\init_custom_post_types');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer Instagram', 'sage'),
    'id'            => 'sidebar-footer-instagram',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
      'name'          => __('Footer Twitter', 'sage'),
      'id'            => 'sidebar-footer-twitter',
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
  ]);

  register_sidebar([
      'name'          => __('Footer Newsletter', 'sage'),
      'id'            => 'sidebar-footer-newsletter',
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
  ]);

  register_sidebar([
      'name'          => __('Event Sidebar', 'sage'),
      'id'            => 'event-sidebar',
      'before_widget' => '<section class="widget %1$s %2$s"><p>',
      'after_widget'  => '</p></section>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function theme012_customize_register( $wp_customize ) {
  //All our sections, settings, and controls will be added here
  $wp_customize->add_section( 'theme012_social_links' , array(
      'title'      => __( 'Social Links', 'theme012' ),
      'priority'   => 30,
  ) );

  $wp_customize->add_setting( 'twitter' , array(
      'default'     => 'http://www.twitter.com/',
      'transport'   => 'refresh',
  ));

  $wp_customize->add_control('twitter_link', array(
      'label'        => __( 'Twitter Link', 'theme012' ),
      'section'    => 'theme012_social_links',
      'settings'   => 'twitter',
  ));

  $wp_customize->add_setting( 'facebook' , array(
      'default'     => 'http://www.facebook.com/',
      'transport'   => 'refresh',
  ));

  $wp_customize->add_control('facebook_link', array(
      'label'        => __( 'Facebook Link', 'theme012' ),
      'section'    => 'theme012_social_links',
      'settings'   => 'facebook',
  ));

  $wp_customize->add_setting( 'instagram' , array(
      'default'     => 'http://www.instagram.com/',
      'transport'   => 'refresh',
  ));

  $wp_customize->add_control('instagram_link', array(
      'label'        => __( 'Instagram Link', 'theme012' ),
      'section'    => 'theme012_social_links',
      'settings'   => 'instagram',
  ));

  $wp_customize->add_section( 'theme012_footer_static_content' , array(
      'title'      => __( 'Footer Static Content', 'theme012' ),
      'priority'   => 30,
  ) );

  $wp_customize->add_setting( 'copyright' , array(
      'default'     => '012 Central, All rights reserved',
      'transport'   => 'refresh',
  ));

  $wp_customize->add_control('footer_copyright', array(
      'label'        => __( 'Footer Copyright', 'theme012' ),
      'section'    => 'theme012_footer_static_content',
      'settings'   => 'copyright',
  ));

  $wp_customize->add_setting( 'address' , array(
      'default'     => '385 Helen Joseph Street. Pretoria.',
      'transport'   => 'refresh',
  ));

  $wp_customize->add_control('footer_address', array(
      'label'        => __( 'Footer Address', 'theme012' ),
      'section'    => 'theme012_footer_static_content',
      'settings'   => 'address',
  ));
}
add_action( 'customize_register', __NAMESPACE__ . '\\theme012_customize_register' );

// hide about page map box on all pages except about page
function custom_admin_styles() {
  $about = array(18);
  $contact = array(23);

  if (get_post_type() == 'page' && !in_array(get_the_ID(), $about)) {   //* about page
    echo '<style type="text/css"> #wpcf-group-about-page-map {display:none;} </style>';
  } else if (get_post_type() == 'page' && !in_array(get_the_ID(), $contact)) {   //* about page
    echo '<style type="text/css"> #wpcf-group-contact-information {display:none;} </style>';
  }
}
add_action('admin_head', __NAMESPACE__ . '\\custom_admin_styles');

//adding custom gallery thumbnail image size to backend
function custom_image_sizes_choose( $sizes ) {
  $custom_sizes = array(
      'gallery-thumbnail' => 'Gallery Thumbnail'
  );
  return array_merge( $sizes, $custom_sizes );
}

add_filter( 'image_size_names_choose', __NAMESPACE__ . '\\custom_image_sizes_choose' );

//adding tags to images for isotope
function wptp_add_tags_to_attachments() {
  register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , __NAMESPACE__ . '\\wptp_add_tags_to_attachments' );