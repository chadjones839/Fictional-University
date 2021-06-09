<?php 

  function university_files() {
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    
    if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.local')) {
      wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
    } else {
      wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'), NULL, '1.0', true);
      wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.bc49dbb23afb98cfc0f7.js'), NULL, '1.0', true);
      wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.bc49dbb23afb98cfc0f7.css'));
    }
  }

  function university_features() {
    register_nav_menu('header-menu-location', 'Header Menu Location');
    register_nav_menu('footer-menu-explore', 'Footer Menu Explore');
    register_nav_menu('footer-menu-learn', 'Footer Menu Learn');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    // syntax add_image_size(unique name, eidth, height, crop)
    add_image_size('prof-portrait', 260, 400, true);
    add_image_size('prof-square', 200, 200, true);
    add_image_size('page-banner', 1200, 350, true);
  }

  // Manipulating default URL based queries
  // Use when the default URL defines the post type
  function university_adjust_queries($query) {
    if (!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
      $query->set('orderby', 'title');
      $query->set('order', 'ASC');
      $query->set('posts_per_page', -1);
    }

    if (!is_admin() AND is_post_type_archive('event') AND $query-> is_main_query()) {
      $today = date('Ymd');
      $query->set('meta_key', 'event_date');
      $query->set('orderby', 'meta_value_num');
      $query->set('order', 'ASC');
      $query->set('meta_query', array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        )
      ));
    }
  }

  function pageBanner2() {
    ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php
        $pageBannerImg = get_field('page_banner_background_image');

          echo $pageBannerImg['sizes']['page-banner'];
        
       
       ?>">
      </div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          <p><?php echo get_field('page_banner_subtitle'); ?></p>
        </div>
      </div>  
    </div>
  <?php }

function pageBanner($args = NULL) {
  
  if (!$args['title']) {
    $args['title'] = get_the_title();
  }
 
  if (!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }
 
  if (!$args['photo']) {
    if (get_field('page_banner_background_image') AND !is_archive() AND !is_home() ) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['page-banner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }
  ?>
  <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'];
       ?>">
      </div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
        <div class="page-banner__intro">
          <p><?php echo $args['subtitle']; ?></p>
        </div>
      </div>  
    </div>
<?php }


  // syntax: add_action(hook, function name)
  add_action('wp_enqueue_scripts', 'university_files');
  add_action('after_setup_theme', 'university_features');
  add_action('pre_get_posts', 'university_adjust_queries')

?>