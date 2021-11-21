<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= get_bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <style>
      @font-face {
        font-family: Roboto;
        src: url(<?= get_template_directory_uri() ?>'/assets/fonts/fontawesome-webfont.ttf');
        font-weight: normal;
      }
    </style>
  </head>
  <body>
    <span id="top" class="top"></span>
    <nav id="menu_xs" class="menu_xs">
      <section class="menu-section">
        <div id="mobileSearch" class="mobile-search"><?php get_search_form(); ?></div>
        <?php 
          wp_nav_menu( 
            array(
              'theme_location'  => 'mobile_menu',
              'container'       => '',
              'menu_class'      => 'menu-section-list', 
              'depth'           => 10,
              'walker'          => new Mobile_custom_Walker_Nav_Menu,
            ) 
          ); 
        ?>
      </section>

      <section class="menu-section">
        <?php 
          wp_nav_menu( 
            array(
              'theme_location'  => 'mobile_menu-Front-end',
              'container'       => '',
              'menu_class'      => 'menu-section-list', 
              'depth'           => 10,
              'walker'          => new Mobile_custom_Walker_Nav_Menu,
            ) 
          ); 
        ?>
      </section>

      <section class="menu-section">
        <?php 
          wp_nav_menu( 
            array(
              'theme_location'  => 'mobile_menu-Back-end',
              'container'       => '',
              'menu_class'      => 'menu-section-list', 
              'depth'           => 10,
              'walker'          => new Mobile_custom_Walker_Nav_Menu,
            ) 
          ); 
        ?>
      </section>
    </nav>
    <div id="panel" class="wrapper" >
      <header class="header">
        <div class="header-wrapper row m0 align-items-baseline ">
          <div class="header-wrapper_left row m0">
            <h1 class="header-title"><a class="header-title_home" href="<?= get_home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
            <div class="header-logo-wrapper">
              <?php the_custom_logo(); ?>
              <span class="header-icon"><i class="fa fa-cog fa-spin fa-fw"></i></span>
              <span class="header-icon2"><i class="fa fa-cog fa-spin spin-reverse fa-fw"></i></span>
            </div> 
          </div>
          
          <div class="header-wrapper_right row m0 ">
            <?php pll_the_languages(['dropdown' => 1, 'display_names_as' => 'slug']); ?>
            <div class="header-bars toggle-button"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></div>    
            <div class="online">
              <div class="header-count-wrapper row m0 align-items-center">
                <i class="header-count-online fa fa-circle fa-1x" aria-hidden="true"></i>
                <span class="header-online" title="<?= function_exists('pll__') ? pll__('current_online') : 'Current online on site' ?>"><?= get_most_users_online(); ?></span>
              </div>
            </div>
            <div id="desktopSearch" class="desktop-search"><?php get_search_form(); ?></div>
          </div>
        </div>
      </header>

      <main class="container">
        <nav class="top-nav">      
          <?php 
            wp_nav_menu( 
              array(
                'theme_location'  => 'head_menu',
                'container' => '',
                'menu_class'      => 'top-nav_menu ', 
                'menu_id'         => 'menu',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'depth'           => 10,
                'walker'          => new Custom_Walker_Nav_Menu,
              ) 
            ); 
          ?>
        </nav>
        <?php wp_reset_postdata(); ?>