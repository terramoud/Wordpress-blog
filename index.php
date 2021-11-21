<?php 
/*
Template Name: Home_page
*/
?>
  <?php get_header(); ?>
  <?php 
    $lang_slug = function_exists('pll_current_language') ? pll_current_language() : "";

    $category_slug = ($lang_slug) ? 'announcements_of_posts_'. $lang_slug : "all-categories_en";
    $args = array(
      'numberposts' => 1,
      'category_name' => $category_slug,
      'lang' => $lang_slug
    );
    $posts = get_posts( $args );
  ?>

  <?php if ($posts): ?>
    <?php foreach($posts as $post) : setup_postdata($post); ?>
      <section class="unfinished-blog-post"> 
        <h2 class="unfinished-blog-post_wrapper__header-mobile">
          <?= function_exists('pll__') ? pll__('process_of_writing') : 'In the process of writing:' . " " ?>
          <?php the_title(); ?>    
        </h2>
        <article class="unfinished-blog-post_wrapper">
          <?= ( get_the_post_thumbnail( $post->ID, 'full', array('class' => 'banner_img') ) ?: '<img src="" class="no_img-banner" alt="">'); ?>
          <h2 class="unfinished-blog-post_wrapper__header">
            <?= function_exists('pll__') ? pll__('process_of_writing') : 'In the process of writing:' . " " ?>
            <?php the_title(); ?>  
          </h2>
          <?php the_content(); ?>
          <span class="unfinished-blog-post_wrapper__data">
            <?= function_exists('pll__') ? pll__('release_date') : 'Approximate release date:'?>
            <?php the_field('time_to_go'); ?>
          </span>
        </article>
        <!--/.unfinished-blog-post_wrapper-->
      </section>
      <!--/.unfinished-blog-post-->  
    <?php endforeach; ?>
    <?php wp_reset_postdata(); // сброс ?> 
  <?php else: ?>
     <section class="unfinished-blog-post"> 
        <h2 class="unfinished-blog-post_wrapper__header-mobile">&nbsp;<?= function_exists('pll__') ? pll__('new_posts_temporarily_unavailable') : 'New posts temporarily unavailable :('?></h2>
         <h2 class="unfinished-blog-post_wrapper__header">&nbsp;<?= function_exists('pll__') ? pll__('new_posts_temporarily_unavailable') : 'New posts temporarily unavailable :('?></h2>
      </section>
  <?php endif; ?>

  <?php 
    $category_slug = ($lang_slug) ? 'all-categories_'. $lang_slug : "all-categories_en";
    $category_id = get_category_by_slug($category_slug)->cat_ID; 
  ?>
  <div class="main-content row">
    <div class="col-xl-9 col-lg-8 col-xs-12 pr pl-lg">
      <section class="content">
        <h2 class="content_header">
          <a class="content_header__link" href="<?= get_term_link($category_id); ?>"><?= get_cat_name($category_id); ?></a>
        </h2>
        <div class="content-wrapper">
          <?php 
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $arg = array( 
              //'posts_per_page' => 10, // this is value should more than or equally value 'posts_per_page' in WP database!
              'cat' => $category_id,
              'paged' => $paged,
              'post_type' => 'post',
              'lang' => $lang_slug
            );
            query_posts( $arg );
          ?>

          <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post();?>
              <?php $terms = get_the_terms($post->ID, 'category'); ?>
              <section class="content_post-block all-cat-home">
                <div class="content_post-block__wrapper-first">

                  <h3 class="content_post-block__head-mobile">
                    <a class="content_post-block__header-mobile" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h3>

                  <div class="content_post-block__img-wrapper">
                    <?= ( get_the_post_thumbnail( $post->ID, 'full', array('class' => 'content_post-block__img') ) ?: '<img class="content_post-block__no-img" alt="" src="">'); ?>
                  </div>

                  <h5 class="content_post-block__cat">
                    <?= function_exists('pll__') ? pll__('category_name') : 'Category'?>
                    <a href="<?= get_term_link($terms[0]->term_id); ?>" class="content_post-block__cat-link" title="<?= $terms[0]->name; ?>"><?= $terms[0]->name; ?></a>
                  </h5>

                  <div class="content_post-block__data">
                    <i class="fa fa-clock-o"></i>
                    <span class="content_post-block__data-number">
                      <?= function_exists('pll__') ? pll__('added_post') : 'Been added:'?>
                      <?php the_time("d.m.Y H:i"); ?>      
                    </span>
                  </div>
                  <!-- /.content_post-block__data -->
                  <a href="<?php the_permalink(); ?>" class="content_post-block__button"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;<?= function_exists('pll__') ? pll__('read_more') : 'Read more'?></a>
                </div>
                <!-- /.content_post-block__wrapper-img -->
                <article class="content_post-block__wrapper">
                  <h3 class="content_post-block__head"><a class="content_post-block__header" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <p class="content_post-block__description" data-screenResolution="all"><?php limiter_lenght_excerts(135);?></p>
                  <p class="content_post-block__description" data-screenResolution="768-1199"><?php limiter_lenght_excerts(310);?></p>
                  <a href="<?php the_permalink(); ?>" class="content_post-block__button-mobile"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;<?= function_exists('pll__') ? pll__('read_more') : 'Read more'?></a>
                  <div class="content_post-block__thumbs">
                    <?php if(function_exists('wp_ulike')) wp_ulike('get') ?>  
                    <span class="content_post-block__views" title="<?= function_exists('pll__') ? pll__('count_views') : 'Count views the post'?>"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?= get_post_meta($post->ID,'views',true) ?: 0 ?></span>
                  </div>
                </article>
                <!-- /.content_post-block__wrapper -->
              </section>
              <!--/.content_post-block--> 
            <?php endwhile; ?>
            <?php 
              $prev_page = function_exists('pll__') ? pll__('prev') : 'Previous';
              $next_page = function_exists('pll__') ? pll__('next') : 'Next';
              $args = array(
                'show_all'     => false, 
                'end_size'     => 1,     
                'mid_size'     => 1,     
                'prev_next'    => true,  
                'prev_text'    => __('<span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x fa-4x navigation-circle"></i>
                                        <i class="fa fa-angle-double-left fa-stack-1x navigation-angle"></i>
                                      </span>
                                      <b> ' . $prev_page . '</b>'
                                    ),
                'next_text'    => __('<b>' . $next_page . ' </b> 
                                      <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x fa-4x navigation-circle"></i>
                                        <i class="fa fa-angle-double-right fa-stack-1x navigation-angle"></i>
                                      </span>'
                                    ),
                'add_args'     => false, 
                'add_fragment' => '',     
              );
              the_posts_pagination($args); 
              wp_reset_query();
            ?>
          <?php else: ?>
            <section class="content_post-block all-cat">
              <div class="content_post-block__wrapper-first">
                <h3 class="content_post-block__head-mobile"><?php the_field('no_posts'); ?></h3>
                <h3 class="content_post-block__head"><?php the_field('no_posts'); ?></h3>
              </div>
            </section>
          <?php endif; ?>
        </div>
      </section>
      <!--/.content-->
    </div>
    <!-- /.col-6 pl pr -->
    <aside id="sidebar-right_wrapper" class="col-xl-3 col-lg-4 col-xs-0 pl">
      <?php get_sidebar('right'); ?>
    </aside>
  </div>
</main>
<?php get_footer(); ?>


