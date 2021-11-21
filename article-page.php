<?php 
/*
Template Name: Article
Template Post Type: post
*/
?>

<?php get_header(); ?>
<?php $terms = get_the_terms($post->ID, 'category'); ?>
  <div class="main-content row">
    <div class="col-xl-9 col-lg-8 col-xs-12 pr">
      <section class="content article-pd" data-content="article">
        <h2 class="content_header">
          <a class="content_header__link" href="<?= get_term_link($terms[0]->term_id); ?>"><?= $terms[0]->name; ?></a>
        </h2>

        <article class="article">
          <h2 class="article_header"><?php the_title(); ?></h2>

          <div class="content_post-block__data">
            <i class="fa fa-clock-o"></i>
            <span class="content_post-block__data-number">
              <?= function_exists('pll__') ? pll__('added_post') : 'Been added:'?>
              <?php the_time("d.m.Y H:i"); ?>   
            </span>
          </div>

          <?php the_content(); ?>
          
          <footer class="article_footer">
            <div class="content_post-block__thumbs">
              <?php if(function_exists('wp_ulike')) wp_ulike('get') ?>
              <span class="content_post-block__views" data-title="<?= function_exists('pll__') ? pll__('count_views') : 'Count views the post'?>"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?= get_post_meta ($post->ID,'views',true) ?: 0 ?></span>
            </div>
          </footer>
        </article>

        <nav class="article_navigation">
          <div class="article_navigation__nav-links">
            <div  class="prev_page">
              <a id="prev" class="prev_page__link">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x fa-4x navigation-circle"></i>
                  <i class="fa fa-angle-double-left fa-stack-1x navigation-angle"></i>
                </span> 
                <b><?= function_exists('pll__') ? pll__('prev') : 'Previous' ?></b>
              </a>
              <?php previous_post_link('%link', '%title', true); ?>
            </div> 

            <div  class="next_page">
              <a id="next" class="next_page__link">
                <b><?= function_exists('pll__') ? pll__('next') : 'Next' ?></b>
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x fa-4x navigation-circle"></i>
                  <i class="fa fa-angle-double-right fa-stack-1x navigation-angle"></i>
                </span>
              </a>
              <?php next_post_link('%link', '%title', true); ?>
            </div>
          </div>
        </nav>
      </section>

    </div>
    <!-- /.col-6 pl pr -->
    <aside class="col-xl-3 col-lg-4 col-xs-12 pl">
			<?php get_sidebar('right'); ?>
    </aside>
    <div class="col-xl-12 col-lg-12 col-xs-12">
      <section class="comments">
        <?php comments_template(); ?>
      </section>
    </div>
  </div>
</main>

<?php get_footer(); ?>