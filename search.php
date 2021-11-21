<?php get_header(); ?>
  <div class="main-content row">
    <div class="col-xl-12 col-lg-12 col-xs-12">
      <section class="content">
        <h2 class="content_header"><?= function_exists('pll__') ? pll__('search_by') : 'Search by: '?>&nbsp;"<?= get_search_query(); ?>"</h2>
        <div class="content-wrapper">
          <?php $paged = get_query_var('paged') ? get_query_var('paged') : 1; ?>
          <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php $terms = get_the_terms($post->ID, 'category'); ?>
              <section class="content_post-block all-cat">
                <div class="content_post-block__wrapper-first">
                  <h3 class="content_post-block__head-mobile"><a href="<?php the_permalink(); ?>" class="content_post-block__header-mobile"><?php the_title(); ?></a></h3>
                  <span class="content_post-block__img--wrapper"><?= ( get_the_post_thumbnail( $post->ID, 'full', array('class' => 'content_post-block__img') ) ?: '<img class="content_post-block__no-img" src="" alt="">'); ?></span>
                  <h5 class="content_post-block__cat">
                    <?= function_exists('pll__') ? pll__('category_name') : 'Category'?> 
                    <a class="content_post-block__cat-link" href="<?= get_category_link( $terms[0]->term_id ); ?>"><?= $terms[0]->name; ?></a>
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
                  <p class="content_post-block__description"><?php limiter_lenght_excerts(230); ?></p>                  
                  <a href="<?php the_permalink(); ?>" class="content_post-block__button-mobile"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;<?= function_exists('pll__') ? pll__('read_more') : 'Read more'?></a>
                  <div class="content_post-block__thumbs">
                    <?php if(function_exists('wp_ulike')) wp_ulike('get') ?>
                    <span class="content_post-block__views" title="<?= function_exists('pll__') ? pll__('count_views') : 'Count views the post'?>"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?= get_post_meta ($post->ID,'views',true) ?: 0 ?></span>
                  </div>
                </article>
                <!-- /.content_post-block__wrapper -->
              </section>
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
                <h3 class="content_post-block__head-mobile"><?= function_exists('pll__') ? pll__('nothing_found') : 'Nothing found'?></h3>
                <h3 class="content_post-block__head"><?= function_exists('pll__') ? pll__('nothing_found') : 'Nothing found.'?></h3>
              </div>
            </section>  
          <?php endif; ?>
        </div>
        <!--/.content-wrapper-->  
      </section>
      <!--/.content-->
    </div>
    <!-- /.col-* pl pr -->
  </div>
</main>
<?php get_footer(); ?>