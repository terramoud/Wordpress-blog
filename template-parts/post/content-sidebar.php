<article class="sidebar-right_post-block">
  <div class="sidebar-right_post-block__wrapper">   
    <h3 class="sidebar-right_post-block__head-mobile">
      <a class="sidebar-right_post-block__header-mobile" href="<?php the_permalink($post->ID); ?>"><?php the_title(); ?></a>
    </h3>
    
    <div class="sidebar-right_post-block__wrapper-img">
      <?= ( get_the_post_thumbnail( $post->ID, 'full', array('class' => 'sidebar-right_post-block__img') ) ?: '<img class="sidebar-right_post-block__no-img" src="" alt="">'); ?>
    </div>

    <header class="sidebar-right_post-block__wrapper-header">
      <a href="<?php the_permalink(); ?>" class="sidebar-right_post-block__header"><?php the_title(); ?></a>
      <h5 class="sidebar-right_post-block__cat"><?= function_exists('pll__') ? pll__('category_name') : 'Category: '?>
        <a class="sidebar-right_post-block__cat-link" href="<?= get_term_link($terms[0]->term_id); ?>" title="<?= $terms[0]->name; ?>"><?= $terms[0]->name; ?>   
        </a>
      </h5>
    </header>
  </div>

  <p class="sidebar-right_post-block__description"><?php limiter_lenght_excerts(155); ?></p>

  <div class="sidebar-button-wrapper">
    <a href="<?php the_permalink(); ?>" class="sidebar-right_post-block__button"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;<?= function_exists('pll__') ? pll__('read_more') : 'Read more'?></a>
    <span class="sidebar-right_post-block__views" title="<?= function_exists('pll__') ? pll__('count_views') : 'Count views the post'?>"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?= get_post_meta ($post->ID,'views',true) ?: 0 ?></span>
  </div>
</article>
