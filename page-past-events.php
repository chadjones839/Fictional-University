<?php 
  get_header(); 
  pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of our past events',
    'photo' => null
  ));
  ?>

  <div class="container container--narrow page-section">
    <?php 
      // Creates a new query that points to the post type 'events'
      $today = date('Ymd');
        $pastEvents = new WP_Query(array(
          'paged' => get_query_var('paged', 1), // finds page number dynamically. 
          'posts_per_page' => 10, // -1 returns all posts matching type
          'post_type' => 'event',
          'meta_key' => 'event_date',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'event_date',
              'compare' => '<',
              'value' => $today,
              'type' => 'numeric'
            )
          )
        ));
      // $pastEvents points to the lop code and prefents it from referencing the default URL 'past-events'
      while($pastEvents->have_posts()) {
        $pastEvents->the_post(); 
        get_template_part('template-parts/content-event');
      }
      // when using custom queries instead of default URL base queries, pagination needs extra steps
      echo paginate_links(array(
        'total' => $pastEvents->max_num_pages // Dynamically finds total events and max pages
      ));
    ?>
  </div>



  <?php get_footer();
?>