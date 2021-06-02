<?php 

  function university_files() {
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri());
  }

  function university_features() {
    register_nav_menu('header-menu-location', 'Header Menu Location');
    register_nav_menu('footer-menu-explore', 'Footer Menu Explore');
    register_nav_menu('footer-menu-learn', 'Footer Menu Learn');
    add_theme_support('title-tag');
  }

  add_action('wp_enqueue_scripts', 'university_files');
  add_action('after_setup_theme', 'university_features');
?>

<!-- 

add_action hooks on specific points during execution. It accepts two arguments

1. The name of the action to be hooked
2. name of the function to be called

wp_enqueue_scripts is a hook that enques assets into the header


 -->