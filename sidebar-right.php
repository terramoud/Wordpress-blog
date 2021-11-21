<?php 
  $lang_slug = function_exists('pll_current_language') ? pll_current_language() : "";
  $category_slug = ($lang_slug) ? 'all-categories_'. $lang_slug : "all-categories_en";
  $category_id = get_category_by_slug($category_slug)->cat_ID;  
?>
<section id="sidebar-right" class="sidebar-right">
  <h2 id="sidebar-right_header" class="content_header">
    <a class="content_header__link" data-sort="popular" href="<?= get_term_link($category_id); ?>?popular"><?= function_exists('pll__') ? pll__('header_sidebar-right') : 'Popular'?></a>
  </h2>

  <div class="cssload-container">
    <div class="cssload-speeding-wheel"></div>
  </div>

  <?php   
    $args = array( 
      'posts_per_page'  => 6,
      'cat'             => $category_id,
      'orderby'         => 'meta_value_num',
      'order'           => 'DESC',
      'meta_key'        => 'views',
      'post_type'       => 'post',
      'lang' => $lang_slug  
    );
    $postslist = new WP_Query( $args );
  ?>

  <?php if ( $postslist->have_posts() ) : ?>
    <?php while ( $postslist->have_posts() ) : ?>
      <?php 
        $postslist->the_post(); 
        $postID = ($queried_object_id) ?: get_queried_object_id();
        $terms = get_the_terms($post->ID, 'category'); 
        include( locate_template( 'template-parts/post/content-sidebar.php' ) ); 
      ?>       
    <?php endwhile; ?> 
    <?php wp_reset_postdata(); // сброс ?>
  <?php endif; ?>
</section>
<!--/.sidebar-right-->