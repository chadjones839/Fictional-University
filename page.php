<?php 
  get_header();

  while(have_posts()) {
    the_post(); 
    pageBanner(array(
      'title' => null,
      'subtitle' => null,
      'photo' => null
    ));
    ?>

    <div class="container container--narrow page-section">

      <?php 
        $parentPage = wp_get_post_parent_id(get_the_ID());
        if ($parentPage) { ?>
          <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($parentPage)?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parentPage);?></a> <span class="metabox__main"><?php the_title() ?></span></p>
          </div>
        <?php }
      ?>
      
      <?php 
      $testArray = get_pages(array(
        'child-of' => get_the_ID()
      ));

      if ($parentPage or $testArray) { ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php get_permalink($parentPage) ?>"><?php echo get_the_title($parentPage) ?></a></h2>
        <ul class="min-list">
          <?php 
            if ($parentPage) {
              $findChildrenOf = $parentPage;
            } else {
              $findChildrenOf = get_the_ID();
            }

            wp_list_pages(array(
              'title_li' => NULL,
              'child_of' => $findChildrenOf,
              'sort_column' => 'menu_order'
            ));
          ?>
        </ul>
      </div>
      <?php } ?>
      
      <div class="generic-content">
        <p><?php the_content(); ?></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptates vero vel temporibus aliquid possimus, facere accusamus modi. Fugit saepe et autem, laboriosam earum reprehenderit illum odit nobis, consectetur dicta. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos molestiae, tempora alias atque vero officiis sit commodi ipsa vitae impedit odio repellendus doloremque quibusdam quo, ea veniam, ad quod sed.</p>
      </div>

    </div>
  <?php }

  get_footer(); 
 ?>